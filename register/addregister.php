<? include('../change.php'); ?>
<?
	if(!isset($yearregis) || trim($yearregis)==="" || !isset($idsregis) || trim($idsregis)==="" || !isset($idsuregis) || trim($idsuregis)==="") { exit; }
	include('../connectdatabase.php');
	$sql = "insert into registration values('$yearregis','$semesterregis','$idsregis','$idsuregis','$section')";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>