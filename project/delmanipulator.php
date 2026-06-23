<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from manipulator where id_manipulator = '$id' ";
	mysqli_query($connect, $sql);
	//echo $sql;
	mysqli_close($connect);
?>