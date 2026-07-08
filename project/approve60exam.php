<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($idp) || trim($idp)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$idp = (int)$idp;
	$year = date("Y")+543;
	$sql = "update exam set id_statusproject='21',date_submitexam ='$year".date("-n-j")."' where id_exam='$id'";
	mysqli_query($connect, $sql);
	$sql = "update project set id_statusproject='8' where id_project='$idp'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>