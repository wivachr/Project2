<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
	if(!isset($idproject) || trim($idproject)==="" || !isset($namecoadvisor) || trim($namecoadvisor)==="") { exit; }
	include('../connectdatabase.php');
	$idproject = (int)$idproject;
	$idtitle = (int)$idtitle;
	$namecoadvisor = mysqli_real_escape_string($connect, $namecoadvisor);
	$snamecoadvisor = mysqli_real_escape_string($connect, $snamecoadvisor);
	$sql = "select id_project from project where id_project='$idproject' AND (id_user='".(int)$_SESSION['iduser']."' OR '".($_SESSION['right'] ?? '')."'='2')";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)==0) { exit; }
	$sql = "select max(id_coadvisor) from coadvisor";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into coadvisor values('$id','$idproject','$idtitle','$namecoadvisor','$snamecoadvisor')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>