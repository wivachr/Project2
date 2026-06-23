<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from title where id_title = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>