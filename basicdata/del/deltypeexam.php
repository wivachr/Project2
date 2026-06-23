<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from typeexam where id_typeexam = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>