<? include('../../change.php'); ?>
<?
	if(!isset($idsubject) || trim($idsubject)==="" || !isset($subjectname) || trim($subjectname)==="") { exit; }
	include('../../connectdatabase.php');
	$sql = "insert into subject values('$idsubject','$subjectname','$credits')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>