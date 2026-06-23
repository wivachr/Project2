<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
	if($resultexam==0)
	{
		$sql = "UPDATE project SET id_statusproject='19' where id_project='$id'";
		mysqli_query($connect, $sql);
		$sql = "UPDATE exam SET id_statusproject='23',comment_exam='$comment' where id_exam='$idsubmit'";
		mysqli_query($connect, $sql);
	}
	else if($resultexam==1)
	{
		$sql = "UPDATE project SET id_statusproject='14' where id_project='$id'";
		mysqli_query($connect, $sql);
		$sql = "UPDATE exam SET id_statusproject='24',comment_exam='$comment' where id_exam='$idsubmit'";
		mysqli_query($connect, $sql);
	}
	else if($resultexam==2)
	{
		$sql = "UPDATE project SET id_statusproject='15' where id_project='$id'";
		mysqli_query($connect, $sql);
		$sql = "UPDATE exam SET id_statusproject='ผ่านแบบมีเงื่อนไข ',comment_exam='$comment' where id_exam='$idsubmit'";
		mysqli_query($connect, $sql);
	}
	else if($resultexam==3)
	{
		$sql = "UPDATE project SET id_statusproject='17' where id_project='$id'";
		mysqli_query($connect, $sql);
		$sql = "UPDATE exam SET id_statusproject='25',comment_exam='$comment' where id_exam='$idsubmit'";
		mysqli_query($connect, $sql);
		$sql = "UPDATE user SET status_user = '0' where username = '$id' ";
		mysqli_query($connect, $sql);
	}
	mysqli_close($connect);
?>