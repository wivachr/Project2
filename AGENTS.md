# Project2 — Codex Instructions

## Project Overview
PHP web application for university academic project management (senior/thesis projects).
Stack: PHP 8.2, MySQL (MySQLi), jQuery, XAMPP local dev.
See `ERROR_AUDIT_REPORT.md` for a full audit of known issues, orphaned code, and fixes applied.

## Local Development
- Web root: `C:\xampp\htdocs\` — project must be symlinked or copied there to run
- Local URL: `http://localhost/` (officer.php, student.php, teacher.php, etc.)
- DB: MySQL via XAMPP, database name check via phpMyAdmin
- No build step — plain PHP files served directly
- The `zip` PHP extension must be enabled in `php.ini` (then restart Apache) for `.xlsx` import features (`xlsxreader.php`)
- `short_open_tag` must be `On` in php.ini — 258 files use bare `<? ... ?>` tags. XAMPP defaults to `On`; Ubuntu/Debian defaults to `Off`, which makes every page print raw PHP source instead of running it. See `UBUNTU_MIGRATION.md` §0

## Repository
- GitHub: https://github.com/wivachr/Project2.git
- Branch: `main`

## File Structure
- `officer.php` — admin portal (sidebar with jQuery `.load()` fragment loading)
- `student/`, `teacher/`, `project/`, `exam/`, `report/` — feature modules loaded as fragments
- `headofdepartment/` — change department head page
- `year/` — change academic year/semester
- `connectdatabase.php` — DB connection (included once per fragment; don't double-include)
- `change.php` — session/auth check included at top of every page
- `index.php`, `admin.php`, `officer.php`, `teacher.php`, `student.php` each duplicate the same outer banner/footer `<table>` skeleton (no shared include) — site-wide branding (logo, copyright, footer text) must be edited in all five files

## Key Patterns
- Pages loaded via jQuery `.load()` are HTML fragments — `<html>/<head>/<body>` tags are stripped, only body content renders
- Use `href="javascript:void(0);"` not `href="#"` in fragment pages (hash changes break navigation)
- Pagination and onclick links must not use bare `#`
- String parameters in JS `onclick` handlers must be quoted via `json_encode()` — bare PHP variables become JS identifiers
- Use `($_GET['page'] ?? null)` to avoid undefined index warnings
- SQL deletions must go child → parent (assignexam → committee → exam → manipulator → projecthistory → project)
- Relative paths inside a fragment (e.g. `action="upload.php"` in `project/formeditproject.php`) resolve against the **shell's** URL, not the fragment's own folder — always write the full path from site root (e.g. `project/upload.php`), or the request 404s
- File uploads (PDFs) use a hidden iframe + form targeting a script that echoes back `<script>window.parent.uploadok()</script>`; don't `mysqli_close($connect)` before that script's last query runs, or PHP 8.2 throws a fatal error and the callback never fires
- Bulk `.xlsx` imports (`student/importingstudent.php`, `register/importingregister.php`) share `xlsxreader.php` — a zero-dependency parser built on `ZipArchive` + `SimpleXML`. Always match text values against existing lookup tables and skip unmatched/duplicate rows; never auto-create lookup rows
- `subject.id_subject` / `registration.id_subject` / `project.id_subject` are `varchar(15)`, not numbers — codes carry meaningful leading zeros (e.g. `060243202`). Never `(int)` cast or do arithmetic on it
- `basicdata/branch.php` (and its add/del/edit helpers) is dead/orphaned — references `board`/`branch` tables that don't exist in the DB, and nothing in the app links to it. Don't spend time "fixing" it without first reading `ERROR_AUDIT_REPORT.md`
- "Transparent" PNG icon/logo files aren't always real alpha — some bake a checkerboard preview into the pixels instead. Check the IHDR color type (byte 25 of the file: 6 = RGBA, 2 = flat RGB with no alpha) before trusting the filename; if flat, use Pillow to threshold-and-zero the alpha on light pixels. Done for `image/logo_it.png` on `index.php`
- `index.php`'s manual-download button resolves its PDF dynamically via `select pdf_news from news where topic_news like '%...%'` rather than a hardcoded path, so re-uploading through `news/news.php` updates it automatically — reuse this pattern for any static content that needs to link to one specific news attachment
- **No write endpoint validates server-side** — `add*.php`/`edit*.php` handlers rely entirely on client-side JS and blindly `INSERT`/`UPDATE` whatever they receive. Worse, `year/changeyear.php` and `headofdepartment/changehead.php` `UPDATE` a singleton table with **no `WHERE` clause** — a blank/test request wipes the one row the whole site depends on. This already happened for real (`academicyear` got blanked, and `year/changeyear.php`'s unconditional `DELETE FROM teacherfreetime` wiped that table too). When touching any write endpoint, add `if(!isset($field) || trim($field)==="") { exit; }` at the top if it's not already there
- Some `$_SESSION`-based checks silently no-op because the file never calls `session_start()` (`change.php` doesn't do it for you) — e.g. `project/registerproject2.php` filtered by `$_SESSION['iduser']` with no `session_start()`, so the check always failed/was never applied. Grep for `session_start()` before trusting a session check works
- `select *` JOINs across multiple tables (`report/evaluationform*.php`, `report/chooseeva*.php`, `report/big3.php`) index the result positionally by **FROM-clause table order**, not WHERE order — `DESCRIBE` each table to compute the right offset rather than guessing (`report/chooseeva*.php` had `$rs[15]` where it needed `$rs[17]`, silently showing a blank status for every project)
- Print-form files (`report/formsubmittitleexam.php`, `formsubmit100exam.php`, `evaluationform*.php`) use fragile `position:absolute` div layouts that overlap when content is longer than expected (2+ team members, a co-advisor, etc.) — verify print-sensitive changes with `Page.printToPDF` (real print rendering), not `Page.captureScreenshot` (screen rendering can look fine while print output overlaps or spills onto a blank extra page). New print forms should avoid absolute positioning below the letterhead (see `evaluationform4.php`)
- TH SarabunPSK (the font all print forms use) isn't installed on this dev machine, so local PDF/screenshot rendering falls back to a substitute font with different text-wrap behavior — don't treat a wrapping-only overlap found only in local rendering as confirmed without checking a real screenshot from a machine that has the font
- `report/big3.php` embeds one `<iframe>` per reviewer (advisor/chair/committee/co-advisor) pointed at different print-form files — check its `if(...)` blocks too when changing what a specific reviewer type sees, not just the target file
- News announcements support an optional image (`news.image_news`), uploaded via `news/uploadnewsimage.php` mirroring the existing PDF upload (`news/uploadnews.php`) pattern — always `!empty()`-check before rendering
- Write endpoints that `insert` a "pending" row (e.g. `project/submit100exam.php`) don't guard against double-submit, so a double-click creates two duplicate rows — this then shows up as a *list* bug (the same project appearing twice in `project/shows2.php`) because that list JOINs on the duplicated child row, not because the list query is wrong. If a list shows unexplained duplicates, check for duplicate child rows before assuming the JOIN itself is broken

## Git Rules
- `.gitignore` excludes: `25[0-9][0-9]-*/` folders (academic year data), `*.sql`, `*.bak`, `*.log`
- Never commit credential files or DB dumps
