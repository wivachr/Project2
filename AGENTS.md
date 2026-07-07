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

## Git Rules
- `.gitignore` excludes: `25[0-9][0-9]-*/` folders (academic year data), `*.sql`, `*.bak`, `*.log`
- Never commit credential files or DB dumps
