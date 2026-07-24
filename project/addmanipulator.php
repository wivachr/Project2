<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($idstu1) || trim($idstu1)==="" || empty($_SESSION["idproject"])) { exit; }
	include('../connectdatabase.php');

	/*
	 * เดิมไฟล์นี้ insert ทันทีโดยไม่ตรวจอะไรเลยนอกจาก "ไม่ว่าง" ทำให้:
	 *  (1) เพิ่มนักศึกษาคนเดิมเข้ากลุ่มซ้ำได้ (ชื่อซ้ำในกลุ่ม)
	 *  (2) ใส่รหัสนักศึกษาที่ไม่มีอยู่จริงในระบบได้
	 *  (3) ดึงนักศึกษาที่อยู่กลุ่มอื่นในเทอมเดียวกันมาเข้ากลุ่มตัวเองได้ ("แย่งเพื่อน")
	 * เงื่อนไขข้อ (3) ใช้ตรรกะเดียวกับ regis/check_ajax/canuse.php คือไม่นับโปรเจกต์
	 * ที่ถูกยกเลิก (18) หรือไม่มีสถานะ (0) และดูเฉพาะปี/เทอมปัจจุบัน
	 */
	$idproject = $_SESSION["idproject"];
	$stu       = mysqli_real_escape_string($connect, trim($idstu1));

	$year = ''; $semester = '';
	$rsy = mysqli_query($connect, "select * from academicyear");
	while($rs = mysqli_fetch_array($rsy)) { $year = $rs[0]; $semester = $rs[1]; }

	// (2) ต้องเป็นรหัสนักศึกษาที่มีอยู่จริง
	$chk = mysqli_query($connect, "select id_student from student where id_student='$stu' limit 1");
	if(!$chk || mysqli_num_rows($chk)==0) {
		echo 'ไม่พบรหัสนักศึกษานี้ในระบบ';
		mysqli_close($connect); exit;
	}

	// (1) ต้องยังไม่อยู่ในกลุ่มนี้
	$dup = mysqli_query($connect, "select id_manipulator from manipulator where id_project='".(int)$idproject."' AND id_student='$stu' limit 1");
	if($dup && mysqli_num_rows($dup)>0) {
		echo 'นักศึกษารหัสนี้อยู่ในกลุ่มโครงงานนี้อยู่แล้ว';
		mysqli_close($connect); exit;
	}

	// (3) ต้องไม่อยู่กลุ่มอื่นที่ยัง active ในปี/เทอมเดียวกัน
	$other = mysqli_query($connect, "select project.id_project from project,manipulator
		where project.id_project=manipulator.id_project
		  AND project.year_project='$year' AND project.semester_project='$semester'
		  AND project.id_statusproject<>'0' AND project.id_statusproject<>'18'
		  AND manipulator.id_student='$stu'
		  AND project.id_project<>'".(int)$idproject."' limit 1");
	if($other && mysqli_num_rows($other)>0) {
		$o = mysqli_fetch_assoc($other);
		echo 'นักศึกษารหัสนี้ลงทะเบียนโครงงานอื่นในภาคเรียนนี้แล้ว (รหัสโครงงาน '.$o['id_project'].')';
		mysqli_close($connect); exit;
	}

	$sql = "select max(id_manipulator) from manipulator";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idmanipulator = $rs[0]+1;
	}
	$sql = "insert into manipulator values('$idmanipulator','$stu','".$idproject."','$tel1')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>