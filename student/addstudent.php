<? include('../change.php'); ?>
<?
	if(!isset($idstudent) || trim($idstudent)==="" || !isset($namestudent) || trim($namestudent)==="") { exit; }
	include('../connectdatabase.php');
	$sql = "insert into student values('$idstudent','$idtitle','$namestudent','$snamestudent','$facultyid','$departmentid','$divisionid','$typestudentid')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>