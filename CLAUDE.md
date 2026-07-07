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

## Git Rules
- `.gitignore` excludes: `25[0-9][0-9]-*/` academic year data folders, `*.sql`, `*.bak`, `*.log`
- Never commit `connectdatabase.php` credential changes or DB dumps
