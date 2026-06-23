<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from user where id_user = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>