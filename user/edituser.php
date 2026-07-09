<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($name) || trim($name)==="" || !isset($nameuser) || trim($nameuser)==="") { exit; }
    include('../connectdatabase.php');
	$id = (int)$id;
	$rightid = (int)$rightid;
	$name = mysqli_real_escape_string($connect, $name);
	$sname = mysqli_real_escape_string($connect, $sname);
	$nameuser = mysqli_real_escape_string($connect, $nameuser);
	if(!empty($password))
	{
		$mdpass = md5($password);
		$sql = "update user set name_user='$name',sname_user='$sname',username='$nameuser',password='$mdpass',id_right=$rightid where id_user='$id'";
	}
	else
	{
		$sql = "update user set name_user='$name',sname_user='$sname',username='$nameuser',id_right=$rightid where id_user='$id'";
	}
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>