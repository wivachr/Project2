<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "update project set id_statusproject='6' where id_project='$idp'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>