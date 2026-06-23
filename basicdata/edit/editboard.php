<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update board set name_board='$name',initials_board='$sname' where id_board='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>