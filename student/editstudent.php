<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "update student set id_title='$idtitle',name_student='$namestudent',sname_student='$snamestudent',id_faculty='$facultyid',id_department='$departmentid',id_division='$divisionid',id_curr='$typestudentid' where id_student='$idstudent'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>