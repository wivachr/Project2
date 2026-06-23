<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$year = date("Y")+543;
	$sql = "update exam set id_statusproject='21',date_submitexam ='$year".date("-n-j")."' where id_exam='$id'";
	mysqli_query($connect, $sql);
	$sql = "update project set id_statusproject='12' where id_project='$idp'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>