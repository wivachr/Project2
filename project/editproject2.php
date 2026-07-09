<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($nameproject) || trim($nameproject)==="") { exit; }
    include('../connectdatabase.php');
	$id = (int)$id;
	$idteacher = (int)$idteacher;
	$address = mysqli_real_escape_string($connect, $address);
	$email = mysqli_real_escape_string($connect, $email);
	$nameproject = mysqli_real_escape_string($connect, $nameproject);
	$casestudy = mysqli_real_escape_string($connect, $casestudy);
	$engnameproject = mysqli_real_escape_string($connect, $engnameproject);
	$engcasestudy = mysqli_real_escape_string($connect, $engcasestudy);
	$type = mysqli_real_escape_string($connect, $type);
	$detail = mysqli_real_escape_string($connect, $detail);
	$sql = "update project set address_project='$address',email_project='$email',name_project='$nameproject',casestudy_project='$casestudy',engname_project='$engnameproject',engcasestudy_project='$engcasestudy' where id_project='$id'";
	mysqli_query($connect, $sql);
	$sql = "update committee set id_teacher='$idteacher' where id_project='$id' AND position='ที่ปรึกษา'";
	mysqli_query($connect, $sql);
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
	mysqli_close($connect);
	echo "แก้ไขข้อมูลเรียบร้อย";
?>