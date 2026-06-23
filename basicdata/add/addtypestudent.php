<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "insert into curriculum values('$id','$typestudentname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>