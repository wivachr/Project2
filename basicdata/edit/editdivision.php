<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="") { exit; }
    include('../../connectdatabase.php');
	$id = (int)$id;
	$iddiv2 = (int)$iddiv2;
	$facultyid = (int)$facultyid;
	$departmentid = (int)$departmentid;
	$name = mysqli_real_escape_string($connect, $name);
	$sname = mysqli_real_escape_string($connect, $sname);
	$sql = "update division set id_division='$iddiv2',name_division='$name',initials_division='$sname',id_faculty=$facultyid,id_department=$departmentid where id_division='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>