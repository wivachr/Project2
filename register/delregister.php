<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($yearregis) || trim($yearregis)==="" || !isset($idsregis) || trim($idsregis)==="") { exit; }
	include('../connectdatabase.php');
	$yearregis = mysqli_real_escape_string($connect, $yearregis);
	$semesterregis = mysqli_real_escape_string($connect, $semesterregis);
	$idsregis = mysqli_real_escape_string($connect, $idsregis);
	$idsuregis = mysqli_real_escape_string($connect, $idsuregis);
	$section = mysqli_real_escape_string($connect, $section);
	$sql = "delete from registration where year_registration = '$yearregis' AND semester_registration='$semesterregis' AND id_student='$idsregis' AND id_subject='$idsuregis' AND section='$section'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>