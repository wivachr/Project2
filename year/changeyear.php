<? include('../change.php'); ?>
<?
    if(!isset($year) || trim($year)==="" || !isset($semester) || trim($semester)==="") { exit; }
    include('../connectdatabase.php');
	$sql = "update academicyear set year='$year',semester='$semester'";
	mysqli_query($connect, $sql);
	$sql = "delete  from teacherfreetime";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>