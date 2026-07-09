# วิเคราะห์ปัญหาและแนวทางพัฒนาระบบ (System Analysis & Roadmap)

จัดทำ: 2026-07-08 — จากการสแกนโค้ดจริงทั้ง 330 ไฟล์ PHP (~33,000 บรรทัด ไม่รวม FPDF)
เอกสารนี้ต่อยอดจาก `ERROR_AUDIT_REPORT.md` ซึ่งเน้น "บั๊กที่พังอยู่ตอนนี้" — ฉบับนี้เน้น **ความเสี่ยงเชิงโครงสร้าง** และ **ทิศทางการพัฒนาต่อ**

---

## 1. สรุปภาพรวม

ระบบทำงานได้จริงและบั๊กระดับ fatal ถูกแก้ไปแล้ว แต่โครงสร้างเป็นสถาปัตยกรรมยุค PHP 4/5 (ประมาณปี 2553 ตามโฟลเดอร์ข้อมูลเก่าสุด) ที่ยกมารันบน PHP 8.2 ปัญหาหลักแบ่งเป็น 3 กลุ่ม:

| กลุ่ม | ความรุนแรง | ตัวอย่าง |
|---|---|---|
| ความปลอดภัย | **สูงมาก** | ไม่มีการตรวจสิทธิ์ในหน้า module, SQL injection, MD5, อัปโหลดไฟล์ไม่ปลอดภัย |
| โครงสร้างโค้ด | ปานกลาง–สูง | โค้ดซ้ำซ้อนมาก, ไม่มี layout กลาง, `change.php` extract ตัวแปรอัตโนมัติ |
| ความยั่งยืน | ปานกลาง | ไม่มีเทส, ไม่มี migration, HTML ยุคเก่า, ไฟล์อัปโหลดปนอยู่ใน webroot |

---

## 2. ปัญหาด้านความปลอดภัย (เรียงตามความเร่งด่วน)

### 2.1 ไม่มีการตรวจสิทธิ์ (Broken Access Control) — วิกฤตที่สุด

หน้า fragment ใน `project/`, `student/`, `teacher/` ฯลฯ **ไม่มีการเช็ค session เลย** เช่น `project/shows2.php` เริ่มด้วย `include('../change.php')` แล้ว query ทันที ใครก็ตามที่รู้ URL สามารถ:

- เปิด `http://localhost/Project2/project/shows2.php` ดูข้อมูลทั้งหมดโดยไม่ล็อกอิน
- ยิงตรงไปที่ `add*.php` / `edit*.php` / `del*.php` เพื่อเพิ่ม/แก้/ลบข้อมูลได้ทันที (เหตุการณ์ `academicyear` ถูกล้างและ `teacherfreetime` หายทั้งตาราง คือหลักฐานว่าเกิดขึ้นได้จริง)

การเช็ค `$_SESSION['right']` มีอยู่แค่ในหน้า shell 4 ไฟล์ ซึ่งป้องกันแค่ "เมนู" ไม่ได้ป้องกัน "ข้อมูล"

**ทางแก้:** สร้าง `authguard.php` กลางหนึ่งไฟล์:

```php
<?php // authguard.php
session_start();
function require_right(array $allowed) {
    if (!isset($_SESSION['right']) || !in_array((int)$_SESSION['right'], $allowed, true)) {
        http_response_code(403); exit('forbidden');
    }
}
```

แล้ว include ไว้บรรทัดแรกของ fragment/handler ทุกไฟล์ เช่น `require_right([1,2]);` (admin+officer) — ทำแบบไล่ทีละโมดูลได้ ไม่ต้อง rewrite

### 2.2 SQL Injection

พบ **~49 จุด** ที่ฝังตัวแปรจาก request ลง SQL ตรง ๆ (`"...where id_project='$idproject'"`) ขณะที่ prepared statement มีใช้แค่ใน `loging.php` ไฟล์เดียว และ escape ใช้ใน 6 ไฟล์ เมื่อรวมกับข้อ 2.1 (ยิงได้โดยไม่ล็อกอิน) = ดึง/แก้ข้อมูลทั้งฐานได้จากภายนอก

**ทางแก้:** ไล่แปลงเฉพาะ query ที่รับค่าจากผู้ใช้เป็น prepared statement (แพทเทิร์นเดียวกับ `loging.php` ที่ทำไว้แล้ว) เริ่มจาก handler เขียนข้อมูล (`add/edit/del/save/assigning/submit`) ก่อน แล้วค่อยตามด้วยหน้าอ่าน

### 2.3 รหัสผ่าน MD5 ไม่มี salt

MD5 ถูก crack ด้วย rainbow table ได้ทันที **ทางแก้แบบไม่ต้อง reset รหัสผู้ใช้:**

