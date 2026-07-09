<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$sql = "select project.id_project from manipulator,project where manipulator.id_project=project.id_project AND id_manipulator='$id' AND (project.id_user='".(int)$_SESSION['iduser']."' OR '".($_SESSION['right'] ?? '')."'='2')";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)==0) { exit; }
	$sql = "delete from manipulator where id_manipulator = '$id' ";
	mysqli_query($connect, $sql);
	//echo $sql;
	mysqli_close($connect);
?>