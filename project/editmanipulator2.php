<? include('../change.php'); ?>
<?
	/*
	 * แก้ไขผู้จัดทำในกลุ่ม — ใช้ทั้งฝั่งนักศึกษา (student.php) และเจ้าหน้าที่ (formeditproject.php)
	 *
	 * เดิมไฟล์นี้ update ทันทีโดยไม่ตรวจอะไรเลยสักบรรทัด ทำให้เป็นช่องข้าม guard ของ
	 * project/addmanipulator*.php ได้ทั้งหมด: เพิ่มเพื่อนที่ถูกต้องก่อน แล้วค่อยแก้รหัส
	 * เป็นใครก็ได้ — ทั้งรหัสที่ไม่มีจริง, รหัสที่ซ้ำกับคนในกลุ่มเดียวกัน หรือรหัสของ
	 * นักศึกษาที่อยู่กลุ่มอื่นในเทอมเดียวกัน ("แย่งเพื่อน")
	 *
	 * หมายเหตุ: การเช็คซ้ำต้องยกเว้นแถวที่กำลังแก้เอง ไม่งั้นการแก้เฉพาะเบอร์โทร
	 * (คงรหัสนักศึกษาเดิม) จะถูกปฏิเสธ
	 */
	if(!isset($idmani) || trim($idmani)==="" || !isset($idstu) || trim($idstu)==="") { exit; }
	include('../connectdatabase.php');

	$mid = (int)$idmani;
	$stu = mysqli_real_escape_string($connect, trim($idstu));

	// แถวที่จะแก้ต้องมีอยู่จริง และต้องรู้ว่าอยู่โปรเจกต์ไหน
	$cur = mysqli_query($connect, "select id_project from manipulator where id_manipulator='$mid' limit 1");
	if(!$cur || mysqli_num_rows($cur)==0) {
		echo 'ไม่พบข้อมูลผู้จัดทำที่ต้องการแก้ไข';
		mysqli_close($connect); exit;
	}
	$row = mysqli_fetch_assoc($cur);
	$pid = (int)$row['id_project'];

	$year = ''; $semester = '';
	$rsy = mysqli_query($connect, "select * from academicyear");
	while($rs = mysqli_fetch_array($rsy)) { $year = $rs[0]; $semester = $rs[1]; }

	// ต้องเป็นรหัสนักศึกษาที่มีอยู่จริง
	$chk = mysqli_query($connect, "select id_student from student where id_student='$stu' limit 1");
	if(!$chk || mysqli_num_rows($chk)==0) {
		echo 'ไม่พบรหัสนักศึกษานี้ในระบบ';
		mysqli_close($connect); exit;
	}

	// ต้องไม่ซ้ำกับคนอื่นในกลุ่มเดียวกัน (ยกเว้นแถวที่กำลังแก้)
	$dup = mysqli_query($connect, "select id_manipulator from manipulator
		where id_project='$pid' AND id_student='$stu' AND id_manipulator<>'$mid' limit 1");
	if($dup && mysqli_num_rows($dup)>0) {
		echo 'นักศึกษารหัสนี้อยู่ในกลุ่มโครงงานนี้อยู่แล้ว';
		mysqli_close($connect); exit;
	}

	// ต้องไม่อยู่กลุ่มอื่นที่ยัง active ในปี/เทอมเดียวกัน
	$other = mysqli_query($connect, "select project.id_project from project,manipulator
		where project.id_project=manipulator.id_project
		  AND project.year_project='$year' AND project.semester_project='$semester'
		  AND project.id_statusproject<>'0' AND project.id_statusproject<>'18'
		  AND manipulator.id_student='$stu'
		  AND project.id_project<>'$pid' limit 1");
	if($other && mysqli_num_rows($other)>0) {
		$o = mysqli_fetch_assoc($other);
		echo 'นักศึกษารหัสนี้ลงทะเบียนโครงงานอื่นในภาคเรียนนี้แล้ว (รหัสโครงงาน '.$o['id_project'].')';
		mysqli_close($connect); exit;
	}

	$tel = mysqli_real_escape_string($connect, isset($tel2) ? $tel2 : '');
	$sql = "update manipulator set id_student='$stu',tel_manipulator='$tel' where id_manipulator='$mid'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>