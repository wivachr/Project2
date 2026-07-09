<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
	if(!isset($idmani) || trim($idmani)==="" || !isset($idstu) || trim($idstu)==="") { exit; }
	include('../connectdatabase.php');
	$idmani = (int)$idmani;
	$idstu = mysqli_real_escape_string($connect, $idstu);
	$tel2 = mysqli_real_escape_string($connect, $tel2);
	$sql = "select project.id_project from manipulator,project where manipulator.id_project=project.id_project AND id_manipulator='$idmani' AND (project.id_user='".(int)$_SESSION['iduser']."' OR '".($_SESSION['right'] ?? '')."'='2')";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)==0) { exit; }
	$sql = "update manipulator set id_student='$idstu',tel_manipulator='$tel2' where id_manipulator='$idmani'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>