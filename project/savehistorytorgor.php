<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "select max(id_projecthistory) from projecthistory";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idh = $rs[0]+1;
	}
	$year = date("Y")+543;
	$sql = "insert into projecthistory values('$idh','$id','$type','$detail','$year".date("-n-j")."')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>