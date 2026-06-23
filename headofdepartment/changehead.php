<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "update headofdepartment set id_teacher='$idteacher'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>