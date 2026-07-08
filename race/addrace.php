<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($topicrace) || trim($topicrace)==="") { exit; }
	include('../connectdatabase.php');
	$topicrace = (int)$topicrace;
	$detailrace = mysqli_real_escape_string($connect, $detailrace);
	$statusrace = mysqli_real_escape_string($connect, $statusrace);
	$sql = "select max(id_race) from race";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into race values('$id','$topicrace','$detailrace','$statusrace')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>