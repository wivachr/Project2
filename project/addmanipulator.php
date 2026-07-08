<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($idstu1) || trim($idstu1)==="" || empty($_SESSION["idproject"])) { exit; }
	include('../connectdatabase.php');
	$idstu1 = mysqli_real_escape_string($connect, $idstu1);
	$tel1 = mysqli_real_escape_string($connect, $tel1);
	$idprojectsess = (int)$_SESSION["idproject"];
	$sql = "select max(id_manipulator) from manipulator";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idmanipulator = $rs[0]+1;
	}
	$sql = "insert into manipulator values('$idmanipulator','$idstu1','$idprojectsess','$tel1')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>