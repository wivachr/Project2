<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบยื่นสอบ</title>

<style type="text/css">
body,td,th {
	font-size: 16px;
	font-family: TH SarabunPSK,TH SarabunPSK,TH SarabunPSK;
}
#apDiv1 {
	position:absolute;
	left:160px;
	top:3px;
	width:110px;
	height:95px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:25px;
	top:96px;
	width:672px;
	height:157px;
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
	left:187px;
	top:-18px;
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
	font-size: 8px;
}
#apDiv10 {
	position:absolute;
	left:23px;
	top:362px;
	width:675px;
	height:499px;
	z-index:4;
}
#apDiv11 {
	position:absolute;
	left:25px;
	top:989px;
	width:687px;
	height:64px;
	z-index:5;
}
.left {
	text-align: left;
}
#apDiv12 {
	position:absolute;
	left:26px;
	top:1007px;
	width:157px;
	height:22px;
	z-index:6;
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
				  $nstudent[$num] = $rs2[6];
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
<div id="apDiv1"><img src="../image/logo.png" width="95" height="84" /></div>
<div id="apDiv2">
  <table width="100%" border="0">
    <tr>
      <td width="25%" align="right"><strong>รหัสโครงงาน</strong></td>
      <td width="5%" align="left">&nbsp;</td>
      <td width="70%" align="left"><?=$rs[0]?></td>
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
      <td width="5%" align="left">&nbsp;</td>
      <td width="70%" align="left"><?=$rs[12]?></td>
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
      <td valign="top"><strong>ชื่อผู้จัดทำโครงงาน</strong></td>
      <td width="7%" valign="top">1.</td>
      <td width="17%" valign="top"><?=$student[0]?></td>
      <td valign="top"><?=$sname[0]?></td>
      <td valign="top">รหัสประจำตัว</td>
      <td align="center" valign="top"><?=$idstu[0]?></td>
    </tr>
    <?
 	for($i=1;$i<$num;$i++)
	{
		?>
    <tr>
      <td width="22%" align="right">&nbsp;</td>
      <td><?=$i+1 ."."?></td>
      <td><?=$student[$i]?>&nbsp;</td>
      <td width="16%"><?=$sname[$i]?>&nbsp;</td>
      <td width="14%">รหัสประจำตัว</td>
      <td width="24%" align="center"><?=$idstu[$i]?></td>
    </tr>
        <? } ?>
  </table>
  <table width="100%" border="0">
    <tr>
      <td width="22%" align="left"> <strong>อาจารย์ที่ปรึกษา</strong></td>
      <td width="24%" align="left"><?=$teacher?></td>
      <td width="54%" align="left"><?=$steacher?></td>
    </tr>
    <tr>
      <td width="22%" align="left"> <strong>อาจารย์ที่ปรึกษาร่วม</strong></td>
      <td width="24%" align="left"><?=$coad?></td>
      <td width="54%" align="left"><?=$scoad?></td>
    </tr>
  </table>
</div>
<div id="apDiv4" align="center"> 
  <h3><strong>แบบประเมินเพื่อให้คะแนนวิชาโครงงานพิเศษ </strong></h3>
  <h3>
    <strong>ภาควิชาเทคโนโลยีสารสนเทศ </strong>
    <strong><br/>_________________________________________</strong>
  </h3>
