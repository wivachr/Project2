<? include('../change.php');
	$type_file= pathinfo($_FILES['fileupload']['name'],PATHINFO_EXTENSION);
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
		  	$sql = "select * from academicyear";
			 $result = mysqli_query($connect, $sql);
			 while($rs = mysqli_fetch_array($result))
			{
				$year = $rs[0];
				$semester = $rs[1];
			}
$oldumask = umask(0);
$dir = $year.'-'.$semester;
if (!is_dir('../'.$dir)) { mkdir('../'.$dir, 0777); }
umask($oldumask);
?>

<?

//sleep(3);
$dest = "../".$dir."/" . $idproject.".pdf";

move_uploaded_file($_FILES['fileupload']['tmp_name'], $dest);
$dest = $dir."/" . $idproject.".pdf";
	$sql = "update project set torgor_project='$dest' where id_project='$idproject'";
	mysqli_query($connect, $sql);
	mysqli_close($connect);
?>
<script language="JavaScript">
<!--
window.parent.uploadok();
//-->
</script>
<? } ?>