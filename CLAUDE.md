# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview
PHP 8.2 web application for university academic project management (senior/thesis projects).
Stack: PHP 8.2, MySQL (MySQLi), jQuery (legacy), XAMPP local dev. No build step — plain PHP served directly.
See `ERROR_AUDIT_REPORT.md` for a full audit of known issues, orphaned code, and fixes applied.

## Local Development
- Web root: `C:\xampp\htdocs\` — access via `http://localhost/Project2/`
- DB: MySQL via XAMPP, database name: `projectinformationsystem`
- Credentials in `connectdatabase.php`: root / (no password)
- No build step, no package manager, no test suite
- The `zip` PHP extension must be enabled (`extension=zip` in `php.ini`, then restart Apache) — required by `xlsxreader.php` for parsing `.xlsx` uploads via `ZipArchive`
- **`short_open_tag` must be `On`** — 258 files use bare `<? ... ?>` instead of `<?php ... ?>`. XAMPP defaults this to `On`, but Ubuntu/Debian's default php.ini ships with it `Off`; on a fresh Ubuntu deploy this makes every page print raw PHP source as text instead of executing it. See `UBUNTU_MIGRATION.md` §0.

## Architecture

### Entry Points & Routing
All navigation is single-page via jQuery `.load()` — the shell pages hold the sidebar and load fragments into `#showmanage`:

| File | Role | Session right |
|------|------|---------------|
| `index.php` | Login page, loads `login.php` fragment into sidebar | (none) |
| `intopage.php` | Dispatcher — redirects after login based on `$_SESSION['right']` | — |
| `officer.php` | Officer portal shell | right=2 |
| `teacher.php` | Teacher portal shell | right=3 |
| `student.php` | Student portal shell | right=4 |
| `admin.php` | Admin portal shell | right=1 |

All five of these shells (`index.php` + the four portals) share an identical outer `<table>` skeleton: a `height="151"/"150"` banner row with `background="image/head.gif"`, then a black `bgcolor="#000000"` footer row at the bottom. Site-wide branding (logo, copyright, footer text) lives in both of those rows and must be edited in **all five files** to stay consistent — there's no shared header/footer include. Currently: the banner row holds `<img src="image/logo_it.png" width="200" height="200" align="left">`, and the footer row holds the copyright line + "ปรับปรุงล่าสุด" date.

### Authentication Flow
1. `index.php` loads `login.php` fragment via `$(#login).load()`
2. Login form submits via raw XHR to `loging.php`, which sets `$_SESSION['right']`, `$_SESSION['iduser']`, `$_SESSION['fullname']`, `$_SESSION['idproject']`
3. Passwords stored as unsalted MD5 (legacy — do not change without migrating data)
4. On success, JS redirects to `intopage.php` which reads `$_SESSION['right']` and redirects to the portal

### Fragment Loading Pattern
Portal shells (officer.php, teacher.php, etc.) are full HTML pages. Every sidebar link triggers:
```js
$("#showmanage").load("module/page.php?pop=" + Math.random());
```
The `pop` parameter is a cache-buster (random float). Loaded fragments are raw HTML body content — **they must not include `<html>/<head>/<body>` tags**.

Fragments use `../` paths for includes since they live in subdirectories:
```php
include('../connectdatabase.php');
include('../change.php');
```

### Global Includes
- `connectdatabase.php` — opens `$connect` (MySQLi). Include once per request; call `mysqli_close($connect)` when done.
- `change.php` — extracts `$_GET`, `$_POST`, `$_FILES` into local variables via `variable variables`. Every page includes this.

### Module Directories
- `project/` — core: submit/approve/assign committee/schedule exam/record results. `shows2–shows8.php` are list views for each exam workflow step.
- `student/`, `teacher/`, `register/`, `race/` — CRUD modules for entities
- `exam/` — edit/view exam schedule
- `report/` — PDF generation (FPDF library in `report/`) and screen reports. `report/ex.php` and `report/jadoo.php` are unused FPDF demo files, not part of the app — ignore.
- `basicdata/` — lookup tables (faculty, title, type, room, etc.). `basicdata/branch.php` and its `add/del/edit` helpers are dead/orphaned — they reference `board`/`branch` DB tables that don't exist, and nothing links to them. Don't "fix" without first understanding what they were meant to become (see `ERROR_AUDIT_REPORT.md`).
- `news/`, `user/`, `password/`, `year/`, `headofdepartment/` — small utility modules

