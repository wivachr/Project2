<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "delete from registration where year_registration = '$yearregis' AND semester_registration='$semesterregis' AND id_student='$idsregis' AND id_subject='$idsuregis' AND section='$section'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>