1. แปลงค่าในตารางครั้งเดียว: `password = password_hash(md5_เดิม)` (wrap ชั้นเดียว)
2. `loging.php` ตรวจด้วย `password_verify(md5($password), $hash)`
3. หลังล็อกอินสำเร็จ rehash เป็น `password_hash($password)` ตรง ๆ (ทยอยหลุดจาก MD5 เอง)
4. เพิ่มคอลัมน์ `password` เป็น `VARCHAR(255)` ก่อน (bcrypt ยาว 60 ตัวอักษร)

### 2.4 อัปโหลดไฟล์ไม่ปลอดภัย

`project/upload.php` เช็คแค่นามสกุลจาก `pathinfo()` และใช้ `$idproject` จาก request ประกอบ path ตรง ๆ (`"../".$dir."/".$idproject.".pdf"`) — เสี่ยง path traversal (`idproject=../../foo`) และไม่ตรวจเนื้อไฟล์จริง อีกทั้ง `mkdir(..., 0777)` และไฟล์เสิร์ฟตรงจาก webroot

**ทางแก้:** (ก) `$idproject = basename($idproject)` + ตรวจว่าเป็นรหัสโปรเจกต์จริงใน DB ก่อน (ข) ตรวจ magic bytes `%PDF` ด้วย `finfo` (ค) permission 0755 (ง) ระยะยาวย้ายโฟลเดอร์ `25xx-x/` ออกนอก webroot แล้วเสิร์ฟผ่านสคริปต์ที่เช็คสิทธิ์

### 2.5 XSS (Cross-Site Scripting)

มีการ `echo` ค่าจาก DB/request โดยไม่ escape เกือบทั้งระบบ (`htmlspecialchars` มีใน 19 จาก 330 ไฟล์) เช่น ชื่อโปรเจกต์ที่นักศึกษากรอกจะถูก render ดิบในหน้าอาจารย์/เจ้าหน้าที่ **ทางแก้:** helper สั้น ๆ `function h($s){return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');}` ใน include กลาง แล้วไล่ครอบจุด output ค่าที่ผู้ใช้ป้อน

### 2.6 อื่น ๆ

- **ไม่มี CSRF token** — ทุก action เป็น GET/POST ธรรมดา ปลอมฟอร์มข้ามเว็บได้
- **`change.php`** คือ register_globals จำลอง แม้จะมี blocklist แล้ว แต่ทำให้ตัวแปรทุกตัวในทุกไฟล์อาจถูก override จาก query string — ระยะยาวควรเลิกใช้ เปลี่ยนเป็นอ่าน `$_POST['x'] ?? null` ตรง ๆ ทีละไฟล์ที่เข้าไปแตะ
- **Validation ฝั่ง server** ยังขาดใน handler ที่ไม่ได้ retrofit (ทำไปแล้ว ~21 จาก guard pattern ใน CLAUDE.md) — ทำต่อให้ครบเมื่อแตะไฟล์นั้น ๆ

---

## 3. ปัญหาด้านโครงสร้างโค้ด

### 3.1 ไม่มี layout กลาง
Header/footer/branding ซ้ำกัน 5 ไฟล์ (`index.php` + 4 portal) ต้องแก้พร้อมกันเสมอ → แตกเป็น `header.inc.php` / `footer.inc.php` แล้ว include — งานครึ่งวัน ลดความผิดพลาดถาวร

### 3.2 โค้ดซ้ำซ้อนสูง
`shows2–shows8.php` และชุด `add/edit/del` ของแต่ละโมดูลคือไฟล์เดียวกันที่ copy แล้วแก้บางบรรทัด บั๊กหนึ่งตัวจึงต้องแก้ 5–8 ที่ (ตัวอย่างจริง: บั๊ก undefined variable ที่ต้องแก้ ~40 ไฟล์) → เมื่อแตะโมดูลไหน ให้ดึงส่วนซ้ำ (query โปรเจกต์+กรรมการ, ตารางรายการ) เป็นฟังก์ชันใน include กลาง

### 3.3 ไฟล์ใหญ่ปนทุกอย่าง
`project/formeditproject.php` 1,416 บรรทัด, `officer.php` 1,151 บรรทัด — HTML + SQL + JS ปนกัน แก้ยากและเสี่ยง regression → ไม่ต้องรื้อทันที แต่ตั้งกติกา "ไฟล์ใหม่แยก logic ออกจาก markup"

### 3.4 Short open tags และโค้ดตาย
254 ไฟล์ใช้ `<?` (พังทันทีถ้า host ปิด `short_open_tag`) → แปลงเป็น `<?php` ด้วยสคริปต์ครั้งเดียว และลบโค้ดตายที่ audit ระบุแล้ว (`basicdata/branch*` ถ้ายืนยันไม่ใช้, `report/evaluationform_backup.php`, `_old.php`, FPDF demo)

### 3.5 Frontend ยุคเก่า
Layout ด้วย `<table>` + attribute เลิกใช้แล้ว (`bgcolor`, `background`, `align`), jQuery เวอร์ชันเก่า, ไม่ responsive (ใช้บนมือถือแทบไม่ได้), การนำทางด้วย `.load()` ทำให้ปุ่ม back/refresh/bookmark ใช้ไม่ได้ → เป็นงาน Phase 3 (ดู roadmap)

