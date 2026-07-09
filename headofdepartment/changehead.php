<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
    if(!isset($idteacher) || trim($idteacher)==="") { exit; }
    include('../connectdatabase.php');
	$idteacher = (int)$idteacher;
	$sql = "update headofdepartment set id_teacher='$idteacher'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>