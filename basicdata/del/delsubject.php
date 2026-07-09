<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../../connectdatabase.php');
	$id = mysqli_real_escape_string($connect, $id);
	$sql = "delete from subject where id_subject = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>