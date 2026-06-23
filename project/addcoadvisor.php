<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "select max(id_coadvisor) from coadvisor";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into coadvisor values('$id','$idproject','$idtitle','$namecoadvisor','$snamecoadvisor')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>