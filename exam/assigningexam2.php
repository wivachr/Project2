<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "update assignexam set date_assignexam='$dateassex',time_assignexam='$timeassex',id_room='$roomassex',endtime_assignexam='$endtimeassex' where id_assignexam='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>