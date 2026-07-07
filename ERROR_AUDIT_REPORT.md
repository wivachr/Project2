# Project2 — Error Audit Report

Full sweep of the codebase performed on 2026-07-07. Scope: PHP syntax check on all 330 `.php` files, a live HTTP fatal-error sweep of every page, a live warning/deprecation sweep, a phantom-table reference check (code referencing DB tables that don't exist), and a targeted re-check of the "variable only assigned inside a conditional loop" bug class fixed earlier in this session.

## Summary

| Check | Result |
|---|---|
| PHP syntax errors (`php -l`, all 330 files) | **0 errors** |
| Fatal errors (live HTTP sweep, all reachable pages) | **0**, aside from one orphaned/unreachable module |
| Phantom DB table references | 1 orphaned module found (`board`/`branch`) |
| New bug found & fixed this audit | 1 (wrong include path in `assignexam2.php`/`assignexam3.php`) |

The application is in good shape. Nothing found in this audit is reachable from the actual UI except the one path bug, which is now fixed.

## Fixed in this audit

### `project/assignexam2.php` / `project/assignexam3.php` — wrong include path
Line ~421/423 used `include('../../connectdatabase.php')` (one `../` too many) instead of `include('../connectdatabase.php')`, unlike the correct calls elsewhere in the same files and in the sibling `assignexam.php`. The broken include failed silently and printed a PHP warning in the middle of the ห้องสอบ (exam room) `<select>` dropdown. It didn't break the dropdown itself (an earlier, correct `connectdatabase.php` include earlier in the same script already set up `$connect`), but it did leak ugly warning HTML onto the page. Fixed both files.

## Known issue — orphaned/unreachable code (not fixed)

### `basicdata/branch.php` and its helpers (board/branch module)
- `basicdata/branch.php`
- `basicdata/add/addboard.php`, `basicdata/add/addbranch.php`
- `basicdata/del/delboard.php`, `basicdata/del/delbranch.php`
- `basicdata/edit/editboard.php`, `basicdata/edit/editbranch.php`

These reference `board` and `branch` database tables that **do not exist** in `projectinformationsystem` (only a `race` table exists, which is unrelated — it stores competition/contest entries, not this "board/branch" concept). Loading `branch.php` directly throws a fatal error.

**This was not fixed** because:
1. It is not linked from any menu, button, or link anywhere in the app (`admin.php`, `officer.php`, `teacher.php`, `student.php` never reference it) — a real user would never reach it.
2. Fixing it properly requires knowing what "board"/"branch" was supposed to become in the current schema (possibly superseded by `race`, or simply never finished) — a product decision, not a mechanical fix.

If you actually use this page (e.g., via a direct URL) or want it restored, let me know and I'll dig into what it should connect to.

### Orphaned FPDF demo files
`report/ex.php` and `report/jadoo.php` are unused example scripts bundled with the third-party FPDF library (not part of this application's own report set) — not linked from anywhere. `ex.php` throws a harmless "non-numeric value" warning from `srand(microtime()*1000000)`, a PHP-version quirk in FPDF's own demo code. No action needed; these aren't reachable.

### Old backup report templates
`report/evaluationform_backup.php` and `report/evaluationform_old.php` still contain the "undefined variable" bug pattern fixed elsewhere this session (`$master`/`$teacher`/`$coad`/etc. only assigned inside a conditional query loop). They are old backups, not referenced by any `big*.php` page or anywhere else in the app. Left untouched since they're dead code — safe to delete entirely if you'd like, rather than fix.

## Fixed earlier this session (for reference)

This audit re-verified all of the following remain fixed and did not regress:

- **Ajax-fragment relative-path bugs**: duplicate `_js/jquery.js` includes in 33 fragment files resolving against the wrong base URL; `project/upload.php` form action missing the `project/` prefix.
- **Teacher list silently hiding rows**: `teacher/showteacher.php` used an inner join on `division`, hiding 21 of 22 teachers with unset divisions — switched to `LEFT JOIN`.
- **`project/upload.php` fatal error**: closed the DB connection before its last query ran, silently killing the ทก.01 upload success callback.
- **~40 files with the "undefined variable" copy-paste bug**: `$coad`/`$scoad`/`$teacher`/`$steacher`/`$master`/`$smaster`/`$gum`/`$head`/`$subject`/`$credit` only ever assigned inside a conditional sub-query loop, so any project missing that particular assignment (no co-advisor, no ประธาน yet, etc.) triggered a warning. Fixed across `project/view*.php`, `project/*exam*.php`, `report/evaluationform*.php`, `report/big*.php`, `report/formsubmittitleexam*.php`, and others — see conversation history for the full file list.
- **Missing action buttons** ("ยื่นสอบหัวข้อ", "ยื่นสอบร้อย%", "พิมพ์ใบยื่นสอบหัวข้อ", "ลงทะเบียนโปรเจค 2"): backend logic existed and worked, but no UI element ever called it. Added the missing buttons.
- **`id_subject` truncating leading zeros**: was `int`, migrated to `varchar(15)` across `subject`/`registration`/`project` tables; restored known-correct leading zeros.
- **Blank lookup-table rows**: cleaned placeholder/blank rows out of `right`, `typeexam`, `statusproject` (kept `title.id_title=0`, which is an intentional "not selected" sentinel actively used by 21 real teacher records).
- **Excel bulk import**: added `.xlsx` import (via `xlsxreader.php`, a dependency-free `ZipArchive`+`SimpleXML` parser) for `student/importingstudent.php` and `register/importingregister.php`, replacing the old raw `.txt` import.
- **`$mdfive = md5($password)` dead code**: 6 `basicdata/*.php` files had this leftover line inside their `<script>` block; since `$password` is never set on a normal page load, the resulting PHP warning broke the JavaScript, causing "every page looks broken" symptoms in the admin section.

## Testing methodology notes

Fatal-error and warning sweeps were done via direct unauthenticated `GET` requests (no session, no POST body) to every `.php` file. This means:

- **AJAX action handlers** (`add*.php`, `edit*.php`, `del*.php`, `save*.php`, `assigning*.php`, `submit*.php`, `importing*.php`, upload targets, etc.) reported "undefined variable/array key" warnings for their expected form fields (e.g. `$password`, `$nameproject`, `$fileupload`) — this is **expected and benign**: these scripts only run when called with real data from the actual UI, and those warnings would not occur in normal use.
- Session-gated pages reported "Undefined array key `iduser`/`right`" — also expected, since no login occurred in this test.

These were filtered out of the findings above; only warnings/errors independent of missing test parameters were investigated and reported.
