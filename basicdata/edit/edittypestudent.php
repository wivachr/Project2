<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="") { exit; }
    include('../../connectdatabase.php');
	$id = mysqli_real_escape_string($connect, $id);
	$editid = mysqli_real_escape_string($connect, $editid);
	$name = mysqli_real_escape_string($connect, $name);
	$sql = "update curriculum set id_curr='$editid',name_curr='$name' where id_curr='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>