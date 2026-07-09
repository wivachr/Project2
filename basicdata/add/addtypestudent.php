<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($typestudentname) || trim($typestudentname)==="") { exit; }
	include('../../connectdatabase.php');
	$id = mysqli_real_escape_string($connect, $id);
	$typestudentname = mysqli_real_escape_string($connect, $typestudentname);
	$sql = "insert into curriculum values('$id','$typestudentname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>