<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from coadvisor where id_coadvisor = '$id' ";
	mysqli_query($connect, $sql);
	//echo $sql;
	mysqli_close($connect);
?>