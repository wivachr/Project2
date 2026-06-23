<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "update academicyear set year='$year',semester='$semester'";
	mysqli_query($connect, $sql);
	$sql = "delete  from teacherfreetime";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>