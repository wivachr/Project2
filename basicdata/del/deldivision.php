<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from division where id_division = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>