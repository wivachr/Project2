<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || ($_SESSION['right']!='1' && $_SESSION['right']!='2')) { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="") { exit; }
    include('../../connectdatabase.php');
	$id = (int)$id;
	$name = mysqli_real_escape_string($connect, $name);
	$sql = "update room set name_room='$name' where id_room='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>