</div>
<div id="apDiv10">
  <table border="1" cellspacing="0" cellpadding="0" width="100%" height="100%">
    <tr>
      <td width="299" rowspan="2" align="center" valign="middle">  รายการ, </td>
      <td width="104" rowspan="2" align="center" valign="top">คะแนนเต็ม <br /><span class="font">&nbsp;</span>
        (100)</td>
      <td height="20" colspan="2" align="center" valign="top">คะแนนที่ได้ </td>
      <td width="119" rowspan="2" align="center" valign="top">หมายเหตุ </td>
    </tr>
    <tr>
      <td height="20" align="center" valign="top"><?=$nstudent[0] ?? ''?></td>
      <td align="center" valign="top"><?=$nstudent[1] ?? ''?></td>
    </tr>
    <tr>
      <td width="299" valign="top">&nbsp;1.การศึกษาปัญหาและการวิเคราะห์ระบบงานเพื่อให้ทราบถึงปัญหาที่แท้จริงหรือการแสดงให้เห็นถึงแนวความคิดในการพัฒนาระบบใหม่</td>
      <td width="104" align="center" valign="top">10 </td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" height="20" valign="top">&nbsp;2. การค้นคว้าหาความรู้จากแหล่งต่าง ๆ หรือการแสวงหาองค์ความรู้เพื่อการพัฒนาระบบงาน</td>
      <td width="104" align="center" valign="top">10</td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" height="92" valign="top">&nbsp;3. การออกแบบ
        <br /><span class="font">&nbsp;</span>
        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.1……………………………………………………………………………
        <br /><span class="font">&nbsp;</span>
        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.2……………………………………………………………………………
        <br /><span class="font">&nbsp;</span>
        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.3…………………………………………………………………………… 
        <br /><span class="font">&nbsp;</span>
        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.4……………………………………………………………………………
        <br /><span class="font">&nbsp;</span>
        <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.5…………………………………………………………………………… <br /><span class="font">&nbsp;</span>
      <br /></td>
      <td width="104" align="center" valign="top">25 </td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" height="25" valign="top">&nbsp;4.การเลือกใช้เครื่องมือที่เหมาะสม<br /><span class="font">&nbsp;</span>
        <br />
      </td>
      <td width="104" align="center" valign="top">5</td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" height="25" valign="top">&nbsp;5.การทดสอบและการวางระบบจริง<br /><span class="font">&nbsp;</span>        <br /></td>
      <td width="104" align="center" valign="top">5</td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" height="25" valign="top">&nbsp;6.เทคนิคใหม่ ๆที่ได้นำมาใช้ในการพัฒนาระบบ<br /><span class="font">&nbsp;</span>        <br /></td>
      <td width="104" align="center" valign="top">15</td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" height="25" valign="top">&nbsp;7.การนำโครงงานไปใช้จริง/ ความเหมาะสมของผลงาน<br /><span class="font">&nbsp;</span>        <br /></td>
      <td width="104" align="center" valign="top">10</td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" height="25" valign="top">&nbsp;8.ความเอาใจใส่ /ความตั้งใจในการจัดทำโครงงาน<br /><span class="font">&nbsp;</span>
      <br /></td>
      <td width="104" align="center" valign="top">(Bonus &lt;= 10)</td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" height="25" valign="top">&nbsp;9. ระยะเวลาในการจัดทำโครงงาน<br /><span class="font">&nbsp;</span>
      <br /></td>
      <td width="104" align="center" valign="top">10</td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
<td width="299" height="117" valign="top">&nbsp;10. อื่นๆ<br /><span class="font">&nbsp;</span>
  <br />
  
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.1 ……………………………………………………………………………<br /><span class="font">&nbsp;</span>
    <br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.2 ……………………………………………………………………………<br /><span class="font">&nbsp;</span>
    <br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.3 ……………………………………………………………………………<br /><span class="font">&nbsp;</span>
    <br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.4 ……………………………………………………………………………
    <br /><span class="font">&nbsp;</span>
    <br /></td>
      <td width="104" align="center" valign="top">10</td>
      <td width="71" valign="top">&nbsp;</td>
      <td width="70" valign="top">&nbsp;</td>
      <td width="119" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="299" align="center" valign="middle">รวม <br /><span class="font">&nbsp;</span>
      <br /></td>
      <td width="104" align="center" valign="middle">100<br /> <span class="font">&nbsp;</span><span class="font"></span> <br /></td>
      <td width="71" valign="middle">&nbsp;</td>
      <td width="70" valign="middle">&nbsp;</td>
      <td width="119" valign="middle">&nbsp;</td>
    </tr>
  </table>
</div>
<div id="apDiv11">
  <p align="center">
  ลงชื่อ …………………………………………………………………………<br />
  ( <?=$namee?> )<br />
  หมายเหตุ:  คะแนนข้อที่ 8 จะให้อยู่ในดุลพินิจของอาจารย์ที่ปรึกษาแล้วแต่ความเหมาะสม  จะเป็นคะแนนที่ให้เพิ่มจาก 100 % </p>
</div>
<div id="apDiv12">วันที่ …………/…………/…………</div>
<p class="font">&nbsp;</p>
<table width="700" height="1000" border="0" bordercolor="#000000">
      <tr>
        <td height="137" colspan="3" align="right" valign="middle"><center>
          <h3>&nbsp;</h3>
        </center>          <h3>&nbsp;</h3></td>
  </tr>
      <tr>
        <td width="209" colspan="3" align="left" valign="top"><br /></td>
  </tr>
</table>
<p class="font">&nbsp;</p>
<p class="font">&nbsp;</p>
<p class="font">&nbsp;</p>
<? } 
?>
</body>
</html>
