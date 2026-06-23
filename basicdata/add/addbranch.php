<? include('../../change.php'); ?>
<?
	include('../../connectdatabase.php');
	$sql = "select max(id_branch) from branch";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into branch values('$id','$branchname','$branchsname','$boardid','$departmentid')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>