### Exam Workflow (officer)
Projects progress through 3 exam stages (title exam, 100% exam, 60% exam):
- `shows2.php` — pending title exam requests
- `shows3.php` — assign committee
- `shows4.php` — schedule exam date/room
- `shows5-1.php` — record exam results
- `shows5.php` — print evaluation forms
- `shows6.php` / `shows7.php` — submit thesis book / TK.01 form

## Key Patterns

### Fragment Pages
- Use `href="javascript:void(0);"` not `href="#"` — hash changes break jQuery `.load()` navigation
- Pagination links and onclick handlers must also avoid bare `#`

### JS onclick with PHP variables
Always use `json_encode()` to pass string PHP values into JS onclick attributes:
```php
echo "<a onclick=\"editItem(" . json_encode($rs['name']) . ")\">edit</a>";
```
Bare PHP variables become undefined JS identifiers.

### GET/POST parameter access
Use null-coalescing to avoid undefined index warnings:
```php
$page = $_GET['page'] ?? null;
```
(Though `change.php` extracts all params to local vars, direct `$_GET`/`$_POST` access still needs `??`.)

### SQL Deletion Order
Foreign key constraints require child-first deletion:
```
assignexam → committee → exam → manipulator → projecthistory → project
```

### Cache-Busting
Every `.load()` call appends `?pop=` + `Math.random()` to prevent browser caching of fragments.

### Relative Paths in Fragments Resolve Against the Shell, Not the Fragment
A fragment is inserted into the shell page's DOM, so any relative `src`/`href`/`action` inside it resolves against the **shell's URL** (e.g. `/Project2/officer.php`), not the fragment's own folder. A fragment living in `project/` that writes `action="upload.php"` actually submits to `/Project2/upload.php` (404) instead of `/Project2/project/upload.php`. Always prefix these with the full path from the site root (e.g. `action="project/upload.php"`), and don't re-include things the shell already loaded (e.g. a fragment should never have its own `<script src="_js/jquery.js">` — only the shell needs it).

### Iframe File Uploads
Multipart PDF uploads can't use the AJAX-GET pattern used elsewhere, so they go through a hidden iframe + form instead (see `project/upload.php`, `project/upload2.php`, `news/uploadnews.php`):
```html
<iframe id="uploadtarget" name="uploadtarget" style="width:0;height:0;border:0"></iframe>
<form action="module/upload.php?id=<?=$id?>" method="post" enctype="multipart/form-data" target="uploadtarget" onsubmit="return clickupload();">
```
The target script echoes `<script>window.parent.uploadok()/uploadfalse()</script>` back into the iframe, handled by globally-scoped `uploadok()`/`uploadfalse()` functions in the shell or fragment. Don't call `mysqli_close($connect)` before the final query in these scripts — reusing a closed connection throws a fatal error on PHP 8.2 and silently kills the callback before it's sent.

### Excel (.xlsx) Bulk Import
Bulk-import pages (`student/importingstudent.php`, `register/importingregister.php`) accept `.xlsx` and parse it with `xlsxreader.php`'s `readXlsxRows($path)` — a dependency-free reader built on PHP's built-in `ZipArchive` + `SimpleXML` (an `.xlsx` is a zip of XML: `xl/sharedStrings.xml` + `xl/worksheets/sheet1.xml`). No Composer package needed, but the `zip` extension must be enabled (see Local Development above). Each importer looks up text values (title/faculty/department/etc.) against existing lookup tables and skips rows that don't match or that already exist — it never silently invents new lookup rows or overwrites duplicates.

### `id_subject` is a VARCHAR, Not a Number
`subject.id_subject`, `registration.id_subject`, and `project.id_subject` are `varchar(15)` — subject codes carry meaningful leading zeros (e.g. `060243202`). Never cast this to `(int)` or use it in arithmetic; always treat it as an opaque string (escape with `mysqli_real_escape_string`, compare with `=`). A prior bug in `project/registerproject2.php` cast it to `(int)` and silently stripped the leading zero.

