<? include('../../change.php'); ?>
<?
    include('../../connectdatabase.php');
	$sql = "update academictitle set name_academictitle='$name',initials_academictitle='$i' where id_academictitle='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>