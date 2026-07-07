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

## Git Rules
- `.gitignore` excludes: `25[0-9][0-9]-*/` folders (academic year data), `*.sql`, `*.bak`, `*.log`
- Never commit credential files or DB dumps
