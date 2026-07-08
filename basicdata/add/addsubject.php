<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($idsubject) || trim($idsubject)==="" || !isset($subjectname) || trim($subjectname)==="") { exit; }
	include('../../connectdatabase.php');
	$idsubject = mysqli_real_escape_string($connect, $idsubject);
	$subjectname = mysqli_real_escape_string($connect, $subjectname);
	$credits = mysqli_real_escape_string($connect, $credits);
	$sql = "insert into subject values('$idsubject','$subjectname','$credits')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>