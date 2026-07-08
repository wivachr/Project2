<? session_start(); ?>
<? include('../change.php'); ?>
<?
include('../connectdatabase.php');

$idproject = (int)$idproject;
$passedIn = array(6,7,8,9,10,11,12,13,14,15,16,19,20,21,23,24);

$sql = "select * from project where id_project='$idproject'";
$result = mysqli_query($connect, $sql);
$parent = mysqli_fetch_array($result);

$dup = mysqli_query($connect, "select id_project from project where parent_project_id='$idproject' limit 1");

$sql = "select * from academicyear";
$result = mysqli_query($connect, $sql);
$ay = mysqli_fetch_array($result);
$newyear = $ay[0];
$newsemester = $ay[1];

if(!$parent)
{
	echo 'ERR|ไม่พบโครงงานต้นฉบับ';
}
else if(!isset($_SESSION['iduser']) || $parent['id_user']!=$_SESSION['iduser'])
{
	echo 'ERR|ไม่มีสิทธิ์ลงทะเบียนโปรเจค 2 สำหรับโครงงานนี้';
}
else if($parent['project_type']!=='year' || !empty($parent['parent_project_id']) || !in_array($parent['id_statusproject'], $passedIn))
{
	echo 'ERR|ไม่สามารถลงทะเบียนโปรเจค 2 ได้ในขณะนี้';
}
else if(mysqli_num_rows($dup)>0)
{
	echo 'ERR|โครงงานนี้ลงทะเบียนโปรเจค 2 ไปแล้ว';
}
else if($parent['year_project']==$newyear && $parent['semester_project']==$newsemester)
{
	echo 'ERR|ยังไม่ถึงเวลาลงทะเบียนโปรเจค 2 ต้องรอภาคการศึกษาถัดไป';
}
else
{
	$sql = "select max(id_project) from project where year_project='$newyear' AND semester_project='$newsemester'";
	$result = mysqli_query($connect, $sql);
	$rs = mysqli_fetch_array($result);
	if($rs[0]!=NULL) { $newid = $rs[0]+1; }
	else { $newid = substr($newyear,2,4).$newsemester."001"; }

	$sql = "select * from user where id_user='".$parent['id_user']."'";
	$result = mysqli_query($connect, $sql);
	$parentuser = mysqli_fetch_array($result);
	$oldpassword = $parentuser['password'];

	$sql = "select max(id_user) from user";
	$result = mysqli_query($connect, $sql);
	$rs = mysqli_fetch_array($result);
	$newiduser = $rs[0]+1;
	$name1 = "ผู้จัดทำโครงงานพิเศษรหัส ".$newid;
	mysqli_query($connect, "insert into user values('$newiduser','$name1','','$newid','$oldpassword','4','1')");

	$name_project = mysqli_real_escape_string($connect, $parent['name_project']);
	$casestudy_project = mysqli_real_escape_string($connect, $parent['casestudy_project']);
	$engname_project = mysqli_real_escape_string($connect, $parent['engname_project']);
	$engcasestudy_project = mysqli_real_escape_string($connect, $parent['engcasestudy_project']);
	$address_project = mysqli_real_escape_string($connect, $parent['address_project']);
	$email_project = mysqli_real_escape_string($connect, $parent['email_project']);
	$id_subject = mysqli_real_escape_string($connect, $parent['id_subject']);
	$section_project = mysqli_real_escape_string($connect, $parent['section_project']);
	$torgor_project = mysqli_real_escape_string($connect, $parent['torgor_project']);

	// project 2 reuses project 1's approved ทก.01 and skips the title-exam stage entirely,
	// starting directly at "จัดส่งทก.01หลังการสอบหัวข้อเรียบร้อยแล้ว" (ready to submit for the 100% exam)
	$sql = "INSERT INTO project
			(id_project,name_project,casestudy_project,id_subject,year_project,semester_project,section_project,
			 project_type,parent_project_id,address_project,email_project,torgor_project,id_statusproject,id_user,
			 engname_project,engcasestudy_project)
			VALUES('$newid','$name_project','$casestudy_project','$id_subject','$newyear','$newsemester','$section_project',
				   'year','$idproject','$address_project','$email_project','$torgor_project','6','$newiduser','$engname_project','$engcasestudy_project')";
	mysqli_query($connect, $sql);

	$sql = "select * from manipulator where id_project='$idproject'";
	$result = mysqli_query($connect, $sql);
	while($m = mysqli_fetch_array($result))
	{
		$r2 = mysqli_query($connect, "select max(id_manipulator) from manipulator");
		$rs2 = mysqli_fetch_array($r2);
		$newidm = $rs2[0]+1;
		$idstu = mysqli_real_escape_string($connect, $m['id_student']);
		$tel = mysqli_real_escape_string($connect, $m['tel_manipulator']);
		mysqli_query($connect, "insert into manipulator values('$newidm','$idstu','$newid','$tel')");
	}

	$sql = "select * from committee where id_project='$idproject' AND position='ที่ปรึกษา'";
	$result = mysqli_query($connect, $sql);
	while($c = mysqli_fetch_array($result))
	{
		$r2 = mysqli_query($connect, "select max(id_committee) from committee");
		$rs2 = mysqli_fetch_array($r2);
		$newidc = $rs2[0]+1;
		$idteacher = (int)$c['id_teacher'];
		mysqli_query($connect, "insert into committee values('$newidc','$idteacher','$newid','ที่ปรึกษา')");
	}

	$sql = "select * from coadvisor where id_project='$idproject'";
	$result = mysqli_query($connect, $sql);
	while($co = mysqli_fetch_array($result))
	{
		$r2 = mysqli_query($connect, "select max(id_coadvisor) from coadvisor");
		$rs2 = mysqli_fetch_array($r2);
		$newidco = $rs2[0]+1;
		$idtitle = (int)$co['id_title'];
		$nname = mysqli_real_escape_string($connect, $co['name_coadvisor']);
		$nsname = mysqli_real_escape_string($connect, $co['sname_coadvisor']);
		mysqli_query($connect, "insert into coadvisor values('$newidco','$newid','$idtitle','$nname','$nsname')");
	}

	echo 'OK|'.$newid;
}
mysqli_close($connect);
?>
