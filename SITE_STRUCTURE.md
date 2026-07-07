# Project2 — Site Structure (Full Navigation Map)

Generated from a full scan of the four portal shells (`admin.php`, `officer.php`, `teacher.php`, `student.php`) and their sidebar `.load()` handlers. This documents the **functional/navigation** structure (what menu loads what fragment) — for the **directory/file** structure see `README.md`, and for known bugs/orphaned code see `ERROR_AUDIT_REPORT.md`.

Every menu item below is a sidebar link that fires `$("#target").load("path/to/file.php?pop="+Math.random())`. Per `CLAUDE.md`, loaded fragments contain no `<html>/<head>/<body>` and their relative paths resolve against the **shell's** URL, not their own folder.

---

## Admin Portal — `admin.php` (right=1)

Target container: `#user` / `#basicdatamanage` (admin.php uses two separate containers instead of one shared `#showmanage`)

- **หน้าหลัก** → `index.php` (static link)
- **จัดการข้อมูลพิ้นฐาน** (`#basicdatabutton`, submenu toggle only)
  - จัดการข้อมูลคำนำหน้าชื่อ → `basicdata/title.php`
  - จัดการข้อมูลคำนำหน้าชื่อทางวิชาการ → `basicdata/academictitle.php`
  - จัดการข้อมูลสิทธิ์ → `basicdata/right.php`
  - จัดการข้อมูลหลักสูตร → `basicdata/typestudent.php`
  - จัดการข้อมูลคณะ → `basicdata/faculty.php`
  - จัดการข้อมูลภาควิชา → `basicdata/department.php`
  - จัดการข้อมูลสาขาวิชา → `basicdata/division.php`
  - จัดการข้อมูลประเภทการสอบ → `basicdata/typeexam.php`
  - จัดการข้อมูลวิชา → `basicdata/subject.php`
  - จัดการข้อมูลสถานะโครงงาน → `basicdata/statusproject.php`
  - จัดการข้อมูลห้องสอบ → `basicdata/room.php`
- **จัดการข้อมูลผู้ใช้** (`#userbutton`) → `user/usermange.php` *(also auto-loaded into `#user` on page ready)*
- **ออกจากระบบ** → `logout.php` then reloads `login.php` into `#login`

---

## Officer Portal — `officer.php` (right=2)

Target container: `#showmanage`

- **หน้าหลัก** → `index.php` (static)
- **จัดการนักศึกษา** (submenu toggle)
  - นำเข้าข้อมูลนักศึกษา → `student/importstudent.php`
  - จัดการข้อมูลนักศึกษา → `student/studentmange.php` *(auto-loads `student/showstudent.php` → `#liststudent`)*
- **จัดการอาจารย์** (submenu toggle)
  - จัดการข้อมูลอาจารย์ → `teacher/teacher.php` *(auto-loads `teacher/showteacher.php` → `#listteacher`)*
  - จัดเวลาว่างอาจารย์ → `teacher/teacherfreetime.php`
- **จัดการการลงทะเบียน** (submenu toggle)
  - นำเข้าข้อมูลการลงทะเบียน → `register/importregister.php`
  - จัดการข้อมูลการลงทะเบียน → `register/register.php` *(auto-loads `register/showregister.php` → `#listregister`)*
- **จัดการข้อมูลห้องสอบ** → `basicdata/room.php` *(auto-loads `basicdata/show/showroom.php` → `#listroom`)*
- **จัดการข้อมูลโครงงานพิเศษ** → `project/projectmanage.php` *(auto-loads `project/showproject.php` → `#listproject`)*
- **โครงงานที่เข้าร่วมการแข่งขัน** → `race/race.php` *(auto-loads `race/showrace.php` → `#listrace`)*
- **จัดการการสอบ** (submenu toggle — the exam workflow pipeline)
  - รับเรื่องการสอบ → `project/shows2.php`
  - แต่งตั้งคณะกรรมการ → `project/shows3.php`
  - จัดวันสอบ → `project/shows4.php`
  - แก้ไขข้อมูลการจัดสอบ → `exam/editassignexam.php`
  - พิมพ์ใบประเมินการสอบ → `project/shows5.php`
  - บันทึกผลการสอบ → `project/shows5-1.php`
  - ดูข้อมูลการสอบ → `exam/showexam.php`
