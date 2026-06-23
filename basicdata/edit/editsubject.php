<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update subject set id_subject='$idedit',name_subject='$name',credits='$credits' where id_subject='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>