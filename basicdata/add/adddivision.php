<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($iddiv2) || trim($iddiv2)==="" || !isset($divisionname) || trim($divisionname)==="") { exit; }
	include('../../connectdatabase.php');
	$iddiv2 = (int)$iddiv2;
	$divisionname = mysqli_real_escape_string($connect, $divisionname);
	$divisionsname = mysqli_real_escape_string($connect, $divisionsname);
	$facultyid = (int)$facultyid;
	$departmentid = (int)$departmentid;
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