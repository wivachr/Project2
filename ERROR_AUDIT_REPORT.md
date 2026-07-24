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

## Session — 2026-07-09 (live bug reports + data incident response)

Reactive fixes driven by real screenshots/console errors from the officer/student portals in daily use, plus a production data-integrity incident found while investigating one of them.

### Code fixes
- **`project/project.php`** — `$statusproject` was only ever assigned inside the `while` loop over the student's own `project` rows; a student with no project row yet (or an empty/expired session) left it undefined, and the resulting PHP warning was injected into the middle of an inline `<script>` block, breaking jQuery's `.load()` with `Uncaught SyntaxError: Unexpected token '<'`. Defaulted `$statusproject = '0'` before the query, null-coalesced `$_SESSION['iduser']`, and added a friendly "session expired" / "no project yet, please register" message instead of a silent blank panel.
- **`project/formeditproject.php`** — `$gum`, `$idgum`, `$idco`, `$idmaster` were only ever assigned inside their respective committee/co-advisor/chair query loops, so a project without a full committee assigned yet threw undefined-variable warnings. Defaulted them (`array()`/`''`) alongside the existing `$coad`/`$master` init, and fixed `if($gum!="")` → `if(!empty($gum))` since an empty array `!= ""` is actually `true` in PHP — the original undefined-variable warning had been silently keeping that condition working by accident.
- **`project/assignexam2.php`** — `$t[]` (committee members excluding the advisor) was never initialized when a project has no ประธาน/กรรมการ assigned yet, so `$t[0]`/`$t[1]`/`$t[2]` threw undefined-array warnings inside the inline `<script>` block that defines `assigningex2()`. Same failure mode as `project/project.php`: the script never finished parsing, so the function was never defined, and clicking "จัดสอบ" threw `ReferenceError: assigningex2 is not defined`. Initialized `$t = array()` and defaulted indices 0–2 to `''`.
- **`report/evaluationform3.php` / `evaluationform3-2.php`** — `$nstudent[1]` (second team member's name, used to label the score-table header) was referenced unguarded; single-author projects threw "Undefined array key 1" straight into the printed form. Defaulted with `?? ''`. Note: an earlier audit entry above claims this was already fixed — it wasn't (verified via `git log` on both files); this session is the actual fix.
- **`regis/registerproject.php`** — see "Race-condition incident" below; hardened with a `GET_LOCK`/`RELEASE_LOCK` critical section, per-insert error checking, and rollback of the orphaned `user` row if the `project` insert fails.

### Race-condition incident: orphaned registrations blocking all new sign-ups
While repairing the `project/project.php` warning above for one student, traced their "no project found" down to real data corruption: `regis/registerproject.php` assigned both `id_project` and `id_user` via `select max(id)+1` with no locking and no `mysqli_query()` error checking. A batch of ~5 concurrent registrations collided:
- 4 students ended up with a working `user` login but **no** `project` row at all (their insert lost the race and failed silently) — their submitted data was never persisted anywhere, unrecoverable.
- 1 project (`691001`) ended up pointing at a `user.id_user` that itself had failed to insert (an orphaned FK) — repaired by repointing it to the correct existing login account.
- Because `user.username` is unique and equals the project id by convention, the leftover orphaned accounts (`691002`–`691005`) then blocked **every subsequent registration** (`Duplicate entry '691002' for key 'username'`) until they were deleted — this was a live, site-wide outage, not just a display bug for one student.

Fixed the root cause in `regis/registerproject.php` (see Code fixes above). Data repair: repointed `project.id_user` for `691001`; deleted the 4 orphaned `user` rows with no project data. The `student` master roster table was never touched by any of this.

### Test-data cleanup
At the project owner's request, deleted all `69xxxx`-prefixed projects (`691001`–`691003`, `692001` — placeholder/test registrations created while diagnosing the above) and everything downstream in FK-safe order: `assignexam` → `exam` → `committee` → `manipulator` → `projecthistory` → `project` → `user`. `student` table untouched throughout.

### Administrative action
Changed `academicyear` from `2569/2` back to `2569/1` at the project owner's request (direct `UPDATE`, mirroring `year/changeyear.php`'s own logic; skipped its unconditional `DELETE FROM teacherfreetime` since that table was already empty, making the outcome identical either way).

## Session — 2026-07-23/24 ("เจ้าหน้าที่ไม่เห็นการยื่นสอบ" recurrence — full root-cause hunt)

