<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($rightname) || trim($rightname)==="") { exit; }
	include('../../connectdatabase.php');
	$rightname = mysqli_real_escape_string($connect, $rightname);
	$sql = "select max(id_right) from `right`";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into `right` values('$id','$rightname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>