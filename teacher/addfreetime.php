<? include('../change.php'); ?>
<?
	if(!isset($day) || trim($day)==="" || !isset($time) || trim($time)==="" || !isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$sql = "insert into teacherfreetime values('$day','$time','$id')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>