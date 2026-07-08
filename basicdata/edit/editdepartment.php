<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="") { exit; }
    include('../../connectdatabase.php');
	$id = (int)$id;
	$iddept2 = (int)$iddept2;
	$facultyid = (int)$facultyid;
	$name = mysqli_real_escape_string($connect, $name);
	$sname = mysqli_real_escape_string($connect, $sname);
	$sql = "update department set id_department='$iddept2',name_department='$name',initials_department='$sname',id_faculty=$facultyid where id_department='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>