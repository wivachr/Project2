<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$u = mysqli_real_escape_string($connect, $u);
	$sql = "delete from teacher where id_teacher = '$id' ";
	mysqli_query($connect, $sql);
	$sql = "delete from user where username = '$u' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>