### Write Endpoints Never Validate Server-Side — Add It When Touching One
Every `add*.php`/`edit*.php` handler in this codebase relies entirely on client-side JS validation before submitting; the PHP side blindly `INSERT`s/`UPDATE`s whatever it receives, with no check that required fields are non-empty. A blank or malformed request (a stray direct hit, a bot, a broken link) silently creates junk rows. Worse, a few handlers (`year/changeyear.php`, `headofdepartment/changehead.php`) `UPDATE` a **singleton settings table with no `WHERE` clause at all** — a blank request blanks out the one row the whole site depends on (this happened for real: `academicyear` got wiped this way, and `year/changeyear.php` also runs an unconditional `DELETE FROM teacherfreetime` on every call, which wiped that table too). When you touch any `add*.php`/`edit*.php`/singleton-`UPDATE` handler, add a guard at the top:
```php
if(!isset($requiredField) || trim($requiredField)==="") { exit; }
```
This has already been retrofitted onto ~21 handlers this session (see `ERROR_AUDIT_REPORT.md`) — but any handler not yet touched still has this gap.

### "Transparent" PNG Assets May Not Actually Have Alpha
Icon/logo files sourced from icon sites (filenames like `*_transparent.png`) sometimes bake a checkerboard preview pattern into the actual pixels instead of shipping real alpha transparency. Check the PNG's IHDR color type before trusting the filename — color type 6 = RGBA (real alpha), color type 2 = RGB (none):
```python
import struct
with open(path, 'rb') as f:
    data = f.read(33)
    colortype = data[25]  # 6 = has alpha, 2 = flat RGB
```
If it's flat RGB, Pillow (bundled with the Python on this dev machine) can fix it: threshold pixel brightness and zero out alpha on light/checkerboard pixels, keeping the dark artwork opaque. Used for `image/logo_it.png` on the `index.php` login banner.

### Static Content Linking to a Specific News Attachment
`index.php`'s "ดาวน์โหลดคู่มือจัดทำปริญญานิพนธ์" button resolves its PDF at request time by querying `news` for `topic_news LIKE '%คู่มือจัดทำเล่มปริญญานิพนธ์%'` and using that row's `pdf_news`, instead of hardcoding a filename/path. This means re-uploading the manual through the officer's ข่าวประกาศ module (`news/news.php`) updates the login-page button automatically — no code change needed. Use this pattern (query by known `topic_news` text) whenever static/public-facing content needs to link to one specific news attachment.

### FPDF Reports Break on a UTF-8 BOM — and on One Unconvertible Character
223 `.php` files in this repo start with a UTF-8 BOM (`EF BB BF`). For HTML pages that's harmless — `output_buffering` keeps `header()`/`session_start()` working and browsers ignore a leading BOM — which is why the app runs fine. But the bundled FPDF is an old release whose `Output()` does a bare `if(ob_get_length()) $this->Error('Some data has already been output...')` with **no** whitespace/BOM tolerance (newer FPDF `ob_clean()`s a buffer matching `/^(\xEF\xBB\xBF)?\s*$/`). Three BOM bytes were enough to break **all 13** PDF reports since day one. The BOM was stripped from the 13 files calling `->Output()`; the other ~210 are untouched and unaffected. **Any new PDF-generating file must be saved without a BOM.**

The same error surfaces from a second cause: reports convert text with `iconv('UTF-8','cp874',…)` for the embedded Thai fonts, and a character outside cp874 makes iconv emit a Notice — that Notice is itself output, tripping the same FPDF check, so one bad character anywhere in the result set killed the whole report. All conversions now use `'cp874//IGNORE'`. Careful with blanket search-and-replace here: `report/font/angsa*.php` also contain `$enc='cp874'`, but that is the **font's encoding name, not an iconv target**, and must not be rewritten. Three `project.name_project` values still hold a corrupted Thai ้ (`591002`/`642023` contain U+F70B, a Private Use Area mai-tho from an old Thai font encoding; `672005` contains U+0161 `š`) — the reports now render regardless, but the names display wrong everywhere.

