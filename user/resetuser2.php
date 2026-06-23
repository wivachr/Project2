<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$mdpass=md5($pass);
	$sql = "update user set password='$mdpass' where id_user='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$pass";
?>