<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "update registration set year_registration='$yearregis',semester_registration='$semesterregis',id_student='$idsregis',id_subject='$idsuregis',section='$section' WHERE year_registration='$oldyearregis' AND semester_registration='$oldsemesterregis' AND id_student='$oldidsregis' AND id_subject='$oldidsuregis' AND section='$oldsection'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>