### One `exam` Row Can Own Several `assignexam` Rows — Join and the List Duplicates
`assignexam` has no unique constraint on `id_exam`, and real data has exceptions: `id_exam=2209` owns 3 rows, plus 46 junk rows sit at `id_exam=0`. Joining `assignexam` into a per-exam listing therefore multiplies the rows (verified: a plain join returned 4 history rows for the student owning exam 2209, instead of 2). When you only need the scheduled date, use a correlated subquery, which always yields exactly one value — or NULL for the ~289 exams never scheduled, so check with `empty()` and not just `=='0000-00-00'`:
```sql
(select assignexam.date_assignexam from assignexam
  where assignexam.id_exam = exam.id_exam
  order by assignexam.id_assignexam desc limit 1) as date_assignexam
```
Note `exam.date_submitexam` is **not** the exam date: `project/approve*exam.php` overwrites it with the date the officer accepts the request, which is why the UI labels it "วันที่รับเรื่อง". The actual exam date lives in `assignexam.date_assignexam` (with `time_assignexam`/`endtime_assignexam`/`id_room` alongside it).

### Multi-Table `select *` JOIN Column Offsets
Many report/print files (`report/evaluationform*.php`, `report/chooseeva*.php`, `report/big3.php`) run `select * from committee,teacher,academictitle where ...` and index the result positionally (`$rs3[17]`, `$rs4[6]`, etc.). The offset is determined **only by table order in the `FROM` clause**, never by the `WHERE` clause order — e.g. `committee` (4 cols: 0–3) + `teacher` (12 cols: 4–15) + `academictitle` (3 cols: 16–18) always gives `name_academictitle` at `[17]` and `initials_academictitle` at `[18]`, regardless of how the WHERE conditions are ordered. A real bug from this: `report/chooseeva.php`/`chooseeva2.php`/`chooseeva3.php` displayed "สถานะโครงงาน" using `$rs[15]` (`project.parent_project_id`, usually blank) instead of `$rs[17]` (`statusproject.name_statusproject`) — silently blank for every project. When adding a new positional field reference, count columns per table via `DESCRIBE <table>` rather than guessing.

This recurred in `project/viewexam.php`, which read `$rs[25]` for the exam status — its query joins `exam`(8) + `typeexam`(2) + `project`(16) + `statusproject`(2), putting `name_statusproject` at 27, while 25 is again `project.parent_project_id`, so "สถานะการสอบ" was blank for every student. Note the sibling table in `project/viewproject.php` was correct at `$rs[11]` purely because *its* query omits the `project` table — identical-looking code, different right answer. **Prefer naming the columns you need and reading them associatively (`$rs['name_statusproject']`); both files were converted.** Positional indices also make adding a column to the `SELECT` a re-count of every offset, which is how the bug gets reintroduced.

### Print-Form Templates Use Fragile Absolute Positioning — Verify with Real PDF Rendering, Not Screenshots
`report/formsubmittitleexam.php`, `formsubmit100exam.php`, `evaluationform*.php`, and siblings lay out content with `position:absolute` divs (`#apDiv1`, `#apDiv2`, ...) at hardcoded pixel coordinates, mimicking a fixed print layout. This is fragile: a div's declared `height` is not a hard clip — real content (e.g. 2+ team members, a co-advisor line) can overflow it and visually collide with the *next* absolutely-positioned div, since neither div's position adapts to the other's actual content length. **Screen screenshots (`Page.captureScreenshot`) do not reliably catch this** — Chrome's print media (`Page.printToPDF`) can render totally differently (different effective page width under `@page` margins, different pagination) than the normal screen view, so a layout that "looks fine" in a screenshot can still overlap or spill onto a spurious blank second page when actually printed. Verify print-sensitive changes to these files by rendering to PDF (`Page.printToPDF` via CDP) and inspecting each page image, not just a screenshot. When trimming empty vertical space, moving one `apDiv#` up without moving the ones below it by the same amount reliably reintroduces overlap — treat each pixel adjustment as one data point, not a general rule, since it depends on that specific project's content length (team member count, co-advisor presence, etc.). For **new** print forms, prefer normal document flow (no `position:absolute`) for anything below the letterhead — see `report/evaluationform4.php`, which only keeps the logo/title absolutely positioned and lets the info table, scoring table, and footer flow normally, eliminating this whole bug class.

### TH SarabunPSK Font Is Not Installed on This Dev Machine
All the print forms above use `font-family: TH SarabunPSK`. This font is **not present** in `C:\Windows\Fonts` on the dev machine, so any local browser-based rendering (screenshots or `Page.printToPDF`) silently falls back to a substitute font with different character widths — this can cause text to wrap differently (or overlap) in local testing than it will on a machine that actually has the font installed. Treat any *newly discovered* wrapping-related overlap found only through local PDF rendering with suspicion — cross-check against an actual screenshot/print from the live server (which has the font) before treating it as a real bug to fix.

