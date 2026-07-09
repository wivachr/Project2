<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($idstudent) || trim($idstudent)==="" || !isset($namestudent) || trim($namestudent)==="") { exit; }
    include('../connectdatabase.php');
	$idstudent = mysqli_real_escape_string($connect, $idstudent);
	$idtitle = (int)$idtitle;
	$namestudent = mysqli_real_escape_string($connect, $namestudent);
	$snamestudent = mysqli_real_escape_string($connect, $snamestudent);
	$facultyid = (int)$facultyid;
	$departmentid = (int)$departmentid;
	$divisionid = (int)$divisionid;
	$typestudentid = mysqli_real_escape_string($connect, $typestudentid);
	$sql = "update student set id_title='$idtitle',name_student='$namestudent',sname_student='$snamestudent',id_faculty='$facultyid',id_department='$departmentid',id_division='$divisionid',id_curr='$typestudentid' where id_student='$idstudent'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>