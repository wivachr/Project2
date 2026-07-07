<? session_start();?>
<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "select max(id_news) from news";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$year = date("Y")+543;
	$sql = "insert into news (id_news,topic_news,detail_news,id_user,date_news) values('$id','$topicnews','$detailnews','".$_SESSION['iduser']."','$year".date("-n-j")."')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	echo $id;
?>