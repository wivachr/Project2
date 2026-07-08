<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($nameteacher) || trim($nameteacher)==="") { exit; }
    include('../connectdatabase.php');
	$id = (int)$id;
	$idatitle = (int)$idatitle;
	$idtitle = (int)$idtitle;
	$nameteacher = mysqli_real_escape_string($connect, $nameteacher);
	$snameteacher = mysqli_real_escape_string($connect, $snameteacher);
	$facultyid = (int)$facultyid;
	$departmentid = (int)$departmentid;
	$divisionid = (int)$divisionid;
	$telteacher = mysqli_real_escape_string($connect, $telteacher);
	$emailteacher = mysqli_real_escape_string($connect, $emailteacher);
	$sql = "update teacher set id_academictitle='$idatitle',id_title='$idtitle',name_teacher='$nameteacher',sname_teacher='$snameteacher',id_faculty='$facultyid',id_department='$departmentid',id_division='$divisionid',tel_teacher='$telteacher',email_teacher='$emailteacher' where id_teacher='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>