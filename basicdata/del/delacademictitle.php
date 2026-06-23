<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from academictitle where id_academictitle = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>