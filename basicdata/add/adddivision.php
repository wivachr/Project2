<? include('../../change.php'); ?>
<?
	if(!isset($iddiv2) || trim($iddiv2)==="" || !isset($divisionname) || trim($divisionname)==="") { exit; }
	include('../../connectdatabase.php');
	/*$sql = "select max(id_division) from division";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}*/
	$sql = "insert into division values('$iddiv2','$divisionname','$divisionsname','$facultyid','$departmentid')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>