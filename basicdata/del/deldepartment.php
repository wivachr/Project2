<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../../connectdatabase.php');
	$id = (int)$id;
	$sql = "delete from department where id_department = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>