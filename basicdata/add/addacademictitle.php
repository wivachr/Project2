<? include('../../change.php'); ?>
<?
	if(!isset($academictitlename) || trim($academictitlename)==="") { exit; }
	include('../../connectdatabase.php');
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