- **จัดการการส่งทก.01** → `project/shows7.php`
- **จัดการการส่งปริญญานิพนธ์ฉบับสมบูรณ์และCD** → `project/shows6.php`
- **จัดการข้อมูลข่าวสาร** → `news/news.php` *(auto-loads `news/shownews.php` → `#listnews`)*
- **เปลี่ยนหัวหน้าภาค** → `headofdepartment/head.php`
- **เปลี่ยนภาคการศึกษา** → `year/year.php`
- **เปลี่ยนรหัสผ่าน** → `password/changepassword.php`
- **ออกรายงาน** (submenu toggle)
  - ตารางสอบ → `report/showchoosetableexam.php`
  - ผลการสอบหัวข้อ → `report/showresulttitle.php`
  - ผลการสอบร้อยเปอร์เซ็นต์ → `report/showresult100.php`
  - โครงงานที่สอบหัวข้อไม่ผ่าน → `report/showfall.php`
  - สถานะโครงงานพิเศษ → `report/showstatusproject.php`
  - รายชื่อนักศึกษาที่ยังไม่มีหัวข้อ → `report/shownoproject.php`
  - รายชื่อโครงงานพิเศษที่มีกรณีศึกษา → `report/showcase.php`
  - โครงงานพิเศษที่ครบกำหนด2ภาคเรียน → `report/showexp.php`
- **ออกจากระบบ** → `logout.php` then reloads `login.php`

> Dead code note: officer.php also wires up a `#noexam` handler (→ `report/shownoexam.php`) with no matching sidebar `<a>` — unreachable from the UI.

---

## Teacher Portal — `teacher.php` (right=3)

Target container: `#showmanage`

- **หน้าหลัก** → `index.php` (static)
- **ดูข้อมูลโครงงานพิเศษที่ตัวเองเป็นที่ปรึกษา** → `project/showprojectteacher.php` *(also the default landing view, auto-loaded on page ready)*
- **ดูข้อมูลโครงงานพิเศษทั้งหมด** → `project/showallprojectteacher.php`
- **แก้ไขข้อมูลส่วนตัว** → `teacher/formeditteacher.php`
- **ออกรายงาน** (submenu toggle)
  - ตารางสอบ → `report/showtableexamfix-2.php` (passes teacher id as `t`)
  - สถานะโครงงานพิเศษ → `report/tablestatusproject2.php` (passes teacher id as `teacher`)
  - *(commented out in markup, inactive)* โครงงานพิเศษที่ครบกำหนด2ภาคเรียน
- **เปลี่ยนรหัสผ่าน** → `password/changepassword.php`
- **ออกจากระบบ** → `logout.php` then reloads `login.php`

> Dead code note: `#viewedit` (→ `project/viewedit.php`) and a `#noproject`/`#noexam` handler exist in teacher.php's script but have no matching sidebar link — leftover from being copy-pasted off officer.php.

---

## Student Portal — `student.php` (right=4)

Target container: `#showmanage`

- **หน้าหลัก** → `index.php` (static)
- **จัดการข้อมูลโครงงานพิเศษ** → `project/project.php` *(default landing view, auto-loaded on page ready — self-contained tab form, no further nested `.load()` calls: it show/hides local divs like `#save`, `#adding`, `#addma`, `#ctg` for editing project/manipulator/co-advisor state)*
- **ดูประวัติการสอบ** → `project/viewexam.php`
- **ดูประวัติการแก้ไข** → `project/viewedit.php`
- **เปลี่ยนรหัสผ่าน** → `password/changepassword.php`
- **ออกจากระบบ** → `logout.php` then reloads `login.php`

---

## Cross-portal patterns

- All four shells share the same `logout()` JS function → hits `logout.php`, then reloads `login.php` into `#login`.
- Fragment target container differs: `admin.php` splits across `#user`/`#basicdatamanage`; the other three portals share a single `#showmanage`.
- "List manager" fragments that self-load a secondary list on their own `$(document).ready()`: `project/projectmanage.php` → `project/showproject.php`, `teacher/teacher.php` → `teacher/showteacher.php`. Others (`student/studentmange.php`, `register/register.php`, `news/news.php`, `race/race.php`, `basicdata/room.php`) get their secondary list loaded explicitly from the officer.php click-handler's callback instead — same effect, different wiring location.
- The officer exam-workflow submenu (`shows2` → `shows3` → `shows4` → `shows5-1`/`shows5` → `shows6`/`shows7`) is the only menu section that mirrors a strict pipeline order; every other section's items are independent CRUD/report screens.
