<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
    if(!isset($year) || trim($year)==="" || !isset($semester) || trim($semester)==="") { exit; }
    include('../connectdatabase.php');
	$year = mysqli_real_escape_string($connect, $year);
	$semester = mysqli_real_escape_string($connect, $semester);
	$sql = "update academicyear set year='$year',semester='$semester'";
	mysqli_query($connect, $sql);
	$sql = "delete  from teacherfreetime";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>