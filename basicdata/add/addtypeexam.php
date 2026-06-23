<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "select max(id_typeexam) from typeexam";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into typeexam values('$id','$typeexamname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>