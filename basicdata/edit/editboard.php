<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="") { exit; }
    include('../../connectdatabase.php');
	$id = (int)$id;
	$name = mysqli_real_escape_string($connect, $name);
	$sname = mysqli_real_escape_string($connect, $sname);
	$sql = "update board set name_board='$name',initials_board='$sname' where id_board='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>