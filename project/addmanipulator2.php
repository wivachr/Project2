<? include('../change.php'); ?>
<?
	if(!isset($idstu1) || trim($idstu1)==="" || !isset($idproject) || trim($idproject)==="") { exit; }
	include('../connectdatabase.php');

	/*
	 * ฝั่งเจ้าหน้าที่ (formeditproject.php) — guard ชุดเดียวกับ project/addmanipulator.php
	 * ดูคำอธิบายเต็มในไฟล์นั้น: กันเพิ่มซ้ำในกลุ่ม, กันรหัสนักศึกษาที่ไม่มีจริง,
	 * และกันดึงนักศึกษาที่อยู่กลุ่มอื่นในเทอมเดียวกัน ("แย่งเพื่อน")
	 */
	$stu = mysqli_real_escape_string($connect, trim($idstu1));
	$pid = (int)$idproject;

	$year = ''; $semester = '';
	$rsy = mysqli_query($connect, "select * from academicyear");
	while($rs = mysqli_fetch_array($rsy)) { $year = $rs[0]; $semester = $rs[1]; }

	$chk = mysqli_query($connect, "select id_student from student where id_student='$stu' limit 1");
	if(!$chk || mysqli_num_rows($chk)==0) {
		echo 'ไม่พบรหัสนักศึกษานี้ในระบบ';
		mysqli_close($connect); exit;
	}

	$dup = mysqli_query($connect, "select id_manipulator from manipulator where id_project='$pid' AND id_student='$stu' limit 1");
	if($dup && mysqli_num_rows($dup)>0) {
		echo 'นักศึกษารหัสนี้อยู่ในกลุ่มโครงงานนี้อยู่แล้ว';
		mysqli_close($connect); exit;
	}

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

	$sql = "select max(id_manipulator) from manipulator";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idmanipulator = $rs[0]+1;
	}
	$sql = "insert into manipulator values('$idmanipulator','$stu','$pid','$tel1')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>