### Write Endpoints Can Silently No-Op Their Own Session Checks
`project/registerproject2.php` filtered by `$_SESSION['iduser']` but never called `session_start()` — meaning `$_SESSION` was always empty and the ownership check silently always failed (or, before the check existed, was silently never applied at all — an IDOR: anyone could register project 2 for any project by knowing its ID). Every page that reads `$_SESSION` must call `session_start()` itself; `change.php` does not do this. Grep for `session_start()` before trusting that a `$_SESSION`-based check in a `project/`, `news/`, etc. action handler actually works.

### `report/big3.php` Fans Out to Multiple Evaluation-Form Copies via Iframes
`report/big3.php` (loaded from officer's "พิมพ์ใบประเมินการสอบ" → `shows5.php`) doesn't render a single form — it embeds one `<iframe>` per relevant person (advisor, chair, each committee member, co-advisor), each pointed at a print-form file (`evaluationform-2.php`, `evaluationform2-2.php`, `evaluationform3.php`/`evaluationform3-2.php` for internal reviewers, `evaluationform4.php` for an external co-advisor) with that person's name passed via `?namee=`. When changing what a specific reviewer type sees, edit the target file **and** the matching `if(...)` block in `big3.php` that decides whether/what to embed for them — the file alone isn't the whole picture.

### News Announcements Support an Optional Image, Not Just a PDF
`news.image_news varchar(150)` (added this session, alongside the pre-existing `news.pdf_news`) stores an optional image attachment, uploaded via the same hidden-iframe pattern as the PDF (`news/uploadnewsimage.php`, mirroring `news/uploadnews.php`). Displayed as a thumbnail in `news/shownews.php`, full-width in `news/viewnews.php`, and as a `[รูปภาพ]` link next to `[PDF]` in `index.php`'s public news list. Always `!empty()`-check before rendering — most existing news rows have `image_news IS NULL`.

### Double-Submit Creates Duplicate "Pending" Rows That Then Duplicate List Rows
`project/submit100exam.php` (and siblings like it) `insert into exam` unconditionally on every call, with no check for an already-existing pending row for the same project/exam type. A double-click or a retried request creates two near-identical `exam` rows (same `id_project`, `id_typeexam`, `id_statusproject='20'`). Since `project/shows2.php` (officer's "รับเรื่องการสอบ" list) does `select ... from project,exam,... where exam.id_statusproject='20' AND exam.id_project=project.id_project`, a duplicate pending `exam` row makes the **same project appear twice** in that list — the bug surfaces as a UI list-duplication issue, but the real cause is upstream (no dedupe guard on insert), not the list query itself. When a list shows unexpected duplicate rows for one entity, check whether a JOIN is fanning out over duplicate child rows before assuming the list query itself is wrong.

### An Undefined-Variable Warning Inside an Inline `<script>` Block Doesn't Just Print Ugly Text — It Breaks the Whole Fragment
The "only assigned inside a conditional query loop" bug class (see above) is cosmetic when it happens in plain HTML — an ugly warning line appears on the page, everything else still works. But several fragments (`project/project.php`, `project/formeditproject.php`, `project/assignexam2.php`) interleave PHP directly inside a `<script>...</script>` block to generate JS (e.g. `if($statusproject=='1'){ ?>$("#s1").show();<? }`). When the interpolated variable is undefined there, PHP's `Warning: ... <br />` gets injected mid-script. The browser then fails to parse the *entire* script as JavaScript — jQuery's `.load()`/`.html()` throws `Uncaught SyntaxError: Unexpected token '<'` while trying to append the fragment, no `$(document).ready()` handler ever registers, and any function defined later in that same block (e.g. `assigningex2()`) throws `ReferenceError: ... is not defined` the moment a button tries to call it. The page can look almost blank with every button silently dead, which reads as a much bigger failure than a missing default value. Whenever a fragment builds JS via inline PHP, every variable it interpolates must have a guaranteed default (`$statusproject = '0';` before the query loop, `$t[0] = $t[0] ?? '';` after building an array from a query that might return 0 rows, etc.) — check this proactively in any fragment with PHP-inside-`<script>`, not just reactively when a console error is reported.

### `MAX(id)+1` ID Assignment Races Under Concurrent Requests
Several handlers (`regis/registerproject.php` for `id_project`/`id_user`, and similar `select max(id_x) from x` + `+1` patterns elsewhere) assign primary keys by reading the current max and incrementing in PHP, with no `AUTO_INCREMENT` and no locking. Two concurrent submissions (e.g. several students registering within the same second) can both read the same max before either commits, then both attempt to `INSERT` the same id — one succeeds, one silently fails (`mysqli_query()`'s return value was never checked). This produced real corruption once: a batch of 5 concurrent registrations left 4 students with a `user` login but **no** `project` row (their insert silently lost the race), and the 5th ended up with a `project` row pointing at a `user` row that itself failed to insert (an orphaned `id_user` foreign key, `user.username` being unique made every later registration collide with the leftover orphan and fail too — a latent site-wide outage until the orphan rows were cleaned up). Fixed in `regis/registerproject.php` by wrapping the ID-assignment + insert block in a MySQL named lock (`GET_LOCK('registerproject_id_assignment', 10)` / `RELEASE_LOCK(...)`) to serialize it across requests, checking each `mysqli_query()` insert's return value before proceeding to the next dependent insert, and rolling back the `user` row if the `project` insert fails. Any other handler using the same `MAX(id)+1` pattern under realistic concurrent load has the same latent bug.

### Dev (MariaDB, lenient) and Prod (MySQL 8.0, STRICT) Disagree About `''` — Bugs Only Appear on the Server
Production runs Ubuntu + **MySQL 8.0** (`STRICT_TRANS_TABLES` + `NO_ZERO_DATE` on by default); the XAMPP dev box runs **MariaDB 10.4** with `sql_mode=NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION` — **no** `STRICT_TRANS_TABLES`. This codebase predates strict mode and inserts `''` for "not set". Dev silently coerces `''` into `0000-00-00`; production rejects the whole statement:
```
ERROR 1292 (22007): Incorrect date value: '' for column 'date_submitexam' at row 1
```
This bit for real: `project/submittitleexam.php`/`submit100exam.php`/`submit60exam.php` wrote `''` into `exam.date_submitexam` (`date NOT NULL`), so **every** exam submission failed on production while working perfectly in dev. Because the handlers didn't check `mysqli_query()`'s result, the project status still advanced — the student saw "ยื่นสอบแล้ว" but no `exam` row existed for `project/shows2.php` to join on, so the officer saw nothing. Fixed by writing a real Buddhist-era date (same format `project/approve*exam.php` uses). The other five `insert ... ''` sites target `varchar`/`text` columns, which strict mode accepts.

**The dev box now matches production**: `C:\xampp\mysql\bin\my.ini` sets `sql_mode=ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION` (backup of the old file sits beside it as `my.ini.bak-*`), so this bug class now fails locally instead of only on the server. `ONLY_FULL_GROUP_BY` is safe here — the codebase contains no `GROUP BY` at all. If you ever see a write succeed on dev but not production again, check `SELECT @@GLOBAL.sql_mode` on both first.

When a feature "works locally but silently does nothing on the server", suspect strict mode first: grep the handler for `''` (or `'0'`) being written into a `date`/`int` column. On a box that still has the lenient default, reproduce with `SET GLOBAL sql_mode='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';` before testing (restore it afterward).

Restarting XAMPP's MySQL to pick up a `my.ini` change: it runs as a plain process, not a Windows service, and `mysqladmin shutdown` reliably stops it accepting connections but then **hangs without exiting or writing anything further to `mysql_error.log`**. Once connections are refused the shutdown has effectively completed, so force-killing the process and relaunching `mysqld.exe --defaults-file=C:\xampp\mysql\bin\my.ini --standalone` is safe — `CHECK TABLE` came back OK on every table afterwards. (Restarting from the XAMPP Control Panel avoids the whole dance.) Unrelated `InnoDB: log sequence number ... is in the future` errors in that log predate this and are harmless: every application table is MyISAM. Note `exam/showexam.php` still treats `0000-00-00` as the "ยังไม่ได้ยื่นเรื่อง" sentinel for legacy rows — don't "clean up" that check without migrating the old data. See `UBUNTU_MIGRATION.md` §0.1.

## Git Rules
- `.gitignore` excludes: `25[0-9][0-9]-*/` academic year data folders, `*.sql`, `*.bak`, `*.log`
- Never commit `connectdatabase.php` credential changes or DB dumps
