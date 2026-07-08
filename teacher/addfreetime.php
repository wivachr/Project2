<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($day) || trim($day)==="" || !isset($time) || trim($time)==="" || !isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$day = mysqli_real_escape_string($connect, $day);
	$time = mysqli_real_escape_string($connect, $time);
	$sql = "insert into teacherfreetime values('$day','$time','$id')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>