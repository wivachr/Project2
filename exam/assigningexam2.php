<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$dateassex = mysqli_real_escape_string($connect, $dateassex);
	$timeassex = mysqli_real_escape_string($connect, $timeassex);
	$endtimeassex = mysqli_real_escape_string($connect, $endtimeassex);
	$roomassex = (int)$roomassex;
	$sql = "update assignexam set date_assignexam='$dateassex',time_assignexam='$timeassex',id_room='$roomassex',endtime_assignexam='$endtimeassex' where id_assignexam='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>