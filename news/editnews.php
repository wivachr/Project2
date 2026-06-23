<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "update news set topic_news='$topicnews',detail_news='$detailnews' WHERE id_news='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>