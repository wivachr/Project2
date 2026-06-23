<? include('../change.php');
	$type_file= pathinfo($_FILES['fileupload']['name'],PATHINFO_EXTENSION);
 ?>
	<script language="JavaScript">
<!--
window.parent.uploadfalse();
//-->
</script>
<?php
if($type_file!="pdf"&&$type_file!="PDF")
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
		  	$sql = "select * from academicyear";
			 $result = mysqli_query($connect, $sql);
			 while($rs = mysqli_fetch_array($result))
			{
				$year = $rs[0];
				$semester = $rs[1];
			}
			  mysqli_close($connect);
$oldumask = umask(0);
$dir = $year.'-'.$semester;
mkdir('../'.$dir, 0777); // or even 01777 so you get the sticky bit set
umask($oldumask);
?>

<?

//sleep(3);
$dest = "../".$dir."/" . $idproject.".pdf";

move_uploaded_file($_FILES['fileupload']['tmp_name'], $dest);
$dest = $dir."/" . $idproject.".pdf";
	$sql = "update project set torgor_project='$dest' where id_project='$idproject'";
	mysqli_query($connect, $sql);
?>
<script language="JavaScript">
<!--
window.parent.uploadok('<?=$tempfile?>');
//-->
</script>
<? } ?>