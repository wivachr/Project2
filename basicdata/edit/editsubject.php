<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="") { exit; }
    include('../../connectdatabase.php');
	$id = mysqli_real_escape_string($connect, $id);
	$idedit = mysqli_real_escape_string($connect, $idedit);
	$name = mysqli_real_escape_string($connect, $name);
	$credits = mysqli_real_escape_string($connect, $credits);
	$sql = "update subject set id_subject='$idedit',name_subject='$name',credits='$credits' where id_subject='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>