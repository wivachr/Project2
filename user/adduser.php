<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "select max(id_user) from user";
	$result = mysqli_query($connect, $sql);
	$mdfive = md5($password);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into user values('$id','$username1','$usersname','$nameuser','$mdfive','$rightid','1')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>