<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from student where id_student = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>