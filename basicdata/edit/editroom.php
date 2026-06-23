<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update room set name_room='$name' where id_room='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>