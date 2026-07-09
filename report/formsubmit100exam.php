<? include('../change.php'); ?>
<? session_start(); ?>
<? if(!isset($_SESSION['iduser'])) { exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบยื่นสอบ</title>

<style type="text/css">
@page {
	size: A4;
	margin: 5mm;
}
body,td,th {
	font-size: 18px;
	font-family: TH SarabunPSK,TH SarabunPSK,TH SarabunPSK;
}
#apDiv1 {
	position:absolute;
	left:89px;
	top:14px;
	width:120px;
	height:113px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:23px;
	top:143px;
	width:713px;
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
	left:232px;
	top:-10px;
	width:391px;
	height:121px;
	z-index:3;
}
#apDiv5 {
	position:absolute;
	left:434px;
	top:702px;
	width:294px;
	height:67px;
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
	left:17px;
	top:826px;
	width:217px;
	height:185px;
	z-index:5;
}
#apDiv8 {
	position:absolute;
	left:262px;
	top:826px;
	width:218px;
	height:185px;
	z-index:6;
}
#apDiv9 {
	position:absolute;
	left:497px;
	top:842px;
	width:237px;
	height:185px;
	z-index:7;
	font-family: TH SarabunPSK,TH SarabunPSK,TH SarabunPSK;
	font-size: 12px;
}
.font {
	font-family: "TH SarabunPSK", "TH SarabunPSK", "TH SarabunPSK";
	font-size: 18px;
}
.F12 {
	font-family: "TH SarabunPSK", "TH SarabunPSK", "TH SarabunPSK";
	font-size: 16px;
	text-align: center;
}
#apDiv2 table tr td {
}
</style>
</head>

<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include('../connectdatabase.php'); 

	  $num = 0;
	  		  $sql = "select * from project,statusproject where project.id_statusproject=statusproject.id_statusproject AND id_user='".$_SESSION['iduser']."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
			  $gum = "";
			  $head = "";
			  $master = "";
			  $teacher = "";
			  $subject = "";
			  $credit = "";
			  $sql = "select * from manipulator,student,title where student.id_title=title.id_title  AND manipulator.id_student=student.id_student AND id_project='".$rs[0]."' order by id_manipulator";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  $student[$num] = $rs2[13]."".$rs2[6]." ".$rs2[7];
				  $idstu[$num] = $rs2[1];
				  $tel[$num] = $rs2[3];
				  $idmani[$num] = $rs2[0];
				  $num += 1;
			  }
			   $sql = "select * from committee,teacher,academictitle where id_project='".$rs[0]."' AND position='ที่ปรึกษา' AND committee.id_teacher=teacher.id_teacher AND teacher.id_academictitle=academictitle.id_academictitle";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $teacher = $rs3[17]."".$rs3[7]." ".$rs3[8];
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
				  $curr[$nnum] = $rs2[1];
				  $nnum += 1;
			  }
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='ประธาน'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $master = $rs3[18]."".$rs3[7]." ".$rs3[8];
			  }
			   $gum = array();
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='กรรมการ'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $gum[] = $rs3[18]."".$rs3[7]." ".$rs3[8];
			  }
			  $coad = "-";
			  $sql = "select * from coadvisor,title where title.id_title=coadvisor.id_title AND id_project='".$rs[0]."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs4 = mysqli_fetch_array($result))
			  {
				  $idco = $rs4[0];
				  $coad = $rs4[6]."".$rs4[3]." ".$rs4[4];
			  }
			  $sql = "select name_academictitle,name_teacher,sname_teacher from headofdepartment,teacher,academictitle where headofdepartment.id_teacher=teacher.id_teacher AND academictitle.id_academictitle = teacher.id_academictitle";
			  $result = mysqli_query($connect, $sql);
			  while($rs4 = mysqli_fetch_array($result))
			  {
				  $head = $rs4[0]."".$rs4[1]." ".$rs4[2];
			  }
	  ?>
