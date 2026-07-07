# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview
PHP 8.2 web application for university academic project management (senior/thesis projects).
Stack: PHP 8.2, MySQL (MySQLi), jQuery (legacy), XAMPP local dev. No build step — plain PHP served directly.

## Local Development
- Web root: `C:\xampp\htdocs\` — access via `http://localhost/Project2/`
- DB: MySQL via XAMPP, database name: `projectinformationsystem`
- Credentials in `connectdatabase.php`: root / (no password)
- No build step, no package manager, no test suite

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
- `report/` — PDF generation (FPDF library in `report/`) and screen reports
- `basicdata/` — lookup tables (faculty, title, type, room, etc.)
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

## Git Rules
- `.gitignore` excludes: `25[0-9][0-9]-*/` academic year data folders, `*.sql`, `*.bak`, `*.log`
- Never commit `connectdatabase.php` credential changes or DB dumps
