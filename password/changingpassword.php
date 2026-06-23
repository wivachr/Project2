<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$mdpass = md5($password);
	$sql = "update user set password='$mdpass' WHERE id_user='$iduser'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>