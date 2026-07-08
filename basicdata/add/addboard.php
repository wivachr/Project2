<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($boardname) || trim($boardname)==="") { exit; }
	include('../../connectdatabase.php');
	$boardname = mysqli_real_escape_string($connect, $boardname);
	$boardsname = mysqli_real_escape_string($connect, $boardsname);
	$sql = "select max(id_board) from board";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into board values('$id','$boardname','$boardsname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>