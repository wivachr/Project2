<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบประเมินสอบหัวข้อแผ่น 1</title>

<style type="text/css">
body,td,th {
	font-size: 19px;
	font-family: TH SarabunPSK,TH SarabunPSK,TH SarabunPSK;
}
#apDiv1 {
	position:absolute;
	left:60px;
	top:21px;
	width:120px;
	height:113px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:25px;
	top:173px;
	width:672px;
	height:432px;
	z-index:2;
}
#apDiv3 {
	position:absolute;
	left:214px;
	top:37px;
	width:359px;
	height:94px;
	z-index:3;
}
#apDiv4 {
	position:absolute;
	left:193px;
	top:4px;
	width:494px;
	height:121px;
	z-index:3;
}
#apDiv5 {
	position:absolute;
	left:413px;
	top:749px;
	width:284px;
	height:322px;
	z-index:4;
}
.ชก {
	font-family: AngsanaUPC;
	font-size: 16px;
}
#apDiv6 {
	position:absolute;
	left:31px;
	top:738px;
	width:177px;
	height:159px;
	z-index:5;
}
#apDiv7 {
	position:absolute;
	left:21px;
	top:721px;
	width:217px;
	height:185px;
	z-index:5;
}
#apDiv8 {
	position:absolute;
	left:252px;
	top:721px;
	width:218px;
	height:185px;
	z-index:6;
}
#apDiv9 {
	position:absolute;
	left:479px;
	top:721px;
	width:230px;
	height:185px;
	z-index:7;
}
.font {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 9px;
}
#apDiv10 {
	position:absolute;
	left:64px;
	top:838px;
	width:225px;
	height:152px;
	z-index:5;
}
</style>
</head>

<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? session_start(); if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } $id = (int)$id; ?>
<? include('../connectdatabase.php');

	  $num = 0;
	  $nnnum = 0;
	  $coad="";
	  $scoad="";
	  $teacher="";
	  $steacher="";
	  $master="";
	  $smaster="";
	  $subject="";
	  $credit="";
	  		  $sql = "select * from project,statusproject where project.id_statusproject=statusproject.id_statusproject AND project.id_project='$id'";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
			  $head = "";
			  $sql = "select * from manipulator,student,title where student.id_title=title.id_title  AND manipulator.id_student=student.id_student AND id_project='".$rs[0]."' order by id_manipulator";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  $student[$num] = $rs2[13]."".$rs2[6];
				  $sname[$num] = $rs2[7];
				  $idstu[$num] = $rs2[1];
				  $tel[$num] = $rs2[3];
				  $idmani[$num] = $rs2[0];
				  $num += 1;
			  }
			   $sql = "select * from committee,teacher,academictitle where id_project='".$rs[0]."' AND position='ที่ปรึกษา' AND committee.id_teacher=teacher.id_teacher AND teacher.id_academictitle=academictitle.id_academictitle";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $teacher = $rs3[17].$rs3[7];
				  $steacher = $rs3[8];
			  }
			   $sql = "select * from committee,teacher,academictitle where id_project='".$rs[0]."' AND position='กรรมการ' AND committee.id_teacher=teacher.id_teacher AND teacher.id_academictitle=academictitle.id_academictitle";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $gum[$nnnum] = $rs3[17].$rs3[7];
				  $sgum[$nnnum] = $rs3[8];
				  $nnnum +=1;
			  }
			   $sql = "select * from subject,project where id_project='".$rs[0]."' AND subject.id_subject=project.id_subject";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  if($rs3[0]=="661320")
				  {
				  	$subject = "โครงงานพิเศษ";
				  }
				  else
				  {
					$subject = $rs3[1];
				  }
				  $credit = $rs3[2];
			  }
			  $nnum = 0;
			  $sql = "select curriculum.id_curr,name_curr from manipulator,student,curriculum where student.id_curr=curriculum.id_curr  AND manipulator.id_student=student.id_student AND id_project='".$rs[0]."' order by id_manipulator";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  $curr[$nnum] = $rs2[0]." ".$rs2[1];
				  $nnum += 1;
			  }
			   $sql = "select * from committee,teacher,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='ประธาน'";
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
			  $sql = "select name_title,name_teacher,sname_teacher from headofdepartment,teacher,title where headofdepartment.id_teacher=teacher.id_teacher AND title.id_title = teacher.id_title";
			  $result = mysqli_query($connect, $sql);
			  while($rs4 = mysqli_fetch_array($result))
			  {
				  $head = $rs4[0]." ".$rs4[1]." ".$rs4[2];
			  }
	  ?>
