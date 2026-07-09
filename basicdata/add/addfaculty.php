<? session_start(); ?>
<? include('../../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($idfac2) || trim($idfac2)==="" || !isset($facultyname) || trim($facultyname)==="") { exit; }
	include('../../connectdatabase.php');
	$idfac2 = (int)$idfac2;
	$facultyname = mysqli_real_escape_string($connect, $facultyname);
	$facultysname = mysqli_real_escape_string($connect, $facultysname);
	/*$sql = "select max(id_faculty) from faculty";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$id = $rs[0]+1;
	}*/
	$sql = "insert into faculty values('$idfac2','$facultyname','$facultysname')";
	mysqli_query($connect, $sql);
	echo "";
	mysqli_close($connect);
?>