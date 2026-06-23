<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from `right` where id_right = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>