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
