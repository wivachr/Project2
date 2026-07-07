<? include('../../change.php'); ?>
<?
	if(!isset($idfac2) || trim($idfac2)==="" || !isset($facultyname) || trim($facultyname)==="") { exit; }
	include('../../connectdatabase.php');
	/*$sql = "select max(id_faculty) from faculty";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}*/
	$sql = "insert into faculty values('$idfac2','$facultyname','$facultysname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>