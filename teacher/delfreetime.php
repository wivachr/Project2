<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$day = mysqli_real_escape_string($connect, $day);
	$time = mysqli_real_escape_string($connect, $time);
	$sql = "delete from teacherfreetime where id_teacher = '$id' AND day_freetime='$day' AND time_freetime='$time' ";
	mysqli_query($connect, $sql);
	//echo $sql;
	mysqli_close($connect);
?>