<? include('../change.php');
	$type_file = strtolower(pathinfo($_FILES['fileuploadimage']['name'], PATHINFO_EXTENSION));
	$allowed = array('jpg','jpeg','png','gif');
?>
<?php
if(!in_array($type_file, $allowed, true))
{
	?>
	<script language="JavaScript">
<!--
window.parent.uploadfalseimg();
//-->
	</script>
	<?
}
else
{
	include('../connectdatabase.php');
	$dest = "uploads/img_" . (int)$idnews . "." . $type_file;
	move_uploaded_file($_FILES['fileuploadimage']['tmp_name'], $dest);
	$sql = "update news set image_news='$dest' where id_news='".(int)$idnews."'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	?>
	<script language="JavaScript">
<!--
window.parent.uploadokimg();
//-->
	</script>
	<?
}
?>
