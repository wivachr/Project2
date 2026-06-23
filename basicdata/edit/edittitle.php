<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update title set id_title='$idtitle2',name_title='$name' where id_title='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>