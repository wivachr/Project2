<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($nameteacher) || trim($nameteacher)==="") { exit; }
	include('../connectdatabase.php');
	$idtitle = (int)$idtitle;
	$idititle = (int)$idititle;
	$nameteacher = mysqli_real_escape_string($connect, $nameteacher);
	$snameteacher = mysqli_real_escape_string($connect, $snameteacher);
	$initialsteacher = mysqli_real_escape_string($connect, $initialsteacher);
	$facultyid = (int)$facultyid;
	$departmentid = (int)$departmentid;
	$divisionid = (int)$divisionid;
	$telteacher = mysqli_real_escape_string($connect, $telteacher);
	$emailteacher = mysqli_real_escape_string($connect, $emailteacher);
	$sql = "select max(id_user) from user";
	$result = mysqli_query($connect, $sql);
	$mdfive = md5("1234");
	while($rs = mysqli_fetch_array($result))
	{
		$iduser = $rs[0]+1;
	}
	$sql = "insert into user values('$iduser','$nameteacher','$snameteacher','$initialsteacher','$mdfive','3','1')";
	mysqli_query($connect, $sql);
	$sql = "select max(id_teacher) from teacher";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into teacher values('$id','$idtitle','$idititle','$nameteacher','$snameteacher','$initialsteacher','$facultyid','$departmentid','$divisionid','$telteacher','$emailteacher','$iduser')";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>