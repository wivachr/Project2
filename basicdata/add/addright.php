<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "select max(id_right) from `right`";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into `right` values('$id','$rightname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>