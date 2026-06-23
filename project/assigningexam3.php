<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "select max(id_assignexam) from assignexam";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idassex = $rs[0]+1;
	}
	$sql = "insert into assignexam values('$idassex','$idsubmit','$dateassex','$timeassex','$endtimeassex','$roomassex')";
	mysqli_query($connect, $sql);
	$sql = "update project set id_statusproject='9' where id_project='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>