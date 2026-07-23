<? session_start(); include('../change.php');
	include('../connectdatabase.php');
	/*
	 * ยื่นสอบหัวข้อ (typeexam=1). แข็งแกร่งขึ้นตามแพทเทิร์นเดียวกับ regis/registerproject.php:
	 * - เดิมใช้ select max(id_exam)+1 โดยไม่ล็อกและไม่เช็คผล insert แล้ว update สถานะ project
	 *   ต่อทุกครั้ง -> ถ้า insert exam ล้ม (ชน PK ตอนยื่นพร้อมกัน หรือ idproject ว่าง=0) สถานะ
	 *   project ยังเดินหน้าเป็น '2' แต่ไม่มี exam row ให้ project/shows2.php join
	 *   -> เจ้าหน้าที่ไม่เห็นการยื่นสอบ (ดู CLAUDE.md: MAX(id)+1 race + unchecked insert)
	 * แก้: (1) ตรวจว่า idproject เป็นโครงงานจริงของผู้ใช้ที่ล็อกอิน (กัน id=0 และ IDOR)
	 *      (2) ครอบด้วย GET_LOCK เพื่อ serialize การจอง id_exam ข้าม request
	 *      (3) กันยื่นซ้ำ (มี exam row pending status 20 ของ typeexam นี้อยู่แล้ว)
	 *      (4) เช็คผล insert -- ถ้าไม่สำเร็จ ห้าม update สถานะ project
	 */
	$idproject = isset($idproject) ? (int)$idproject : 0;
	$iduser    = isset($_SESSION['iduser']) ? (int)$_SESSION['iduser'] : 0;
	$typeexam   = '1';
	$poststatus = '2';

	if($idproject<=0 || $iduser<=0){ echo 'คำขอไม่ถูกต้อง'; mysqli_close($connect); exit; }

	$sql = "select * from academicyear";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result)){ $year = $rs[0]; $semester = $rs[1]; }

	$lockName = 'exam_id_assignment';
	$lockRow  = mysqli_fetch_assoc(mysqli_query($connect, "SELECT GET_LOCK('$lockName',10) AS got"));
	if(!$lockRow || $lockRow['got'] != 1){ echo 'ระบบไม่ว่าง กรุณาลองใหม่อีกครั้ง'; mysqli_close($connect); exit; }

	// (1) โครงงานต้องมีจริงและเป็นของผู้ใช้ที่ล็อกอิน
	$own    = mysqli_query($connect, "select id_user from project where id_project='$idproject'");
	$ownRow = $own ? mysqli_fetch_assoc($own) : null;
	if(!$ownRow || (int)$ownRow['id_user'] !== $iduser){
		mysqli_query($connect, "SELECT RELEASE_LOCK('$lockName')");
		echo 'ไม่พบโครงงาน หรือไม่มีสิทธิ์ยื่นสอบโครงงานนี้';
		mysqli_close($connect); exit;
	}

	// (3) กันยื่นซ้ำ: ต้องไม่มีคำขอที่ยังค้าง (status 20) ของประเภทการสอบนี้อยู่แล้ว
	$dup = mysqli_query($connect, "select id_exam from exam where id_project='$idproject' AND id_typeexam='$typeexam' AND id_statusproject='20' limit 1");
	if($dup && mysqli_num_rows($dup)>0){
		mysqli_query($connect, "SELECT RELEASE_LOCK('$lockName')");
		echo 'มีการยื่นสอบรายการนี้อยู่แล้ว';
		mysqli_close($connect); exit;
	}

	$res = mysqli_query($connect, "select max(id_exam) from exam");
	$row = mysqli_fetch_array($res);
	$id  = (int)$row[0] + 1;

	// (4) เช็คผล insert ก่อน แล้วจึงค่อยเดินสถานะ project
	$ok = mysqli_query($connect, "insert into exam values('$id','$idproject','$typeexam','','20','','$year','$semester')");
	if($ok){
		mysqli_query($connect, "update project set id_statusproject='$poststatus' where id_project='$idproject'");
	}
	mysqli_query($connect, "SELECT RELEASE_LOCK('$lockName')");
	if(!$ok){ echo 'เกิดข้อผิดพลาด ไม่สามารถยื่นสอบได้ กรุณาลองใหม่อีกครั้ง'; }

	mysqli_close($connect);
?>