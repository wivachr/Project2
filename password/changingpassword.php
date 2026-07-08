<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
	if(!isset($password) || trim($password)==="") { exit; }
	$iduser = (int)$_SESSION['iduser'];
    include('../connectdatabase.php');
	$mdpass = md5($password);
	$sql = "update user set password='$mdpass' WHERE id_user='$iduser'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>