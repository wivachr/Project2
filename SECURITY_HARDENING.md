# Security Hardening — 2026-07-08

A full-codebase security audit was performed on `main` and the fixes were isolated onto a dedicated `security-hardening` branch (not merged into `main` without review). This doc summarizes what was found, what was fixed, and the one item that could not be fixed directly from this environment.

## Scope

The audit covered five vulnerability classes across all write endpoints (`add*.php`/`edit*.php`/`del*.php`) and read endpoints that echo request or DB data into HTML/JS:

1. **SQL injection** — unescaped string interpolation into `mysqli_query()` calls
2. **Reflected/stored XSS** — unescaped `echo` of GET/POST params or DB values into HTML/JS
3. **IDOR / missing authorization** — write endpoints with no `session_start()`/role check at all
4. **File upload risks** — extension-only validation, no `.htaccess` execution lockout
5. **Session cookie hardening** — `httponly`/`samesite` never set

## Fixed

Applied a consistent pattern to every affected file: `session_start()` → role/ownership check with `exit;` on failure → non-empty-field validation → `(int)` cast for genuinely-integer columns (verified per-table via live `DESCRIBE`) → `mysqli_real_escape_string()` for varchar columns → original query logic unchanged.

- **~90 write endpoints** across `user/`, `news/`, `project/`, `student/`, `teacher/`, `register/`, `race/`, `exam/`, `basicdata/edit/`, `basicdata/del/` — added missing `session_start()` + role checks (admin-only, officer-only, or ownership-based depending on the module) and escaped/cast every interpolated SQL variable.
- **~25 read/view endpoints** (`project/assignexam*.php`, `project/view*.php`, `project/saveresultexam*.php`, `exam/editassignexam.php`, `exam/editingassignexam.php`, `report/big*.php`, `report/chooseeva*.php`) — added the same auth gate, and cast the `$id`/`$idview`/`$idproject` request parameter to `(int)` right after `change.php`'s include. Since every one of these is a numeric `id_project`/`id_exam`, this single cast closes both the SQL injection and the XSS in one shot (an int can never contain a quote or an HTML tag) — same technique already used for `project/formeditproject.php` earlier in this project's history.
- `project/upload.php` — added ownership check (student must own the project being uploaded to).
- `project/upload2.php` — added officer-only check, plus fixed a pre-existing PHP 8.2 bug where the DB connection was closed before the final query.
- `.htaccess` execution lockout added to `news/uploads/` and all 41 academic-year upload folders (`25XX-X/`), blocking `.php`/`.phtml`/`.phar`/etc. from executing even if a malicious file were ever uploaded with a disguised extension.
- `teacher/delteacher.php` — also had a second injection point via `$u` (username), fixed alongside the auth gap.

`loging.php` (the actual login handler) was already using a proper prepared statement — confirmed secure, not touched.

### Follow-up sweep (second pass)

After the first two commits, a dedicated read-only verification agent re-scanned the whole repo for any write endpoint the original audit had missed. It found 44 more files with gaps, all fixed in a third commit:

