<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="") { exit; }
    include('../../connectdatabase.php');
	$id = (int)$id;
	$idfac2 = (int)$idfac2;
	$name = mysqli_real_escape_string($connect, $name);
	$sname = mysqli_real_escape_string($connect, $sname);
	$sql = "update faculty set id_faculty='$idfac2',name_faculty='$name',initials_faculty='$sname' where id_faculty='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>