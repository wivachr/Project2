<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($academictitlename) || trim($academictitlename)==="") { exit; }
	include('../../connectdatabase.php');
	$academictitlename = mysqli_real_escape_string($connect, $academictitlename);
	$it = mysqli_real_escape_string($connect, $it);
	$sql = "select max(id_academictitle) from academictitle";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into academictitle values('$id','$academictitlename','$it')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>