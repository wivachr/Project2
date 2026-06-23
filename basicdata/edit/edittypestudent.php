<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update curriculum set id_curr='$editid',name_curr='$name' where id_curr='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>