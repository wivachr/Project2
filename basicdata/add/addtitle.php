<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($idtitle2) || trim($idtitle2)==="" || !isset($titlename) || trim($titlename)==="") { exit; }
	include('../../connectdatabase.php');
	$idtitle2 = (int)$idtitle2;
	$titlename = mysqli_real_escape_string($connect, $titlename);
	/*$sql = "select max(id_title) from title";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}*/
	$sql = "insert into title values('$idtitle2','$titlename')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>