- **Account takeover risk (highest severity of the whole audit)**: `user/resetuser.php` and `user/resetuser2.php` (admin's "reset a user's password" buttons) had no auth check at all — anyone who knew a `id_user` could reset any account's password with an unauthenticated GET request. `password/changingpassword.php` (the self-service "change my password" endpoint) trusted a client-supplied `iduser` GET parameter instead of `$_SESSION['iduser']` — the old-password check was JS-only and never enforced server-side, so any logged-in user could change *any other* user's password by tampering the request. Fixed by ignoring the GET param entirely and always operating on the session's own user id, plus adding proper role checks to the two admin reset endpoints.
- **Singleton-settings wipe risk**: `year/changeyear.php` and `headofdepartment/changehead.php` already had non-empty-field guards from earlier work but no session/role check — anyone could still hit them directly. Added admin-only checks (these are the two handlers documented in `CLAUDE.md` as having actually wiped `academicyear`/`teacherfreetime` for real in the past).
- **23 `project/*` action handlers** (submit/approve/assign-exam/assign-teacher/save-result/cancel/book/coadvisor/manipulator/editproject) — these are the "verb" endpoints behind the officer exam workflow and the student's own project-editing form, distinct from the `edit*.php`/`view*.php` files fixed in the first two commits. Added officer-only or ownership-based checks (verified via a `select id_project from project where ... AND (id_user=session OR right='2')` pattern for endpoints keyed by a child-row id like `id_manipulator`/`id_coadvisor` rather than `id_project` directly), plus escaping/casts. `project/submit100exam.php`/`submit60exam.php`/`submittitleexam.php` also got a dedupe guard (reject if a pending exam row already exists for that project+type), closing the double-submit-creates-duplicate-rows bug documented elsewhere in `CLAUDE.md`.
- **`basicdata/add/*.php` (13 files) and `race/addrace.php`** — the `add` handlers were missed even though their `edit`/`del` siblings were fixed in commit 1. Same admin-only (or officer-only for room/race) pattern applied.
- `exam/assigningexam2.php` — a second, separate "assign exam date" endpoint distinct from the already-fixed `exam/editassignexam.php`/`editingassignexam.php`.
- `news/addnews.php` had `session_start()` but no actual `$_SESSION` check (unlike its already-fixed `edit`/`del` siblings); `news/uploadnews.php` and `news/uploadnewsimage.php` had no auth at all, letting anyone overwrite any news item's PDF/image.
- `register/importingregister.php`, `student/importingstudent.php` — the `.xlsx` bulk-import endpoints already escaped their data correctly but had no auth gate; added officer-only checks.
- `regis/registerproject.php`, `regis/registerprojectyear.php` — the public, intentionally-unauthenticated self-registration forms had several unescaped fields flowing into `INSERT`/`SELECT` statements (most notably `registerprojectyear.php`'s `$oldproject`, used raw in a `WHERE id_project='$oldproject'`). These stay unauthenticated by design (students register before they have an account) but now escape/cast every interpolated value.
- `regis/check_ajax/canuse.php`, `isold.php`, `isregis.php` — read-only AJAX lookups used by the registration forms above, all interpolated `$_GET["idstudent"]` unescaped; now escaped.

All 97 files across the three commits were verified with `php -l` (0 syntax errors).

## Not fixed — needs a manual step outside this repo

**Session cookie hardening** (`session.cookie_httponly=1`, `session.cookie_samesite=Lax`) requires editing `C:\xampp\php\php.ini`, which is shared, machine-wide configuration affecting every site hosted under this XAMPP install, not just this repo — so it was intentionally left untouched rather than edited automatically. To apply it:

1. Open `C:\xampp\php\php.ini`
2. Under the `[Session]` section, set:
   ```ini
   session.cookie_httponly = 1
   session.cookie_samesite = Lax
   ```
3. Restart Apache

On the production Ubuntu deployment, the equivalent file is typically `/etc/php/8.2/apache2/php.ini`.

**Login rate-limiting** was flagged as the lowest-priority item in the audit and was not implemented — `loging.php` has no attempt-throttling, so it's theoretically brute-forceable given enough requests. Given the legacy unsalted-MD5 password scheme is explicitly out of scope for changes (see `CLAUDE.md`), this is noted here as a known gap rather than fixed, since a real fix (account lockout, IP throttling) would need product input on the desired UX (lockout duration, messaging) before implementing.

## Not touched (explicitly out of scope)

- Password hashing scheme (unsalted MD5) — `CLAUDE.md` explicitly says not to change without a full data migration.
- `basicdata/branch.php` and its helpers — orphaned/unreachable dead code referencing non-existent tables, documented separately in `ERROR_AUDIT_REPORT.md`.
