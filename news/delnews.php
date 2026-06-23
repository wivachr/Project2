<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from news where id_news=$id";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>