<div id="apDiv1"><img src="../image/logo.png" width="134" height="116" /></div>
<div id="apDiv2">
  <table width="100%" border="0">
    <tr>
      <td width="25%" valign="top"><strong>ชื่อ - สกุลนักศึกษา</strong></td>
      <td width="38%" valign="top"><?=$student[0]?></td>
      <td width="14%" align="left" valign="top"><strong>รหัสประจำตัว</strong></td>
      <td width="23%" align="left" valign="top"><?=$idstu[0]?></td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td width="63%" valign="top"><strong>ที่อยู่ปัจจุบันที่สามารถติดต่อได้สะดวก</strong></td>
      <td width="14%" valign="top"><strong>โทรศัพท์</strong></td>
      <td width="23%" valign="top"><?=$tel[0]?></td>
    </tr>
    <tr>
      <td height="44" colspan="3" valign="top"><?=$rs[7]?></td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td colspan="6" valign="top"><strong>มีความประสงค์จะขอสอบโครงงานพิเศษ (ปริญญานิพนธ์) หลักสูตร</strong></td>
      <td width="35%" valign="top"><?=$curr[0]?></td>
    </tr>
  </table>
<table width="100%" border="0">
      <tr>
      <td width="5%" valign="top"><strong>วิชา</strong></td>
      <td width="26%" valign="top"><?=$subject?></td>
      <td width="17%" valign="top"><strong>จำนวนหน่วยกิต</strong></td>
      <td width="7%" align="center" valign="top"><?=$credit?></td>
      <td width="10%" valign="top"><strong>หน่วยกิต</strong></td>
      <td width="24%" valign="top"><strong>ปีการศึกษาที่ลงทะเบียน</strong></td>
      <td width="11%" valign="top"><?=$rs[5]."/".$rs[4];?></td>
    </tr>
  </table>
  <table width="100%" border="0">
        <tr>
      <td width="21%" align="left" valign="top"><strong>รหัสโครงงานพิเศษ</strong></td>
      <td width="79%" valign="top"><?=$rs[0]?></td>
    </tr>
        <tr>
          <td colspan="2" align="left" height="10"></td>
        </tr>
    </table>
  <table width="100%" border="0">
    <tr>
      <td width="27%" align="right" valign="top"><strong>ชื่อโครงงาน (ภาษาไทย)</strong></td>
      <td width="73%"><?=$rs[1]?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><strong>(ภาษาอังกฤษ)</strong></td>
      <td><?=$rs[12]?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><strong>กรณีศึกษา :</strong></td>
      <td><? if($rs[2]==""){echo "-";}else{echo $rs[2];}?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><strong>(Case Study) :</strong></td>
      <td><? if($rs[13]==""){echo "-";}else{echo $rs[13];}?></td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="top" " height="10"></td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td colspan="6" valign="top"><strong>นักศึกษาผู้ร่วมงาน</strong></td>
    </tr>
    <tr>
      <td width="13%" valign="top" nowrap="nowrap"><strong>ชื่อ - สกุล</strong></td>
      <td width="33%"><? if(!isset($student[1])||$student[1]==""){echo "-";}else{echo $student[1];}?></td>
      <td width="15%" nowrap="nowrap"><strong>รหัสประจำตัว</strong></td>
      <td width="11%"><? if(!isset($idstu[1])||$idstu[1]==""){echo "-";}else{echo $idstu[1];}?></td>
      <td width="12%" nowrap="nowrap"><strong>โทรศัพท์</strong></td>
      <td width="16%"><? if(!isset($tel[1])||$tel[1]==""){echo "-";}else{echo $tel[1];}?></td>
    </tr>
    <tr>
      <td valign="top" nowrap="nowrap"><strong>ชื่อ - สกุล</strong></td>
      <td><? if(!isset($student[2])||$student[2]==""){echo "-";}else{echo $student[2];}?></td>
      <td nowrap="nowrap"><strong>รหัสประจำตัว</strong></td>
      <td><? if(!isset($idstu[2])||$idstu[2]==""){echo "-";}else{echo $idstu[2];}?></td>
      <td nowrap="nowrap"><strong>โทรศัพท์</strong></td>
      <td><? if(!isset($tel[2])||$tel[2]==""){echo "-";}else{echo $tel[2];}?></td>
    </tr>
    <? for($i=3;$i<$num;$i++)
	{
		?>
    <tr>
      <td valign="top"><strong>ชื่อ - สกุล</strong></td>
      <td><?=$student[$i]?></td>
      <td><strong>รหัสประจำตัว</strong></td>
      <td><?=$idstu[$i]?></td>
      <td><strong>โทรศัพท์</strong></td>
      <td><?=$tel[$i]?></td>
    </tr>
        <?
	}
	?>
  </table>
  <table width="100%" border="0">
    <tr>
      <td width="24%" valign="top"><strong>ชื่ออาจารย์ที่ปรึกษา</strong></td>
      <td width="76%"><?=$teacher?>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><strong>ชื่ออาจารย์ที่ปรึกษาร่วม</strong></td>
      <td><? if($coad==""){echo "-";}else{echo $coad;}?></td>
    </tr>
  </table>
  <table width="50%" border="0">
    <tr>
      <td colspan="2" height="10"></td>
    </tr>
    <tr>
      <td width="11%">&nbsp;</td>
      <td width="89%" valign="top"><strong>จึงเรียนมาเพื่อโปรดพิจารณา</strong></td>
    </tr>
  </table>
