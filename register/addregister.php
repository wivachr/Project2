<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "insert into registration values('$yearregis','$semesterregis','$idsregis','$idsuregis','$section')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>