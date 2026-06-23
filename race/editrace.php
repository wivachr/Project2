<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "update race set id_project='$topicrace',location_race='$detailrace',status_race='$statusrace' WHERE id_race='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>