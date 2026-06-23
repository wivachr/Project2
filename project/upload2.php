<? include('../change.php');
	$type_file= pathinfo($_FILES['fileupload']['name'],PATHINFO_EXTENSION); ?>
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
$olds = explode("/", $old);
if($olds[1][6]==".")
{
	$idprojects = substr($olds[1],0,6)."-1";
}
else
{
	$nn=$olds[1][7]+1;
	$idprojects = substr($olds[1],0,6)."-".$nn;
}
$dest = "../".$dir."/" . $idprojects.".pdf";
move_uploaded_file($_FILES['fileupload']['tmp_name'], $dest);
$dest = $dir."/" . $idprojects.".pdf";
	$sql = "update project set torgor_project='$dest' where id_project='$idproject'";
	mysqli_query($connect, $sql);
?>
<script language="JavaScript">
<!--
window.parent.savehisup('<?=$old?>');
window.parent.uploadok('<?=$tempfile?>');
//-->
</script>
<? } ?>