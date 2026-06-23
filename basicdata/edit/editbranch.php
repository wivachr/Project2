<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update branch set name_branch='$name',initials_branch='$sname',id_board=$boardid,id_department=$departmentid where id_branch='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>