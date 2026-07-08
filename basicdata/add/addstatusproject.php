<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($statusprojectname) || trim($statusprojectname)==="") { exit; }
	include('../../connectdatabase.php');
	$statusprojectname = mysqli_real_escape_string($connect, $statusprojectname);
	$sql = "select max(id_statusproject) from statusproject";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into statusproject values('$id','$statusprojectname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>