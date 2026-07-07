# ระบบสารสนเทศโครงงานนักศึกษา (Project Information System)

ระบบจัดการโครงงาน/วิทยานิพนธ์ระดับอุดมศึกษา พัฒนาด้วย PHP + MySQL ทำงานบน XAMPP

## Tech Stack

- **Backend:** PHP 8.2 (MySQLi)
- **Frontend:** HTML, CSS, jQuery (legacy)
- **Database:** MySQL
- **Dev Server:** XAMPP

## การติดตั้งและรัน

1. ติดตั้ง [XAMPP](https://www.apachefriends.org/) และเปิด Apache + MySQL
2. วางโปรเจกต์ไว้ที่ `C:\xampp\htdocs\Project2\`
3. Import ฐานข้อมูลผ่าน phpMyAdmin:
   - สร้าง database ชื่อ `projectinformationsystem`
   - Import ไฟล์ `projectinformationsystem.sql`
4. เปิดเบราว์เซอร์ไปที่ `http://localhost/Project2/`

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
├── admin.php              # Admin portal
├── officer.php            # Officer portal
├── teacher.php            # Teacher portal
├── student.php            # Student portal
├── project/               # โมดูลหลัก: ส่ง/อนุมัติ/จัดสอบโครงงาน
├── student/               # CRUD ข้อมูลนักศึกษา
├── teacher/               # CRUD ข้อมูลอาจารย์
├── exam/                  # จัดการตารางสอบ
├── report/                # ออกรายงาน PDF (FPDF)
├── basicdata/             # ตารางข้อมูลพื้นฐาน (คณะ, ห้อง ฯลฯ)
├── news/                  # ข่าวประกาศ (แนบไฟล์ PDF ได้)
├── register/              # ลงทะเบียนโครงงาน
├── race/                  # ข้อมูลสาขาวิชา
├── _js/                   # jQuery และ JS libraries
├── css/                   # Stylesheets
└── img/, image/           # รูปภาพ
```

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
