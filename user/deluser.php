<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$sql = "delete from user where id_user = '$id' ";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>