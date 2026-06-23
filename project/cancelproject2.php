<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "select id_statusproject from project where id_project = $id";
	$result = mysqli_query($connect, $sql);
	while($result && $rs = mysqli_fetch_array($result))
	{
		$ids = $rs[0];
	}
	if($ids<6)
	{
		$sql = "update project set id_statusproject='17' where id_project='$id'";
		mysqli_query($connect, $sql);
	}
	else if($ids!=0 &&$ids!=16 &&$ids!=17)
	{
		$sql = "update project set id_statusproject='17' where id_project='$id'";
		mysqli_query($connect, $sql);
	}
		$sql = "UPDATE user SET status_user = '0' where username = '$id' ";
		mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>