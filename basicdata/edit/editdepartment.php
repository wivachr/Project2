<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update department set id_department='$iddept2',name_department='$name',initials_department='$sname',id_faculty=$facultyid where id_department='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>