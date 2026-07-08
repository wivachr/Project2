<? session_start(); ?>
<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	$id = (int)$id;
include('../connectdatabase.php');
$nnnum = 0;
$ad = "";
$sad = "";
$master = "";
$smaster = "";
$coad = "";
$scoad = "";
	  		  $sql = "select * from project,statusproject where project.id_statusproject=statusproject.id_statusproject AND  project.id_project='$id'";
			  			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
			   $sql = "select * from committee,teacher,academictitle where id_project='".$rs[0]."' AND position='กรรมการ' AND committee.id_teacher=teacher.id_teacher AND teacher.id_academictitle=academictitle.id_academictitle";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $gum[$nnnum] = $rs3[17].$rs3[7];
				  $sgum[$nnnum] = $rs3[8];
				  $nnnum +=1;
			  }
			   $sql = "select * from committee,teacher,academictitle where id_project='".$rs[0]."' AND position='ที่ปรึกษา' AND committee.id_teacher=teacher.id_teacher AND teacher.id_academictitle=academictitle.id_academictitle";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $ad = $rs3[17].$rs3[7];
				  $sad = $rs3[8];
			  }
			  $sql = "select * from committee,teacher,academictitle where id_project='".$rs[0]."' AND position='ประธาน' AND committee.id_teacher=teacher.id_teacher AND teacher.id_academictitle=academictitle.id_academictitle";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $master = $rs3[17].$rs3[7];
				  $smaster = $rs3[8];
			  }
			  $sql = "select * from coadvisor,title where title.id_title=coadvisor.id_title AND id_project='".$rs[0]."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs4 = mysqli_fetch_array($result))
			  {
				  $idco = $rs4[0];
				  $coad = $rs4[6].$rs4[3];
				  $scoad = $rs4[4];
			  }
			  }
?>
<iframe src="evaluationform-2.php?id=<?=$id?>" width="750" height="1090" frameborder="0">
</iframe>
<iframe src="evaluationform2-2.php?id=<?=$id?>&namee=<?=urlencode($master." ".$smaster)?>" width="750" height="1090" frameborder="0">
</iframe>
<? 
	for($i=0;$i<$nnnum;$i++)
	{
		?>
<iframe src="evaluationform2-2.php?id=<?=$id?>&namee=<?=urlencode($gum[$i]." ".$sgum[$i])?>" width="750" height="1090" frameborder="0">
</iframe>
        <?
	}
	if($coad!="")
	{
?>
<iframe src="evaluationform2-2.php?id=<?=$id?>&namee=<?=urlencode($coad." ".$scoad)?>" width="750" height="1090" frameborder="0">
</iframe>
<? } ?>
<iframe src="evaluationform3.php?id=<?=$id?>&namee=<?=urlencode($master." ".$smaster)?>" width="750" height="1090" frameborder="0">
</iframe>
<? 
	for($i=0;$i<$nnnum;$i++)
	{
		if($gum[$i]!=$ad&&$sgum[$i]!=$sad)
		{
		?>
<iframe src="evaluationform3.php?id=<?=$id?>&namee=<?=urlencode($gum[$i]." ".$sgum[$i])?>" width="750" height="1090" frameborder="0">
</iframe>
        <?
		}
	}
	?>
    <iframe src="evaluationform3-2.php?id=<?=$id?>&namee=<?=urlencode($ad." ".$sad)?>" width="750" height="1090" frameborder="0">
</iframe>
    <?
	if($coad!="")
	{
?>
<iframe src="evaluationform4.php?id=<?=$id?>" width="750" height="1090" frameborder="0">
</iframe>
<? } ?>
<SCRIPT LANGUAGE="JavaScript">
<!--
window.status = 'This page is now ready for print';
window.print();
//-->
</SCRIPT>
</body>
</html>
