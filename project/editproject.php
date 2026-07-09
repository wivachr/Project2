<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
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
	$sqlchk = "select id_project from project where id_project='$id' AND (id_user='".(int)$_SESSION['iduser']."' OR '".($_SESSION['right'] ?? '')."'='2')";
	$resultchk = mysqli_query($connect, $sqlchk);
	if(mysqli_num_rows($resultchk)==0) { exit; }
	$sql = "update project set address_project='$address',email_project='$email',name_project='$nameproject',casestudy_project='$casestudy',engname_project='$engnameproject',engcasestudy_project='$engcasestudy' where id_project='$id'";
	mysqli_query($connect, $sql);
	$sql = "update committee set id_teacher='$idteacher' where id_project='$id' AND position='ที่ปรึกษา'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>