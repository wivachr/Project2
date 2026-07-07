<? include('../change.php');
	$type_file = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
?>
<?php
if(strtolower($type_file)!="pdf")
{
	?>
	<script language="JavaScript">
<!--
window.parent.uploadfalse();
//-->
	</script>
	<?
}
else
{
	include('../connectdatabase.php');
	$dest = "uploads/" . (int)$idnews . ".pdf";
	move_uploaded_file($_FILES['fileupload']['tmp_name'], $dest);
	$sql = "update news set pdf_news='$dest' where id_news='".(int)$idnews."'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
	?>
	<script language="JavaScript">
<!--
window.parent.uploadok();
//-->
	</script>
	<?
}
?>
