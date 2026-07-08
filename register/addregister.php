<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($yearregis) || trim($yearregis)==="" || !isset($idsregis) || trim($idsregis)==="" || !isset($idsuregis) || trim($idsuregis)==="") { exit; }
	include('../connectdatabase.php');
	$yearregis = mysqli_real_escape_string($connect, $yearregis);
	$semesterregis = mysqli_real_escape_string($connect, $semesterregis);
	$idsregis = mysqli_real_escape_string($connect, $idsregis);
	$idsuregis = mysqli_real_escape_string($connect, $idsuregis);
	$section = mysqli_real_escape_string($connect, $section);
	$sql = "insert into registration values('$yearregis','$semesterregis','$idsregis','$idsuregis','$section')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>