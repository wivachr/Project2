<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($idteacher) || trim($idteacher)==="") { exit; }
include('../connectdatabase.php');
	$id = (int)$id;
	$idteacher = (int)$idteacher;
	$type = mysqli_real_escape_string($connect, $type);
	$detail = mysqli_real_escape_string($connect, $detail);
	$sql = "delete from committee where id_project='$id' AND position<>'ที่ปรึกษา'";
	mysqli_query($connect, $sql);
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
	if($no!="true")
	{
	$sql = "select max(id_projecthistory) from projecthistory";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$idh = $rs[0]+1;
	}
	$year = date("Y")+543;
	$sql = "insert into projecthistory values('$idh','$id','$type','$detail','$year".date("-n-j")."')";
	//echo $sql;
	mysqli_query($connect, $sql);
	}
	mysqli_close($connect);
?>