<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update `right` set name_right='$name' where id_right='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>