<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
    include('../connectdatabase.php');
	$id = (int)$id;
	$topicrace = (int)$topicrace;
	$detailrace = mysqli_real_escape_string($connect, $detailrace);
	$statusrace = mysqli_real_escape_string($connect, $statusrace);
	$sql = "update race set id_project='$topicrace',location_race='$detailrace',status_race='$statusrace' WHERE id_race='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>