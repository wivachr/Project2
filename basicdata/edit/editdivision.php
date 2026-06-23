<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update division set id_division='$iddiv2',name_division='$name',initials_division='$sname',id_faculty=$facultyid,id_department=$departmentid where id_division='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>