<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || ($_SESSION['right']!='1' && $_SESSION['right']!='2')) { exit; }
	if(!isset($roomname) || trim($roomname)==="") { exit; }
	include('../../connectdatabase.php');
	$roomname = mysqli_real_escape_string($connect, $roomname);
	$sql = "select max(id_room) from room";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into room values('$id','$roomname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>