</div>
<div id="apDiv4" align="center">
  <h3><strong>แบบเสนอขอสอบโครงงานพิเศษ</strong></h3>
  <h3><strong>ภาควิชาเทคโนโลยีสารสนเทศ</strong></h3>
  <h3><strong>คณะเทคโนโลยีและการจัดการอุตสาหกรรม</strong></h3>
</div>
<div id="apDiv5">
  <table width="100%" border="0">
    <tr>
      <td>ลงชื่อ..........................................(ผู้ยื่นคำร้อง)</td>
    </tr>
    <tr>
      <td height="43">....................../....................../.....................</td>
    </tr>
  </table>
</div>
<div id="apDiv7">
  <p class="font"><span class="font"><span class="F12">___________________________________</span>_</p>
  <p class="font"><span class="font"><span class="F12">____________________________________</span></p>
  <p class="font"><span class="font"><span class="F12">____________________________________</span></p>
  <p class="font"><span class="font"><span class="F12">____________________________________</span></p>
  <p class="F12">  ลงชื่อ..............................................................
<center>
      <p class="F12">(
        <?=$teacher;?>)
      </p>
  </center>
</div>
<div id="apDiv8">
 <p class="font"><span class="font"><span class="F12">___________________________________</span>_</p>
 <p class="font"><span class="font"><span class="F12">____________________________________</span></p>
 <p class="font"><span class="font"><span class="F12">____________________________________</span></p>
 <p class="font"><span class="font"><span class="F12">____________________________________</span></p>
 <p class="F12"> ลงชื่อ.............................................................. </p>
 <center>
   <p class="F12">(
     <?=$head;?>
     ) </p>
 </center>
 </div>
<div id="apDiv9" class="F12">
  <p style="text-align:left"><span class="font"><span class="F12">&nbsp;&nbsp;&nbsp;ประธาน&nbsp;&nbsp;<?=($master!=""?$master:"______________________________")?><br />
  </span></span></p>
  <? if(count($gum)>0) { foreach($gum as $g) { ?>
  <p style="text-align:left"><span class="F12">&nbsp;&nbsp;&nbsp;กรรมการ&nbsp;&nbsp;<?=$g?></span></p>
  <? } } else { ?>
  <p style="text-align:left"><span class="F12">&nbsp;&nbsp;&nbsp;กรรมการ&nbsp;&nbsp;_____________________________</span></p>
  <p style="text-align:left"><span class="F12">&nbsp;&nbsp;&nbsp;กรรมการ&nbsp;&nbsp;_____________________________ </span></p>
  <p style="text-align:left"><span class="F12">&nbsp;&nbsp;&nbsp;กรรมการ&nbsp;&nbsp;_____________________________</span></p>
  <? } ?>
  <p>&nbsp;</p>
  <p><span class="F12">วันที่สอบ ............/.............../...............<br />
  </span></p>
  <p><span class="F12">    สถานที่จัดสอบ ................................</span><br />
  </p>
</div>
<table width="740" height="1050" border="1" bordercolor="#000000" class="ชก">
      <tr>
        <td height="120" colspan="3" align="right" valign="middle"><center>
          <h3>&nbsp;</h3>
        </center>          <h3>&nbsp;</h3></td>
  </tr>
      <tr>
        <td height="580" colspan="3" align="left" valign="top">&nbsp;</td>
  </tr>
      <tr>
        <td width="209" align="center" valign="top" class="font"><br />
        ความคิดเห็นอาจารย์ที่ปรึกษาโครงงาน</td>
        <td width="209" height="251" align="center" valign="top" class="font"><br />
        ความคิดเห็นหัวหน้าภาควิชา</td>
        <td width="209" height="251" align="center" valign="top" class="font"><br />
        รายชื่อคณะกรรมการสอบ</td>
      </tr>

</table>
<? } ?>
<SCRIPT LANGUAGE="JavaScript">
<!--
window.status = 'This page is now ready for print';
window.print();
//-->
  </SCRIPT>
</body>
</html>
