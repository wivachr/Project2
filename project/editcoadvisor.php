<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	$sql = "update coadvisor set id_title='$idtitle',name_coadvisor='$namecoadvisor',sname_coadvisor='$snamecoadvisor' where id_coadvisor='$id'";
	//echo $sql;
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>