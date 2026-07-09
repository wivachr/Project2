<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($iddept2) || trim($iddept2)==="" || !isset($departmentname) || trim($departmentname)==="") { exit; }
	include('../../connectdatabase.php');
	$iddept2 = (int)$iddept2;
	$departmentname = mysqli_real_escape_string($connect, $departmentname);
	$departmentsname = mysqli_real_escape_string($connect, $departmentsname);
	$facultyid = (int)$facultyid;
	$sql = "select max(id_department) from department";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into department values('$iddept2','$departmentname','$departmentsname','$facultyid')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>