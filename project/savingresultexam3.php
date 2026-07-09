<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($id) || trim($id)==="" || !isset($idsubmit) || trim($idsubmit)==="") { exit; }
	include('../connectdatabase.php');
	$id = (int)$id;
	$idsubmit = (int)$idsubmit;
	$comment = mysqli_real_escape_string($connect, $comment);
	if($resultexam==0)
	{
		$sql = "UPDATE project SET id_statusproject='6' where id_project='$id'";
		mysqli_query($connect, $sql);
		$sql = "UPDATE exam SET id_statusproject='22',comment_exam='$comment' where id_exam='$idsubmit'";
		mysqli_query($connect, $sql);
	}
	else if($resultexam==1)
	{
		$sql = "UPDATE project SET id_statusproject='10' where id_project='$id'";
		mysqli_query($connect, $sql);
		$sql = "UPDATE exam SET id_statusproject='24',comment_exam='$comment' where id_exam='$idsubmit'";
		mysqli_query($connect, $sql);
	}
	mysqli_close($connect);
?>