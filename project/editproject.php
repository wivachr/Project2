<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "update project set address_project='$address',email_project='$email',name_project='$nameproject',casestudy_project='$casestudy',engname_project='$engnameproject',engcasestudy_project='$engcasestudy' where id_project='$id'";
	mysqli_query($connect, $sql);
	$sql = "update committee set id_teacher='$idteacher' where id_project='$id' AND position='ที่ปรึกษา'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "Update Success;";
?>