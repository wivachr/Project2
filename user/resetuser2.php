<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($pass) || trim($pass)==="") { exit; }
    include('../connectdatabase.php');
	$id = (int)$id;
	$mdpass=md5($pass);
	$sql = "update user set password='$mdpass' where id_user='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$pass";
?>