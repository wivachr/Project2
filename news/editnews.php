<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
	if(!isset($id) || trim($id)==="" || !isset($topicnews) || trim($topicnews)==="") { exit; }
    include('../connectdatabase.php');
	$id = (int)$id;
	$topicnews = mysqli_real_escape_string($connect, $topicnews);
	$detailnews = mysqli_real_escape_string($connect, $detailnews);
	$sql = "update news set topic_news='$topicnews',detail_news='$detailnews' WHERE id_news='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>