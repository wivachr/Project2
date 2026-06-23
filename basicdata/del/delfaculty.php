<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from faculty where id_faculty = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>