<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from teacher where id_teacher = '$id' ";
	mysqli_query($connect, $sql);
	$sql = "delete from user where username = '$u' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>