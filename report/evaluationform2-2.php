<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบประเมินแผ่น 2</title>

<style type="text/css">
body,td,th {
	font-size: 19px;
	font-family: TH SarabunPSK, Geneva, sans-serif;
}
#apDiv1 {
	position:absolute;
	left:60px;
	top:13px;
	width:120px;
	height:113px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:26px;
	top:156px;
	width:686px;
	height:138px;
	z-index:2;
	text-align: center;
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
	top:-9px;
	width:494px;
	height:121px;
	z-index:3;
}
#apDiv5 {
	position:absolute;
	left:412px;
	top:624px;
	width:284px;
	height:351px;
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
	font-size: 14px;
}
#apDiv10 {
	position:absolute;
	left:26px;
	top:499px;
	width:690px;
	height:502px;
	z-index:4;
}
#apDiv11 {
	position:absolute;
	left:356px;
	top:966px;
	width:360px;
	height:108px;
	z-index:5;
}
#apDiv10 table tr td {
}
</style>
</head>

<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include('../connectdatabase.php'); 

	  $num = 0;
	  $nnnum = 0;
	  $coad = "-";
	  $scoad = "";
	  $teacher = "";
	  $steacher = "";
	  $master = "";
	  $smaster = "";
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
				  $subject = $rs3[0]." ".$rs3[1];
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
  <table width="100%" border="0">
    <tr>
      <td width="25%" align="right"><strong>รหัสโครงงาน</strong></td>
      <td width="4%" align="left">&nbsp;</td>
      <td width="71%" align="left"><?=$rs[0]?></td>
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
      <td width="4%" align="left">&nbsp;</td>
      <td width="71%" align="left"><?=$rs[12]?></td>
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
      <td colspan="5" align="right" valign="top"><strong>ชื่อผู้จัดทำโครงงาน</strong></td>
      <td width="75%" align="left" valign="top">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0">
        <tr>
      <td width="11%" align="right">&nbsp;</td>
      <td width="6%" align="right">1.</td>
      <td width="21%" align="left"><?=$student[0]?></td>
      <td width="18%" align="left"><?=$sname[0]?></td>
      <td width="14%" align="left">รหัสประจำตัว</td>
      <td width="30%" align="center"><?=$idstu[0]?></td>
    </tr>
	      <?
	for($i=1;$i<$num;$i++)
	{
		?>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="right"><?=$i+1 ."."?></td>
      <td align="left"><?=$student[$i]?>&nbsp;</td>
      <td width="18%" align="left"><?=$sname[$i]?>&nbsp;</td>
      <td width="14%" align="left">รหัสประจำตัว</td>
      <td width="30%" align="center"><?=$idstu[$i]?></td>
    </tr>
        <? } ?>
        <? if($num==1)
		{
		?>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td width="18%" align="left">&nbsp;</td>
      <td width="14%" align="left">&nbsp;</td>
      <td width="30%" align="center">&nbsp;</td>
    </tr>
    <? } ?>
        <? if($num<2)
		{
		?>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td width="18%" align="left">&nbsp;</td>
      <td width="14%" align="left">&nbsp;</td>
      <td width="30%" align="center">&nbsp;</td>
    </tr>
    <? } ?>
  </table>
  <table width="100%" border="0">
    <tr>
      <td width="25%" align="right"><strong>อาจารย์ที่ปรึกษาโครงงาน</strong></td>
      <td width="4%" align="left">&nbsp;</td>
      <td width="71%" align="left"><?=$teacher." ".$steacher;?></td>
    </tr>
    <tr>
      <td align="right"><strong>อาจารย์ที่ปรึกษาร่วม</strong></td>
      <td align="left">&nbsp;</td>
      <td align="left"><?=$coad." ".$scoad;?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
<div id="apDiv4" align="center">
  <h3><strong>แบบฟอร์มผลการประเมินโครงงานพิเศษ (ปริญญานิพนธ์)</strong></h3>
  <h3><strong>ภาควิชาเทคโนโลยีสารสนเทศ</strong></h3>
  <h3><strong>คณะเทคโนโลยีและการจัดการอุตสาหกรรม</strong></h3>
</div>
<div id="apDiv10">
  <table width="100%" border="0">
    <tr>
      <td height="57" colspan="7"><p><strong>ผลการประเมิน</strong></p>
      </td>
    </tr>
    <tr>
      <td width="145">&nbsp;</td>
      <td width="24"><img src="../image/checkbox.jpg" width="22" height="24" /></td>
      <td width="84" align="left"><strong>ผ่าน</strong></td>
      <td width="24"><img src="../image/checkbox.jpg" width="22" height="24" /></td>
      <td width="130" align="left"><strong>ผ่านโดยมีเงื่อนไข</strong></td>
      <td width="22"><img src="../image/checkbox.jpg" width="22" height="24" /></td>
      <td width="231" align="left"><strong>ไม่ผ่าน</strong></td>
    </tr>
    <tr>
      <td colspan="7" align="center" valign="top"><p>___________________________________________________________________________________________</p>
        <p>___________________________________________________________________________________________</p>
        <p>___________________________________________________________________________________________</p>
        <p>___________________________________________________________________________________________</p>
        <p>___________________________________________________________________________________________</p>
        <p>___________________________________________________________________________________________</p>
        <p>___________________________________________________________________________________________</p>
        <p>___________________________________________________________________________________________</p>
<p>&nbsp;</p></td>
    </tr>
  </table>
</div>
<div id="apDiv11" align="center">
  <table width="100%" border="0">
    <tr>
      <td align="center">……………………………….........................……………</td>
    </tr>
    <tr>
      <td align="center">(<?=" ".$namee." "?>)</td>
    </tr>
    <tr>
      <td align="center">ผู้ประเมิน</td>
    </tr>
    <tr>
      <td align="center">…........……/….........……/….......……</td>
    </tr>
  </table>
</div>
<table width="100%"  height="1080" border="1" bordercolor="#000000">
      <tr>
        <td height="137" colspan="3" align="right" valign="middle"><center>
          <h3>&nbsp;</h3>
        </center>          <h3>&nbsp;</h3></td>
  </tr>
      <tr>
        <td height="340" colspan="3" align="left" valign="top"><br /></td>
  </tr>
      <tr>
        <td colspan="3" align="left" valign="top">&nbsp;</td>
      </tr>
</table>
<? } ?>
</body>
</html>
