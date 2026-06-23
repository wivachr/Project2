<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "select max(id_statusproject) from statusproject";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into statusproject values('$id','$statusprojectname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>