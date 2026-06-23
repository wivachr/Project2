<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางสอบ</title>
</head>
<body>
<center><h2>ตารางสอบ</h2></center>
 <? include('../connectdatabase.php');
$sql = "select project.id_project,name_project,engname_project,casestudy_project from project";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
		?>
        <center>
        <table width="1000" border="1" bordercolor="#000000" cellpadding="0" cellspacing="1">
    <tr>
      <td width="10%"  align="center" bgcolor="#CCCCCC">รหัสโครงงาน</td>
      <td width="34%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงาน</td>
      <td width="11%"  align="center" bgcolor="#CCCCCC">รหัสประจำตัว</td>
      <td width="11%"  align="center" bgcolor="#CCCCCC">อาจารย์ที่ปรึกษา</td>
      <td width="13%"  align="center" bgcolor="#CCCCCC">วัน/เวลา</td>
      <td width="11%"  align="center" bgcolor="#CCCCCC">กรรมการ</td>
      <td width="10%"  align="center" bgcolor="#CCCCCC">หมายเหตุ</td>
    </tr>
        <?
while($rs = mysqli_fetch_array($result))
{
	$n = 0;
	$nn = 0;
	$strname="";
	$strid="";
	$teacher="";
	$dshow="";
	$strgum="";
	$strtel="";
	$namestudent=array();
				 $sql2 = "select * from teacher,committee,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND teacher.id_teacher=committee.id_teacher AND committee.position='ที่ปรึกษา' AND id_project='".$rs[0]."'";
				  $result2 = mysqli_query($connect, $sql2);
				 while($rs2 = mysqli_fetch_array($result2))
				 {
					 $teacher = $rs2[18].$rs2[3];
				 }
				 $sql3 = "select * from teacher,committee,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND teacher.id_teacher=committee.id_teacher AND committee.position<>'ที่ปรึกษา' AND id_project='".$rs[0]."'";
				  $result3 = mysqli_query($connect, $sql3);
				 while($rs2 = mysqli_fetch_array($result3))
				 {
					 $gum[$nn] = $rs2[18].$rs2[3];
					 $nn++;
				 }
				 $sql4 = "select * from student,title,manipulator where student.id_student=manipulator.id_student AND id_project='".$rs[0]."' AND student.id_title=title.id_title";
				 $result4 = mysqli_query($connect, $sql4);
				 while($rs2 = mysqli_fetch_array($result4))
				 {
					 $idstudent[$n]=$rs2[0];
					 $namestudent[$n]=$rs2[9].$rs2[2]." ".$rs2[3];
					 $telstudent[$n]=$rs2[13];
					 $n++;
				 }
				 for($i = 0;$i<$n;$i++)
				 {
					 $strid .= $idstudent[$i]."\n";
				 }
				 for($i = 0;$i<$n;$i++)
				 {
					 $strname .= $namestudent[$i]."\n";
				 }
				 for($i = 0;$i<$n;$i++)
				 {
					 $strtel .= $telstudent[$i]."\n";
				 }
				 for($i = 0;$i<$nn;$i++)
				 {
					 $strgum .= $gum[$i]."\n";
				 }
?>
<tr>
<td rowspan="4"><?=$rs[0]?></td>
<td rowspan="4" align="left" valign="top"><?=$rs[1]."<br/>".$rs[2]."<br/>".$rs[3]."<br/>".$rs[4]?></td>
<td align="left"><?=$namestudent[0] ?? ''?>&nbsp;</td>
<td rowspan="4" align="left"><?=$teacher?></td>
<td rowspan="4" align="center"><?=$dshow?></td>
<td align="left"><?=$gum[0] ?? ''?></td>
<td align="left"><?=$telstudent[0] ?? ''?></td>
</tr>
<tr>
  <td align="left"><?=$namestudent[1] ?? ''?>&nbsp;</td>
  <td align="left"><?=$gum[1] ?? ''?></td>
  <td align="left"><?=$telstudent[1] ?? ''?></td>
</tr>
<tr>
  <td align="left"><?=$namestudent[2] ?? ''?>&nbsp;</td>
  <td align="left"><?=$gum[2] ?? ''?></td>
  <td align="left"><?=$telstudent[2] ?? ''?></td>
</tr>
<tr>
  <td align="left"><?=$namestudent[3] ?? ''?>&nbsp;</td>
  <td align="left"><?=$gum[3] ?? ''?></td>
  <td align="left"><?=$telstudent[3] ?? ''?></td>
</tr>
<?
}
?>
<tr><td colspan="7" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
  </center>
<p>
  <center><input type="button" name="button" id="button" value="ออกรายงาน" onclick="window.open('tableexam.php','_blank','')" /></center>
</p>
<?
	}
	else
	{
			  echo "<br/><center>ยังไม่มีการจัดตารางสอบ</center>";
	}
	
mysqli_close($connect);
?>
</body>
</html>