The "student submits a title/100% exam request but the officer's รับเรื่องการสอบ list never shows it" bug came back. Traced to **two** distinct defects, both in the three submit handlers, which had never been touched since the initial commit and were left out of the earlier ID-assignment hardening pass.

### Defect 1 — unguarded insert + status advanced regardless (commit `7388927`)
`project/submittitleexam.php`, `submit100exam.php`, `submit60exam.php` assigned `id_exam` via `select max(id_exam)+1` with no lock, never checked the `insert into exam` result, and ran `update project set id_statusproject=...` unconditionally afterward. Any failed insert (PK collision under concurrent submissions, or an empty/invalid `idproject` landing the row at `id_project=0`) left the project looking submitted with no `exam` row for `project/shows2.php` to join on — invisible to the officer. The same unguarded insert also produced duplicate pending rows on double-submit (the same project listed twice).

Fixed on all three, mirroring `regis/registerproject.php`: `session_start()` + ownership check (project must exist and belong to the logged-in student — also closes an IDOR where anyone could submit for any project id), `GET_LOCK('exam_id_assignment',10)` around id-assignment+insert, a dedupe guard rejecting a second pending (status 20) row for the same exam type, and checking the insert result before advancing project status.

### Defect 2 — `''` is not a valid DATE under MySQL 8.0 strict mode (commit `b4be774`) — the actual recurrence
Production has been migrated to **Ubuntu + MySQL 8.0.46**, which enables `STRICT_TRANS_TABLES` + `NO_ZERO_DATE` by default. All three handlers inserted `''` into `exam.date_submitexam` (`date NOT NULL`). The XAMPP/MariaDB dev box (`sql_mode=NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION`, **no** `STRICT_TRANS_TABLES`) silently coerced that to `0000-00-00`; production rejects it outright with `ERROR 1292 (22007) Incorrect date value: '' for column 'date_submitexam'`. So **every** submission failed on the server — 100%, not intermittently — and (before Defect 1 was fixed) the status still advanced, giving exactly the reported symptom.

Confirmed by importing a fresh production dump (generated 2026-07-24 02:34 from the Ubuntu box) into a scratch database: `CHECKSUM TABLE` on `project`, `exam`, and `user` matched the previous state exactly — **not one new `exam` row had been recorded**, consistent with every submission failing. The rejection was then reproduced directly by running the original INSERT under MySQL 8.0's default `sql_mode`.

Fixed by writing a real Buddhist-era date (`$year` from `academicyear` + current month/day, the same format `project/approve*exam.php` already uses for this column) instead of `''`. No schema change required; the other five `insert ... ''` sites in the codebase target `varchar`/`text` columns, which strict mode accepts. Verified end-to-end over HTTP with the local server temporarily switched to production's exact `sql_mode`: submit inserts one row dated `2569-07-24` at status 20, advances the project to status 2, and the project appears in `shows2.php`; repeat-submit, wrong-owner, and unauthenticated calls are all rejected with no junk row created. All test data and the `sql_mode` change were reverted afterward.

Documented in `UBUNTU_MIGRATION.md` §0.1 (the original migration audit missed `sql_mode` entirely) and `CLAUDE.md`.

### Known residue not yet cleaned
The live data still carries the historical fallout of Defect 1: `exam` rows with `id_project=0` (largely artifacts of the unauthenticated GET sweep described below, which used to create a junk row per call — the new guards make that impossible), and duplicate pending (status 20) rows for the same project+exam type. These are invisible-or-duplicated entries in the officer's list; cleaning them requires re-running the diagnostics against current production data rather than reusing any earlier row list, and previewing with `SELECT` before any `DELETE`.

**Not yet deployed:** both fixes are committed locally only. Production keeps failing every submission until the updated `project/submit*exam.php` files are deployed to the Ubuntu server.

## Testing methodology notes

Fatal-error and warning sweeps were done via direct unauthenticated `GET` requests (no session, no POST body) to every `.php` file. This means:

- **AJAX action handlers** (`add*.php`, `edit*.php`, `del*.php`, `save*.php`, `assigning*.php`, `submit*.php`, `importing*.php`, upload targets, etc.) reported "undefined variable/array key" warnings for their expected form fields (e.g. `$password`, `$nameproject`, `$fileupload`) — this is **expected and benign**: these scripts only run when called with real data from the actual UI, and those warnings would not occur in normal use.
- Session-gated pages reported "Undefined array key `iduser`/`right`" — also expected, since no login occurred in this test.

These were filtered out of the findings above; only warnings/errors independent of missing test parameters were investigated and reported.
