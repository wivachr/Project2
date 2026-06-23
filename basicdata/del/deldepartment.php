<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from department where id_department = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>