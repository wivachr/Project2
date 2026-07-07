# แผนเตรียมย้ายระบบไปยัง Ubuntu Server

ผลตรวจสอบความพร้อมของโค้ด Project2 (ปัจจุบันรันบน Windows + XAMPP) สำหรับการย้ายไปรันบน Ubuntu Server (Apache + PHP 8.2 + MySQL/MariaDB) จากการสแกนทั้ง codebase (330+ ไฟล์ PHP)

**สรุปภาพรวม: โค้ดพร้อมย้ายค่อนข้างมาก** — ไม่พบปัญหา case-sensitivity ของ `include`/`require`, ไม่พบ path แบบ Windows (`C:\`), ไม่พบการเรียก `exec()`/`shell_exec()` ที่ผูกกับ Windows, และ FPDF (library สร้าง PDF) เป็น pure PHP ที่พกพาข้ามระบบได้อยู่แล้ว สิ่งที่ต้องทำจริงมีอยู่ 5 หมวดตามด้านล่าง

---

## 1. ติดตั้ง PHP extension ที่จำเป็น

```bash
sudo apt install php8.2 libapache2-mod-php8.2 php8.2-mysqli php8.2-zip php8.2-xml
```

| Extension | เหตุผล |
|---|---|
| `php8.2-mysqli` | ใช้ทั่วทั้งระบบ (`mysqli_*` กว่า 1,850 ครั้งใน 246 ไฟล์) |
| `php8.2-zip` | `xlsxreader.php` ใช้ `ZipArchive` อ่านไฟล์ `.xlsx` (นำเข้านักศึกษา/ลงทะเบียน) — มีบันทึกไว้ใน README.md แล้ว |
| `php8.2-xml` | `xlsxreader.php` ใช้ `SimpleXMLElement` แกะ XML ภายใน `.xlsx` |
| `php8.2-gd` (แนะนำ ไม่บังคับ) | FPDF (`report/fpdf.php`) มีโค้ดรองรับแปลงภาพ `.gif`→PNG ผ่าน GD แต่ไม่มีหน้าไหนในระบบเรียกใช้งานจริง ติดไว้กันเผื่ออนาคต |

**ไม่ต้องติดตั้ง**: `mbstring`, `curl` — ตรวจแล้วไม่มีการเรียก `mb_*`/`curl_*` ที่ไหนในระบบเลย

## 2. แก้ `connectdatabase.php` สำหรับ production

ไฟล์นี้ถูก `.gitignore` ไว้ (ห้าม commit) แต่ค่าปัจจุบันบนเครื่อง dev คือ:
```php
$host = "localhost";
$username = "root";
$passwd = "";              // ว่างเปล่า — ใช้ได้เฉพาะ dev บน XAMPP
```
ก่อนขึ้น production ต้อง:
- สร้าง MySQL user ใหม่ (ไม่ใช้ `root`) พร้อมรหัสผ่านจริง ให้สิทธิ์เฉพาะ database `projectinformationsystem`
- **ระวัง**: MariaDB บน Ubuntu ค่าเริ่มต้นมักตั้ง `root` ให้ auth ผ่าน `unix_socket` เท่านั้น (ไม่รับ TCP+password) — ต่อให้ตั้งรหัสผ่าน root ก็อาจเชื่อมต่อแบบนี้ไม่ได้ ต้องสร้าง user แยกที่ auth แบบ `mysql_native_password`/`caching_sha2_password`
- ไฟล์นี้มีบรรทัด `mysqli_set_charset($connect, 'utf8')` อยู่แล้ว — ดี ไม่ต้องแก้ แต่ควรตรวจว่า MySQL/MariaDB บนเครื่องใหม่ตั้ง `character_set_server`/`collation_server` เป็น `utf8`/`utf8_general_ci` ให้ตรงกับ schema (ดูข้อ 4)

## 3. สิทธิ์ไฟล์/โฟลเดอร์ที่แอปเขียนได้ (ต้องเป็นของ `www-data`)

| โฟลเดอร์ | ใครเขียน | หมายเหตุ |
|---|---|---|
| `news/uploads/` | `news/uploadnews.php` (แนบ PDF ข่าวประกาศ) | มีไฟล์อยู่แล้ว (`5.pdf`...`8.pdf`) |
| `<ปีการศึกษา>-<ภาคเรียน>/` ที่ root โปรเจกต์ เช่น `2565-1/`, `2569-1/` | `project/upload.php`, `project/upload2.php` (แนบ ทก.01 / เล่มปริญญานิพนธ์) | โค้ดสร้างโฟลเดอร์เองด้วย `mkdir(..., 0777)` แบบ dynamic ตามปี/เทอมจากตาราง `academicyear` — บน Linux permission bit มีผลจริง (ต่างจาก Windows/NTFS ที่ XAMPP มักเมิน) ต้องให้แน่ใจว่า root โปรเจกต์เขียนได้โดย `www-data` เพื่อให้สร้างโฟลเดอร์ปี/เทอมใหม่ ๆ ต่อไปได้ |

โฟลเดอร์ปี-เทอมเก่า (`2553-1` ถึง `2569-1`, ~40 โฟลเดอร์) ที่มีอยู่ใน repo ปัจจุบันคือ **ข้อมูลที่แอปสร้างขึ้นเอง** ไม่ใช่ source code — ต้อง copy ข้อมูลจริงเหล่านี้ไปเครื่องใหม่ด้วย (ปกติ `.gitignore` กันไว้ไม่ให้เข้า git อยู่แล้ว)

## 4. ย้ายฐานข้อมูล

- Schema/ข้อมูลอยู่ที่ `projectinformationsystem.sql` (root โปรเจกต์, ไม่ถูก track ใน git — ต้อง copy ไฟล์นี้ไปด้วยตรง ๆ หรือ `mysqldump` จากเครื่อง dev ปัจจุบันใหม่)
- ทุกตาราง (27 ตาราง) ใช้ **`ENGINE=MyISAM`** และ **`CHARSET=utf8`** (ไม่ใช่ `utf8mb4`) — import ตรง ๆ ได้เลย ไม่ต้องแก้ schema
- ชื่อตารางทั้งหมดเป็นตัวพิมพ์เล็กอยู่แล้ว (`project`, `student`, `teacher`, ฯลฯ) — **ไม่มีความเสี่ยงเรื่อง `lower_case_table_names`** ที่ Windows/Linux MySQL ตั้งค่าเริ่มต้นต่างกัน
- แนะนำตั้งค่า `collation_server=utf8_general_ci` บนเครื่องใหม่ให้ตรงกับพฤติกรรมเดิม เพราะ dump ไม่ได้ประกาศ collation ต่อตารางไว้ชัดเจน (อาศัย server default)

## 5. ตั้งค่า Apache

- มี `.htaccess` อยู่ไฟล์เดียวที่ root โปรเจกต์ (ตั้ง `Permissions-Policy` header) — ต้อง `sudo a2enmod headers` และตั้ง `AllowOverride` (อย่างน้อย `FileInfo`, หรือ `All`) ให้ vhost ของ docroot นี้ เพราะ Ubuntu Apache ค่าเริ่มต้นคือ `AllowOverride None`
- **ไม่มี** การจำกัดสิทธิ์เข้าถึงโฟลเดอร์ internal ใด ๆ เลย (`news/uploads/`, โฟลเดอร์ปี-เทอม, `report/fpdf.php`, `report/font/makefont/makefont.php`, `xlsxreader.php` ล้วนเปิดให้เรียกตรงผ่าน URL ได้หมด) — ของเดิมเป็นแบบนี้อยู่แล้วบน XAMPP เช่นกัน ถือเป็นความเสี่ยงเดิมที่ควรพิจารณาปิดกั้นตอนตั้งค่า vhost ใหม่ (เช่น `<Directory>` block ปิด PHP execution ในโฟลเดอร์ upload) แต่ไม่ใช่สิ่งที่ "พังเพิ่ม" จากการย้ายเครื่อง
- ตรวจ `upload_max_filesize`/`post_max_size` ใน `php.ini` ของเครื่องใหม่ให้ **เท่ากับหรือมากกว่า** ค่าปัจจุบันบน XAMPP — โค้ดอัปโหลดไฟล์ (`project/upload.php`, `news/uploadnews.php`, `student/importingstudent.php`, `register/importingregister.php`) **ไม่มีการเช็คขนาดไฟล์เองเลย** พึ่ง `php.ini` ล้วน ๆ ถ้าเครื่องใหม่ตั้งค่าเล็กกว่าเดิม การอัปโหลดไฟล์ใหญ่จะเงียบ ๆ ล้มเหลวโดยไม่มี error message ที่ชัดเจน

## 6. เปิดใช้งาน HTTPS

เซิร์ฟเวอร์นี้ใช้งานเฉพาะภายในเครือข่าย ไม่มีโดเมนสาธารณะ จึงใช้ **Let's Encrypt ไม่ได้** (ต้อง validate ผ่านอินเทอร์เน็ต) ทางเลือกคือ self-signed certificate หรือ internal CA

**ตรวจโค้ดแล้ว: ไม่มี mixed-content risk** — grep หาโค้ดที่ hardcode `http://` แบบเต็ม URL (`href=`, `src=`, `action=`) ทั่วทั้ง `.php` แล้วไม่พบเลย ทุก path ในระบบเป็น relative URL ทั้งหมด ดังนั้นสลับมาใช้ HTTPS ได้โดยไม่ต้องแก้โค้ดแอปเลย เป็นงานฝั่ง server config ล้วน ๆ

### ขั้นตอน

1. เปิดใช้ mod_ssl:
   ```bash
   sudo a2enmod ssl
   ```

2. สร้าง self-signed certificate (อายุ ~2 ปี) —ตั้ง `CN` เป็นชื่อ/IP ที่ใช้เข้าเว็บจริงภายในวง:
   ```bash
   sudo mkdir -p /etc/ssl/project2
   sudo openssl req -x509 -nodes -days 825 -newkey rsa:2048 \
     -keyout /etc/ssl/project2/project2.key \
     -out /etc/ssl/project2/project2.crt \
     -subj "/C=TH/ST=Prachinburi/O=KMUTNB/OU=IT/CN=<hostname-หรือ-IP-ภายในที่ใช้เข้าเว็บ>"
   ```
   ถ้าภาควิชามี internal CA อยู่แล้ว (เช่นแจก root cert ผ่าน GPO ให้เครื่องนักศึกษา/บุคลากร) แนะนำ sign ด้วย CA นั้นแทน self-signed ตรง ๆ เพราะจะไม่มี warning "ไม่ปลอดภัย" โผล่ในเบราว์เซอร์ของเครื่องที่ trust CA นั้นอยู่แล้ว

3. สร้าง vhost สำหรับ HTTPS `/etc/apache2/sites-available/project2-ssl.conf`:
   ```apache
   <VirtualHost *:443>
       ServerName <hostname-หรือ-IP>
       DocumentRoot /var/www/Project2
       SSLEngine on
       SSLCertificateFile /etc/ssl/project2/project2.crt
       SSLCertificateKeyFile /etc/ssl/project2/project2.key
       <Directory /var/www/Project2>
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

4. เปิด site และ reload:
   ```bash
   sudo a2ensite project2-ssl.conf
   sudo systemctl reload apache2
   ```

5. บังคับ redirect HTTP→HTTPS ใน vhost พอร์ต 80 เดิม (เพิ่มในไฟล์ vhost port 80):
   ```apache
   <VirtualHost *:80>
       ServerName <hostname-หรือ-IP>
       Redirect permanent / https://<hostname-หรือ-IP>/
   </VirtualHost>
   ```

6. แจกจ่าย certificate (หรือ root CA ถ้าใช้ internal CA) ให้เครื่องผู้ใช้ติดตั้งเป็น trusted certificate — ถ้าข้ามขั้นตอนนี้ผู้ใช้จะเห็น warning "การเชื่อมต่อไม่เป็นส่วนตัว" ทุกครั้งที่เข้าเว็บ (ยังใช้งานได้ผ่านการกด "ดำเนินการต่อ" แต่ไม่ user-friendly และเสี่ยงให้ผู้ใช้เคยชินกับการกดผ่าน warning ด้านความปลอดภัย)

7. (แนะนำ ทำหลังยืนยันว่า HTTPS ใช้งานได้จริงแล้วเท่านั้น) เปิด `session.cookie_secure=1` ใน `php.ini` เพื่อให้ session cookie ส่งเฉพาะผ่าน HTTPS เท่านั้น — **อย่าเปิดก่อน** เพราะถ้ายังมีบางคนเข้าผ่าน HTTP อยู่ session จะใช้งานไม่ได้เลย

## สิ่งที่ตรวจแล้ว "ไม่มีปัญหา" — ไม่ต้องแก้อะไร

- **Case-sensitivity ของ `include`/`require`**: ตรวจครบทั้ง 578 จุดที่ include ไฟล์ทั่ว repo — ชื่อไฟล์ในโค้ดกับชื่อไฟล์จริงบน disk เป็นตัวพิมพ์เล็กตรงกันหมด ปลอดภัยจาก Linux filesystem ที่ case-sensitive
- **Path แบบ Windows**: ไม่พบ `C:\` หรือ backslash-path ที่ไหนเลย โค้ดใช้ `/` ล้วน
- **URL/IP hardcode**: ไม่พบ `localhost`/IP เครื่อง dev ฝังอยู่ในโค้ด ยกเว้น `connectdatabase.php` (ข้อ 2 ด้านบน)
- **`exec()`/`shell_exec()`/`system()`**: ไม่มีการเรียกคำสั่ง shell ที่ไหนในระบบเลย
- **FPDF** (`report/fpdf.php` + ฟอนต์ไทยที่ฝังไว้ใน `report/font/`): เป็น pure PHP, resolve path ด้วย `dirname(__FILE__)` ไม่มี hardcode ใด ๆ ทำงานข้ามระบบได้ทันที รวมถึงฟอนต์ไทย (Angsana, Cordia, ฯลฯ) ที่ฝังไว้ในไฟล์ `.z` เอง ไม่ต้องพึ่งฟอนต์ระบบปฏิบัติการ

## Checklist หลังย้ายเครื่องเสร็จ (ทดสอบจริง)

- [ ] Login ได้ทั้ง 4 สิทธิ์ (admin/officer/teacher/student)
- [ ] อัปโหลดไฟล์ PDF (ทก.01, เล่มปริญญานิพนธ์, ข่าวประกาศ) สำเร็จ และไฟล์เขียนลงโฟลเดอร์ถูกต้อง
- [ ] นำเข้าไฟล์ `.xlsx` (นักศึกษา/ลงทะเบียน) ทำงานได้
- [ ] พิมพ์รายงาน PDF (FPDF) แสดงภาษาไทยถูกต้อง ไม่มีตัวอักษรเพี้ยน
- [ ] ข้อมูลเก่า (โฟลเดอร์ปี-เทอม, `news/uploads/`) ถูกย้ายมาครบและอ่าน/เขียนได้
- [ ] ลบ/ไม่ deploy ไฟล์ `report/font/desktop.ini` (ไฟล์ metadata ของ Windows Explorer ที่หลงเหลืออยู่ ไม่ใช่ source code)
- [ ] เข้าเว็บผ่าน `https://` ได้โดยไม่มี mixed-content warning ในหน้าไหนเลย (ไม่ควรมี เพราะไม่มี hardcode `http://` ในโค้ด แต่ควรเช็คจริงด้วยตา/console ของเบราว์เซอร์)

ดู [CLAUDE.md](CLAUDE.md) สำหรับสถาปัตยกรรมโดยรวม และ [ERROR_AUDIT_REPORT.md](ERROR_AUDIT_REPORT.md) สำหรับปัญหาที่ตรวจพบและแก้ไปแล้วก่อนหน้านี้
