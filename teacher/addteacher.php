<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "select max(id_user) from user";
	$result = mysqli_query($connect, $sql);
	$mdfive = md5("1234");
	while($rs = mysqli_fetch_array($result))
	{
		$iduser = $rs[0]+1;
	}
	$sql = "insert into user values('$iduser','$nameteacher','$snameteacher','$initialsteacher','$mdfive','3','1')";
	mysqli_query($connect, $sql);
	$sql = "select max(id_teacher) from teacher";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into teacher values('$id','$idtitle','$idititle','$nameteacher','$snameteacher','$initialsteacher','$facultyid','$departmentid','$divisionid','$telteacher','$emailteacher','$iduser')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>