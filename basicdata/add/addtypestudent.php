<? include('../../change.php'); ?>
<?
	if(!isset($id) || trim($id)==="" || !isset($typestudentname) || trim($typestudentname)==="") { exit; }
	include('../../connectdatabase.php');
	$sql = "insert into curriculum values('$id','$typestudentname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>