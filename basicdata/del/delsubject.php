<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from subject where id_subject = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>