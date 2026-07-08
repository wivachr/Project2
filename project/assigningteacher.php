<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($idteacher) || trim($idteacher)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$idteacher = (int)$idteacher;
	$guma = array_map('intval', explode(",", $temp));
	$sql = "select max(id_committee) from committee";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idcom = $rs[0]+1;
	}
	$sql = "insert into committee values('$idcom','$idteacher','$id','ประธาน')";
	mysqli_query($connect, $sql);
	foreach($guma as $a)
	{
		$idcom+=1;
		$sql = "insert into committee values('$idcom','$a','$id','กรรมการ')";
		//echo $sql."<br/>";
		mysqli_query($connect, $sql);
	}
	$sql = "update project set id_statusproject='4' where id_project='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>