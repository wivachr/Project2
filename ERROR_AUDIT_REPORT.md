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

## Database changes log

Beyond code fixes, this session made the following live database changes:

**Schema:**
- `news.pdf_news VARCHAR(150)` added — stores the PDF attachment path for news announcements.
- `subject.id_subject`, `registration.id_subject`, `project.id_subject` changed from `int(10)` to `varchar(15)` — preserves meaningful leading zeros in subject codes (e.g. `060243202`). This reverted once mid-session when a stale `.sql` backup was restored; it was re-applied and re-verified against the code, which is the source of truth for this schema.

**Data cleanup:**
- Restored leading zeros on 12 subject codes (8-digit codes padded to 9; 6-digit codes intentionally left alone).
- Deleted blank/placeholder rows from `right`, `typeexam`, `statusproject`, `room`, `academictitle` (kept `title.id_title=0`, an intentional "not selected" sentinel used by 21 real teacher records).
- Deleted orphaned junk rows created by unvalidated "add" endpoints being hit during this session's testing sweep: 3 `teacher` rows, 1 `user` row, 42 `coadvisor` rows, 3 `news` rows, 3 `race` rows (all identifiable by a `0`/blank foreign key sentinel).
- `academicyear` was accidentally blanked by the same testing sweep (via `year/changeyear.php`, which had no input validation) and restored to `2569/1`.

**Data loss (acceptable — confirmed unused):**
- `teacherfreetime` (per-teacher availability schedule) was wiped to 0 rows — `year/changeyear.php` ran an unconditional `DELETE FROM teacherfreetime` on every call, including a blank test hit. **Confirmed with the project owner that this table/feature isn't actually used in practice**, so this data loss is not a real-world problem. The underlying bug (unvalidated destructive query) is still fixed regardless, to prevent similar accidents with tables that *do* matter.

**27 blank-name `project` rows** remain intentionally untouched — linked to real `user` accounts via the actual registration flow, flagged for the project owner's review rather than deleted unilaterally.

**Later session — schema/feature additions:**
- `news.image_news VARCHAR(150)` added — optional image attachment for news announcements, alongside the existing `pdf_news`. Uploaded via new `news/uploadnewsimage.php` (mirrors `news/uploadnews.php`'s hidden-iframe pattern), displayed in `news/shownews.php` (thumbnail), `news/viewnews.php` (full image), and `index.php` (public list link).
- `project/registerproject2.php` was missing `session_start()` entirely, so its `$_SESSION['iduser']` ownership filter never actually worked — anyone who knew/guessed a project ID could trigger project-2 registration for it. Fixed by adding `session_start()` and an explicit ownership check (`$parent['id_user']!=$_SESSION['iduser']` → reject).
- Added a same-semester registration guard to `registerproject2.php`: blocks registering project 2 until the academic year/semester has actually advanced past the parent project's own `year_project`/`semester_project`.
- Fixed `report/chooseeva.php`, `chooseeva2.php`, `chooseeva3.php` showing a permanently-blank "สถานะโครงงาน" — they read `$rs[15]` (`project.parent_project_id`) instead of `$rs[17]` (`statusproject.name_statusproject`) from a `select * from project,statusproject` join.
- Fixed `report/evaluationform3.php`/`evaluationform3-2.php` throwing "Undefined array key 1" for single-author projects (`$nstudent[1]` referenced without an `isset()` guard, same recurring bug class as elsewhere in this report).
- Added `report/evaluationform4.php` — a new print form for the external co-advisor's evaluation survey (10-item satisfaction questionnaire, distinct from the internal committee's scoring rubric used by `evaluationform3.php`), wired into `report/big3.php`'s co-advisor iframe. Built using normal document flow instead of the fragile `position:absolute` pattern the sibling forms use.
- `report/formsubmittitleexam.php` and `report/formsubmit100exam.php` had print-pagination bugs (content spilling onto a spurious near-blank second page, and an "ลงชื่อ...(ผู้ยื่นคำร้อง)" signature line overlapping the results-grid border) — fixed via `@page { size: A4; margin: 5mm; }`, removing redundant/duplicate signature-date lines, and re-tuning a couple of `position:absolute` offsets. See the "Print-Form Templates" and "TH SarabunPSK Font" notes in `CLAUDE.md` for the verification approach and a known local-testing blind spot (the font isn't installed on the dev machine, which can produce false-positive wrapping issues).

## Testing methodology notes

Fatal-error and warning sweeps were done via direct unauthenticated `GET` requests (no session, no POST body) to every `.php` file. This means:

- **AJAX action handlers** (`add*.php`, `edit*.php`, `del*.php`, `save*.php`, `assigning*.php`, `submit*.php`, `importing*.php`, upload targets, etc.) reported "undefined variable/array key" warnings for their expected form fields (e.g. `$password`, `$nameproject`, `$fileupload`) — this is **expected and benign**: these scripts only run when called with real data from the actual UI, and those warnings would not occur in normal use.
- Session-gated pages reported "Undefined array key `iduser`/`right`" — also expected, since no login occurred in this test.

These were filtered out of the findings above; only warnings/errors independent of missing test parameters were investigated and reported.
