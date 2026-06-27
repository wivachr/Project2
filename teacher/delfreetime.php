<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from teacherfreetime where id_teacher = '$id' AND day_freetime='$day' AND time_freetime='$time' ";
	mysqli_query($connect, $sql);
	//echo $sql;
	mysqli_close($connect);
?>