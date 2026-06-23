<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update faculty set id_faculty='$idfac2',name_faculty='$name',initials_faculty='$sname' where id_faculty='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>