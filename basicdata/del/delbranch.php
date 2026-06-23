<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from branch where id_branch = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>