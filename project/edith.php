<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($idp) || trim($idp)==="") { exit; }
	include('../connectdatabase.php');
	$idp = (int)$idp;
	$sql = "update project set id_statusproject='6' where id_project='$idp'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>