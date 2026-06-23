<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$mdpass=md5($password);
	$sql = "update user set name_user='$name',sname_user='$sname',username='$nameuser',password='$mdpass',id_right=$rightid where id_user='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>