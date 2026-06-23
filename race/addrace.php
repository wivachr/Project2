<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "select max(id_race) from race";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into race values('$id','$topicrace','$detailrace','$statusrace')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>