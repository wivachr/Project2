<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "delete from board where id_board = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>