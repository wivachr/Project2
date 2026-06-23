<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from race where id_race=$id";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>