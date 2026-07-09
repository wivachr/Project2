<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="") { exit; }
	include('../connectdatabase.php');
	$id = mysqli_real_escape_string($connect, $id);
	$sql = "delete from student where id_student = '$id' ";
	mysqli_query($connect, $sql);
	//echo "Delete Success.";
	mysqli_close($connect);
?>