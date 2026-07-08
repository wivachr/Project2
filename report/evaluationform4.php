<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แบบสอบถามสำหรับวิชาโครงงานพิเศษ</title>

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
	margin-left:25px;
	margin-top:130px;
	width:672px;
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
	margin-left:23px;
	margin-top:10px;
	width:675px;
}
#apDiv11 {
	margin-left:25px;
	margin-top:20px;
	width:687px;
}
.left {
	text-align: left;
}
</style>
</head>

<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? session_start(); if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } $id = (int)$id; ?>
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
  <h3><strong>แบบสอบถามสำหรับวิชาโครงงานพิเศษ </strong></h3>
  <h3>
    <strong>ภาควิชาเทคโนโลยีสารสนเทศ </strong>
    <strong><br/>_________________________________________</strong>
  </h3>
</div>
<div id="apDiv10">
  <p style="margin:0 0 4px 0"><strong>คำชี้แจง</strong> &#10003; โปรดทำเครื่องหมาย ลงในช่องที่เห็นว่าเหมาะสม</p>
  <table border="2" cellspacing="0" cellpadding="2" width="100%" style="border-collapse:collapse; border-color:#000; font-size:14px;">
    <tr>
      <td width="38%" align="center" valign="middle"><strong>รายการ</strong></td>
      <td width="8%" align="center" valign="middle"><strong>ดีมาก</strong></td>
      <td width="8%" align="center" valign="middle"><strong>ดี</strong></td>
      <td width="9%" align="center" valign="middle"><strong>ปานกลาง</strong></td>
      <td width="8%" align="center" valign="middle"><strong>พอใช้</strong></td>
      <td width="10%" align="center" valign="middle"><strong>ต้องปรับปรุง</strong></td>
      <td width="19%" align="center" valign="middle"><strong>หมายเหตุ</strong></td>
    </tr>
    <?
	$items = array(
		"1.โครงงานพิเศษที่จัดทำขึ้น ได้ตรงตามความต้องการของหน่วยงาน",
		"2.วิธีการออกแบบ หรือรูปแบบโครงงานพิเศษที่จัดทำขึ้นมีความเหมาะสมกับการนำไปใช้ในงาน",
		"3.ความสม่ำเสมอในการติดต่อประสานงานของนักศึกษาผู้จัดทำโครงงานพิเศษกับหน่วยงาน",
		"4.กิริยามารยาทของนักศึกษาในการติดต่อประสานงานกับหน่วยงาน",
		"5.นักศึกษาสามารถจัดทำโครงงานให้แล้วเสร็จตามระยะเวลาที่กำหนด",
		"6.มีการทดสอบ การติดตั้งระบบโครงงานพิเศษให้แก่หน่วยงานซึ่งได้นำไปใช้งานจริง",
		"7.มีการจัดทำคู่มือประกอบการใช้งานหรือจัดฝึกอบรมการใช้งานให้กับหน่วยงาน",
		"8.ความง่ายในการใช้งานของโครงงานพิเศษที่จัดทำให้แก่หน่วยงาน",
		"9.การนำเสนอและการตอบข้อซักถามในการสอบโครงงานพิเศษปริญญานิพนธ์",
		"10.ความพึงพอใจในภาพรวมของโครงงานพิเศษที่จัดทำให้แก่หน่วยงาน",
	);
	foreach($items as $item)
	{
	?>
    <tr>
      <td align="left" valign="top"><?=$item?></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <? } ?>
    <tr>
      <td align="center"><strong>รวม</strong></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
</div>
<div id="apDiv11">
  <table width="100%" border="0">
    <tr>
      <td width="45%" valign="top">วันที่ …………/…………/…………</td>
      <td width="55%" align="center" valign="top">ลงชื่อ …………………………………………………………………………<br />
        ( <?=$coad?> )<br />
        ที่ปรึกษาร่วม
      </td>
    </tr>
  </table>
</div>
<? }
?>
</body>
</html>
