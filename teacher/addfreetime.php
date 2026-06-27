<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "insert into teacherfreetime values('$day','$time','$id')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>