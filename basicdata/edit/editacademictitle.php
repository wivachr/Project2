<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="") { exit; }
    include('../../connectdatabase.php');
	$id = (int)$id;
	$name = mysqli_real_escape_string($connect, $name);
	$i = mysqli_real_escape_string($connect, $i);
	$sql = "update academictitle set name_academictitle='$name',initials_academictitle='$i' where id_academictitle='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>