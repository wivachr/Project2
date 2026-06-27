<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "insert into student values('$idstudent','$idtitle','$namestudent','$snamestudent','$facultyid','$departmentid','$divisionid','$typestudentid')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>