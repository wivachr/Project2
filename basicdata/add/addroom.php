<? include('../../change.php'); ?>
<?
	if(!isset($roomname) || trim($roomname)==="") { exit; }
	include('../../connectdatabase.php');
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