---

## 4. ปัญหาด้านข้อมูลและการดูแลระบบ

- **ไม่มี FK constraint ใน DB** — ลำดับการลบต้องจำเอง (`assignexam → committee → exam → ...`) พลาดเมื่อไรได้ orphan rows เมื่อนั้น → เพิ่ม FK จริงใน schema (ต้อง cleanup orphan เดิมก่อน)
- **ไม่มี schema migration / backup อัตโนมัติ** — เหตุการณ์ ".sql เก่าถูก restore ทับจน schema ถอยหลัง" เคยเกิดแล้ว → เก็บ `schema.sql` ฉบับปัจจุบันไว้ใน repo (โครงสร้างอย่างเดียว ไม่มีข้อมูล — ไม่ขัด .gitignore) + ตั้ง `mysqldump` รายวันด้วย Task Scheduler
- **ตาราง singleton ไม่มีกันพลาด** — เพิ่ม `WHERE` clause และ validation ให้ `year/changeyear.php`, `headofdepartment/changehead.php` (ทำแล้วบางส่วน) และพิจารณาใส่ trigger/backup ก่อน UPDATE
- **27 แถว project ชื่อว่าง** ยังค้างรอตัดสินใจ — ควรเคลียร์ และเพิ่ม validation ที่จุดลงทะเบียนไม่ให้เกิดใหม่
- **ไม่มี test ใด ๆ** — อย่างน้อยควรมีสคริปต์ smoke test (ยิง GET ทุกหน้าเช็ค fatal error แบบที่ audit ทำ) รันก่อน deploy ทุกครั้ง

---

## 5. Roadmap เสนอ (เรียงตามลำดับทำจริง)

### Phase 1 — อุดช่องโหว่ (1–2 สัปดาห์, ไม่กระทบผู้ใช้)
1. `authguard.php` + ไล่ใส่ `require_right()` ทุก fragment/handler *(สำคัญสุด)*
2. Prepared statements ใน handler เขียนข้อมูลทั้งหมด
3. Migrate รหัสผ่าน MD5 → `password_hash` (วิธี wrap ตามข้อ 2.3)
4. Hardening `upload.php`/`upload2.php`/`uploadnews.php` (basename + finfo + ตรวจ id ใน DB)
5. `h()` helper + escape จุด output ข้อมูลผู้ใช้ในหน้าที่คนนอกเห็น (login page, news)

### Phase 2 — ลดหนี้เทคนิค (ทยอยทำ 1–2 เดือน)
6. แตก header/footer เป็น include กลาง (5 ไฟล์ shell)
7. แปลง `<?` → `<?php` ทั้ง repo + ลบโค้ดตาย
8. CSRF token ในฟอร์มเขียนข้อมูล
9. `schema.sql` เข้า repo + backup DB อัตโนมัติรายวัน
10. เพิ่ม FK constraints (หลัง cleanup orphan)
11. Smoke-test script รันก่อน deploy
12. Prepared statements ส่วนที่เหลือ + เลิกพึ่ง `change.php` ในไฟล์ที่แตะ

### Phase 3 — ปรับปรุงเชิงโครงสร้าง (เมื่อมีเวลา/งบ — เลือกทางใดทางหนึ่ง)
- **ทางประหยัด:** คง PHP เดิม แต่จัดระเบียบ — router ไฟล์เดียว, template แยก, Bootstrap/Tailwind แทน table layout, mysqli → PDO wrapper กลาง
- **ทางยกเครื่อง:** เขียนใหม่บน framework (Laravel/CodeIgniter 4) โดยใช้ DB schema เดิม ทำทีละ portal (เริ่มจาก student ซึ่งเล็กสุด) รันคู่ระบบเดิมจนครบ

> ข้อแนะนำ: อย่าข้ามไป Phase 3 ก่อนจบ Phase 1 — ระบบเขียนใหม่ที่ยังไม่เสร็จ ป้องกันข้อมูลจริงที่รั่วอยู่วันนี้ไม่ได้

---

## 6. สิ่งที่ทำได้ดีอยู่แล้ว (คงไว้)

- `loging.php` ใช้ prepared statement แล้ว — ใช้เป็นต้นแบบให้ไฟล์อื่น
- Guard validation retrofit ~21 handlers + แพทเทิร์นระบุไว้ใน `CLAUDE.md` แล้ว
- `xlsxreader.php` ไม่พึ่ง dependency ภายนอก และ import มีการ validate ค่ากับ lookup table
- แพทเทิร์น "query ข่าวด้วย topic_news" ทำให้เนื้อหา static อัปเดตเองได้
- มี git และ `.gitignore` กันข้อมูลจริง/credential หลุดเข้า repo แล้ว