<div id="apDiv1"><img src="../image/logo.png" width="134" height="116" /></div>
<div id="apDiv2">
  <table width="100%" border="0" >
    <tr>
      <td width="25%" align="right"><strong>รหัสโครงงาน</strong></td>
      <td width="6%" align="left">&nbsp;</td>
      <td width="69%" align="left"><?=$rs[0]?></td>
    </tr>
    <tr>
      <td align="right"><strong>ชื่อโครงงาน (ภาษาไทย)</strong></td>
      <td align="left">&nbsp;</td>
      <td align="left"><?=$rs[1]?></td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td align="right"><strong> (ภาษาอังกฤษ)</strong></td>
      <td width="6%" align="left">&nbsp;</td>
      <td width="69%" align="left"><?=$rs[12]?></td>
    </tr>
    <tr>
      <td width="25%" align="right"><strong>(กรณีศึกษา) </strong></td>
      <td align="left">&nbsp;</td>
      <td align="left"><? if($rs[2]==""){echo "-";}else{echo $rs[2];}?></td>
    </tr>
    <tr>
      <td align="right"><strong>(Case Study)</strong></td>
      <td align="left">&nbsp;</td>
      <td align="left"><? if($rs[13]==""){echo "-";}else{echo $rs[13];}?></td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td colspan="5" valign="top"><strong>ชื่อนักศึกษาผู้จัดทำโครงงานพิเศษ </strong></td>
    </tr>
    <?
	for($i=0;$i<$num;$i++)
	{
		?>
    <tr>
      <td width="11%" align="right"><?=$i+1?>.</td>
      <td><?=$student[$i]?></td>
      <td width="24%"><?=$sname[$i]?></td>
      <td width="13%">รหัสประจำตัว</td>
      <td width="33%" align="center"><?=$idstu[$i]?></td>
    </tr>
        <?
	}
	?>
  </table>
  <table width="100%" border="0">
    <tr>
      <td width="26%" align="left"> <strong>อาจารย์ที่ปรึกษา</strong></td>
      <td width="28%" align="left"><?=$teacher?></td>
      <td width="46%" align="left"><?=$steacher?></td>
    </tr>
      <tr>
      <td width="26%" align="left"><strong>อาจารย์ที่ปรึกษาร่วม</strong></td>
      <td width="28%" align="left"><? if($coad==""){echo "-";}else{echo $coad;}?></td>
      <td width="46%" align="left"><?=$scoad?></td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td colspan="3" align="left"> <strong> คณะกรรมการในการสอบโครงงานพิเศษ</strong></td>
    </tr>
    <tr>
      <td align="right">1.</td>
      <td width="34%" align="left"><?=$master?>&nbsp;</td>
      <td align="left"><?=$smaster?>&nbsp;</td>
    </tr>
        <?
	for($i=0;$i<$nnnum;$i++)
	{
		?>
    <tr>
      <td width="11%" align="right"><?=$i+2?>.</td>
      <td align="left"><?=$gum[$i]?></td>
      <td width="55%" align="left"><?=$sgum[$i]?></td>
    </tr>
    <? } ?>
        <tr>
      <td colspan="3" align="right" class="font">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td colspan="4"><strong>ผลการสอบ<?=$subject?></strong></td>
    </tr>
        <tr>
      <td colspan="4" class="font">&nbsp;</td>
    </tr>
    <tr>
      <td width="20%">&nbsp;</td>
      <td width="7%"><img src="../image/checkbox.jpg" width="22" height="24" /></td>
      <td width="9%" valign="middle"><strong>ผ่าน</strong></td>
      <td width="64%" valign="bottom">...................................................................</td>
    </tr>
    <tr>
      <td width="20%">&nbsp;</td>
      <td width="7%"><img src="../image/checkbox.jpg" width="22" height="24" /></td>
      <td width="9%" valign="middle"><strong>ไม่ผ่าน</strong></td>
      <td width="64%" valign="bottom">...................................................................</td>
    </tr>
  </table>
</div>
<div id="apDiv4" align="center">
  <h3><strong>แบบประเมินความก้าวหน้าโครงงานพิเศษ ภาควิชาเทคโนโลยีสารสนเทศ</strong></h3>
  <h3><strong>คณะเทคโนโลยีและการจัดการอุตสาหกรรม</strong></h3>
  <h3><strong>มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ   ปราจีนบุรี</strong></h3>
</div>
<div id="apDiv5">
  <table width="100%" border="0" align="center">
    <tr>
      <td height="35" align="center" valign="bottom">................................................................</td>
    </tr>
    <tr>
      <td align="center"><?=$master." ".$smaster?></td>
    </tr>
    <tr>
      <td align="center">ประธานกรรมการ</td>
    </tr>
    <tr>
      <td height="35" align="center" valign="bottom">................................................................</td>
    </tr>
    <tr>
      <td align="center"><?=($gum[0]??"")." ".($sgum[0]??"")?></td>
    </tr>
    <tr>
      <td align="center">กรรมการ</td>
    </tr>
    <tr>
      <td height="35" align="center" valign="bottom">................................................................</td>
    </tr>
    <tr>
      <td align="center"><?=($gum[1]??"")." ".($sgum[1]??"")?></td>
    </tr>
    <tr>
      <td align="center">กรรมการ</td>
    </tr>
        <tr>
      <td height="35" align="center" valign="bottom">…..…………/……..………/……..……</td>
    </tr>
  </table>
</div>
<table width="100%" height="1080" border="1" bordercolor="#000000">
      <tr>
        <td height="150" colspan="3" align="right" valign="middle"><center>
          <h3>&nbsp;</h3>
        </center>          <h3>&nbsp;</h3></td>
  </tr>
      <tr>
        <td width="209" colspan="3" align="left" valign="top"><br /></td>
  </tr>
</table>
<div id="apDiv10">
<table width="100%" border="0" align="center">
      <? if(isset($gum[2])&&$gum[2]!=""){
		?>
     <tr>
      <td height="35" align="center" valign="bottom">...................................................................</td>
    </tr>
    <tr>
      <td align="center"><?=($gum[2]??"")." ".($sgum[2]??"")?></td>
    </tr>
    <tr>
      <td align="center">กรรมการ</td>
    </tr>
    <? } ?>
          <? if($coad!=""){
		?>
    <tr>
      <td height="35" align="center" valign="bottom">...................................................................&nbsp;</td>
    </tr>
    <tr>
      <td  align="center" valign="bottom"><?=$coad." ".$scoad?></td>
    </tr>
    <tr>
      <td align="center">ที่ปรึกษาร่วม</td>
    </tr>
    <? } ?>
  </table>
</div>
<? } ?>
</body>
</html>
