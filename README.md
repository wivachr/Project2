# ระบบสารสนเทศโครงงานนักศึกษา (Project Information System)

ระบบจัดการโครงงาน/วิทยานิพนธ์ระดับอุดมศึกษา พัฒนาด้วย PHP + MySQL ทำงานบน XAMPP

## Tech Stack

- **Backend:** PHP 8.2 (MySQLi)
- **Frontend:** HTML, CSS, jQuery (legacy)
- **Database:** MySQL
- **Dev Server:** XAMPP

## เอกสารเพิ่มเติม

- [CLAUDE.md](CLAUDE.md) — architecture, pattern, และ gotcha เชิงลึกสำหรับนักพัฒนา
- [AGENTS.md](AGENTS.md) — สรุปแบบย่อของ CLAUDE.md สำหรับ Codex/AI agent อื่น
- [SITE_STRUCTURE.md](SITE_STRUCTURE.md) — แผนผัง navigation เต็มรูปแบบของทั้ง 4 portal (เมนูไหนโหลด fragment ไหน)
- [ERROR_AUDIT_REPORT.md](ERROR_AUDIT_REPORT.md) — รายงานตรวจสอบปัญหาที่พบและแก้ไขทั้งหมด
- [SYSTEM_ANALYSIS_AND_ROADMAP.md](SYSTEM_ANALYSIS_AND_ROADMAP.md) — วิเคราะห์ความเสี่ยงเชิงโครงสร้าง/ความปลอดภัย และ roadmap การพัฒนาต่อ
- [UBUNTU_MIGRATION.md](UBUNTU_MIGRATION.md) — แผนเตรียมย้ายระบบจาก Windows/XAMPP ไปยัง Ubuntu server

## การติดตั้งและรัน

1. ติดตั้ง [XAMPP](https://www.apachefriends.org/) และเปิด Apache + MySQL
2. วางโปรเจกต์ไว้ที่ `C:\xampp\htdocs\Project2\`
3. เปิดใช้งาน extension `zip` ใน `php.ini` (`extension=zip`) แล้ว restart Apache — จำเป็นสำหรับฟีเจอร์นำเข้าไฟล์ `.xlsx`
4. Import ฐานข้อมูลผ่าน phpMyAdmin:
   - สร้าง database ชื่อ `projectinformationsystem`
   - Import ไฟล์ `projectinformationsystem.sql`
5. เปิดเบราว์เซอร์ไปที่ `http://localhost/Project2/`

## โครงสร้างผู้ใช้งาน

| สิทธิ์ (right) | ประเภท | Portal |
|---|---|---|
| 1 | ผู้ดูแลระบบ (Admin) | `admin.php` |
| 2 | เจ้าหน้าที่ (Officer) | `officer.php` |
| 3 | อาจารย์ (Teacher) | `teacher.php` |
| 4 | นักศึกษา (Student) | `student.php` |

## โครงสร้างโปรเจกต์

```
Project2/
├── index.php              # หน้า Login
├── intopage.php           # Dispatcher หลัง Login
├── connectdatabase.php    # เชื่อมต่อฐานข้อมูล
├── change.php             # Extract GET/POST params
├── xlsxreader.php         # Parser .xlsx แบบไม่ใช้ library ภายนอก (ZipArchive+SimpleXML)
├── admin.php              # Admin portal
├── officer.php            # Officer portal
├── teacher.php            # Teacher portal
├── student.php            # Student portal
├── project/               # โมดูลหลัก: ส่ง/อนุมัติ/จัดสอบโครงงาน
├── student/                # CRUD ข้อมูลนักศึกษา (นำเข้า .xlsx ได้)
├── teacher/                # CRUD ข้อมูลอาจารย์
├── regis/                 # ลงทะเบียนโครงงานปี (โปรเจคปี, ลงทะเบียนครั้งที่ 2)
├── register/               # ลงทะเบียนวิชา (นำเข้า .xlsx ได้)
├── exam/                  # จัดการตารางสอบ
├── report/                # ออกรายงาน PDF (FPDF)
├── basicdata/             # ตารางข้อมูลพื้นฐาน (คณะ, ห้อง ฯลฯ)
├── news/                  # ข่าวประกาศ (แนบไฟล์ PDF ได้)
├── race/                  # โครงงานที่เข้าร่วมการแข่งขัน
├── user/                  # จัดการผู้ใช้งานระบบ
├── password/              # เปลี่ยนรหัสผ่าน
├── year/                  # เปลี่ยนภาคเรียน/ปีการศึกษา
├── headofdepartment/      # เปลี่ยนหัวหน้าภาค
├── _js/                   # jQuery และ JS libraries
├── css/                   # Stylesheets
├── download/              # ไฟล์ให้ดาวน์โหลด (คู่มือ ฯลฯ)
└── img/, image/           # รูปภาพ
```

ดูรายละเอียด architecture/pattern เชิงลึกได้ที่ [CLAUDE.md](CLAUDE.md), แผนผัง navigation เต็มรูปแบบได้ที่ [SITE_STRUCTURE.md](SITE_STRUCTURE.md), และปัญหาที่ตรวจพบ/แก้ไขทั้งหมดได้ที่ [ERROR_AUDIT_REPORT.md](ERROR_AUDIT_REPORT.md)

## ขั้นตอนการสอบโครงงาน (Officer Workflow)

```
ส่งคำร้อง → แต่งตั้งกรรมการ → นัดวันสอบ → บันทึกผล → ส่งเล่ม/TK.01
  shows2       shows3          shows4       shows5-1     shows6/7
```

## หมายเหตุสำหรับนักพัฒนา

- รหัสผ่านเก็บเป็น **MD5 (unsalted)** — ห้ามเปลี่ยนโดยไม่ migrate ข้อมูล
- การนำทางใช้ jQuery `.load()` โหลด fragment เข้า `#showmanage` — fragment ห้ามมี `<html>/<head>/<body>`
- ทุก `.load()` ต่อท้าย `?pop=Math.random()` เพื่อป้องกัน browser cache
- ใช้ `json_encode()` ส่งค่า PHP เข้า JS onclick เสมอ
- ลำดับลบข้อมูล (FK): `assignexam → committee → exam → manipulator → projecthistory → project`
- ดูรายงานปัญหาที่ตรวจพบและแก้ไขทั้งหมดได้ที่ [ERROR_AUDIT_REPORT.md](ERROR_AUDIT_REPORT.md)
