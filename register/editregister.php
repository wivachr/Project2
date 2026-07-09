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
	$oldyearregis = mysqli_real_escape_string($connect, $oldyearregis);
	$oldsemesterregis = mysqli_real_escape_string($connect, $oldsemesterregis);
	$oldidsregis = mysqli_real_escape_string($connect, $oldidsregis);
	$oldidsuregis = mysqli_real_escape_string($connect, $oldidsuregis);
	$oldsection = mysqli_real_escape_string($connect, $oldsection);
	$sql = "update registration set year_registration='$yearregis',semester_registration='$semesterregis',id_student='$idsregis',id_subject='$idsuregis',section='$section' WHERE year_registration='$oldyearregis' AND semester_registration='$oldsemesterregis' AND id_student='$oldidsregis' AND id_subject='$oldidsuregis' AND section='$oldsection'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>