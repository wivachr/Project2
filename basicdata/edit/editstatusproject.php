<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update statusproject set name_statusproject='$name' where id_statusproject='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>