<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from statusproject where id_statusproject = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>