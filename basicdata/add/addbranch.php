<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($branchname) || trim($branchname)==="") { exit; }
	include('../../connectdatabase.php');
	$branchname = mysqli_real_escape_string($connect, $branchname);
	$branchsname = mysqli_real_escape_string($connect, $branchsname);
	$boardid = (int)$boardid;
	$departmentid = (int)$departmentid;
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