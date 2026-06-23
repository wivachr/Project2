<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update typeexam set name_typeexam='$name' where id_typeexam='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>