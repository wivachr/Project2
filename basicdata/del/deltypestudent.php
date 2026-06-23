<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from curriculum where id_curr = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>