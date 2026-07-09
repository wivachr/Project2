<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($idsubmit) || trim($idsubmit)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$idsubmit = (int)$idsubmit;
	$dateassex = mysqli_real_escape_string($connect, $dateassex);
	$timeassex = mysqli_real_escape_string($connect, $timeassex);
	$endtimeassex = mysqli_real_escape_string($connect, $endtimeassex);
	$roomassex = (int)$roomassex;
	$sql = "select max(id_assignexam) from assignexam";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idassex = $rs[0]+1;
	}
	$sql = "insert into assignexam values('$idassex','$idsubmit','$dateassex','$timeassex','$endtimeassex','$roomassex')";
	mysqli_query($connect, $sql);
	$sql = "update project set id_statusproject='9' where id_project='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>