<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$sql = "delete from news where id_news=$id";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>