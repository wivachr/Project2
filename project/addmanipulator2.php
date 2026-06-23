<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "select max(id_manipulator) from manipulator";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idmanipulator = $rs[0]+1;
	}
	$sql = "insert into manipulator values('$idmanipulator','$idstu1','".$idproject."','$tel1')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>