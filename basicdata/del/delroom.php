<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from room where id_room = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>