<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($typeexamname) || trim($typeexamname)==="") { exit; }
	include('../../connectdatabase.php');
	$typeexamname = mysqli_real_escape_string($connect, $typeexamname);
	$sql = "select max(id_typeexam) from typeexam";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into typeexam values('$id','$typeexamname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>