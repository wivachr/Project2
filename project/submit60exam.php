<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
	$sql = "select max(id_exam) from exam";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into exam values('$id','$idproject','3','','20','','$year','$semester')";
	mysqli_query($connect, $sql);
	$sql = "update project set id_statusproject='7' where id_project='$idproject'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>