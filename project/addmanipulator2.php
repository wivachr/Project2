<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($idstu1) || trim($idstu1)==="" || !isset($idproject) || trim($idproject)==="") { exit; }
	include('../connectdatabase.php');
	$idstu1 = mysqli_real_escape_string($connect, $idstu1);
	$tel1 = mysqli_real_escape_string($connect, $tel1);
	$idproject = (int)$idproject;
	$sql = "select max(id_manipulator) from manipulator";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idmanipulator = $rs[0]+1;
	}
	$sql = "insert into manipulator values('$idmanipulator','$idstu1','".$idproject."','$tel1')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>