<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "update manipulator set id_student='$idstu',tel_manipulator='$tel2' where id_manipulator='$idmani'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>