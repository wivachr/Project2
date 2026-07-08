<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['iduser'])) { exit; }
	if(!isset($idproject) || trim($idproject)==="") { exit; }
	include('../connectdatabase.php');
	$idproject = (int)$idproject;
	$sqlchk = "select id_project from project where id_project='$idproject' AND (id_user='".(int)$_SESSION['iduser']."' OR '".($_SESSION['right'] ?? '')."'='2')";
	$resultchk = mysqli_query($connect, $sqlchk);
	if(mysqli_num_rows($resultchk)==0) { exit; }
	$sqldupe = "select id_exam from exam where id_project='$idproject' AND id_typeexam='1' AND id_statusproject='20'";
	$resultdupe = mysqli_query($connect, $sqldupe);
	if(mysqli_num_rows($resultdupe)>0) { exit; }
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
	$sql = "select max(id_exam) from exam";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}
	$sql = "insert into exam values('$id','$idproject','1','','20','','$year','$semester')";
	mysqli_query($connect, $sql);
	$sql = "update project set id_statusproject='2' where id_project='$idproject'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>