<? include('../change.php'); ?>
<?
    include('../connectdatabase.php');
	$sql = "update teacher set id_academictitle='$idatitle',id_title='$idtitle',name_teacher='$nameteacher',sname_teacher='$snameteacher',id_faculty='$facultyid',id_department='$departmentid',id_division='$divisionid',tel_teacher='$telteacher',email_teacher='$emailteacher' where id_teacher='$id'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	//echo "$sql";
?>