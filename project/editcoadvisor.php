<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
	if(!isset($id) || trim($id)==="" || !isset($namecoadvisor) || trim($namecoadvisor)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$idtitle = (int)$idtitle;
	$namecoadvisor = mysqli_real_escape_string($connect, $namecoadvisor);
	$snamecoadvisor = mysqli_real_escape_string($connect, $snamecoadvisor);
	$sql = "select project.id_project from coadvisor,project where coadvisor.id_project=project.id_project AND id_coadvisor='$id' AND (project.id_user='".(int)$_SESSION['iduser']."' OR '".($_SESSION['right'] ?? '')."'='2')";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)==0) { exit; }
	$sql = "update coadvisor set id_title='$idtitle',name_coadvisor='$namecoadvisor',sname_coadvisor='$snamecoadvisor' where id_coadvisor='$id'";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>