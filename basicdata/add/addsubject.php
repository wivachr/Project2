<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "insert into subject values('$idsubject','$subjectname','$credits')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>