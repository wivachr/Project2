<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	include('../connectdatabase.php');
	$y = mysqli_real_escape_string($connect, $y);
	$s = mysqli_real_escape_string($connect, $s);
$sql = "select project.id_project,name_project,engname_project,casestudy_project,name_typeexam,date_assignexam,time_assignexam,name_room,endtime_assignexam,statusproject.name_statusproject from assignexam,room,exam,project,typeexam,committee,statusproject where statusproject.id_statusproject=exam.id_statusproject AND exam.id_typeexam='1' AND committee.id_project=project.id_project AND position = 'ที่ปรึกษา' AND assignexam.id_room=room.id_room AND assignexam.id_exam=exam.id_exam AND (exam.id_statusproject ='24' OR exam.id_statusproject  = '22') AND exam.id_project=project.id_project AND typeexam.id_typeexam = exam.id_typeexam AND year_exam ='$y'  AND semester_exam ='$s'";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
		?>
        <table width="100%"  border="1" bordercolor="#000000"  cellpadding="0" cellspacing="1">
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
	$teacher2="";
	$dshow="";
	$strgum="";
	$strtel="";
	$idstudent=array();
	$telstudent=array();
	$gum=array();
				 $sql2 = "select * from teacher,committee,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND teacher.id_teacher=committee.id_teacher AND committee.position='ที่ปรึกษา' AND id_project='".$rs[0]."'";
				  $result2 = mysqli_query($connect, $sql2);
				 while($rs2 = mysqli_fetch_array($result2))
				 {
					 $teacher2 = $rs2[18].$rs2[3];
				 }
				 $sql3 = "select * from teacher,committee,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND teacher.id_teacher=committee.id_teacher AND committee.position='ประธาน' AND id_project='".$rs[0]."'";
				  $result3 = mysqli_query($connect, $sql3);
				 while($rs2 = mysqli_fetch_array($result3))
				 {
					 $gum[$nn] = $rs2[18].$rs2[3];
					 $nn++;
				 }
				 $sql3 = "select * from teacher,committee,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND teacher.id_teacher=committee.id_teacher AND committee.position='กรรมการ' AND id_project='".$rs[0]."'";
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
				 $d = explode("-", $rs[5]);
				 $date = new DateTime();
				 $date->setDate((int)$d[0]-543,(int)$d[1],(int)$d[2]);
				$year = $date->format('Y')+543;
								if($date->format('N')==1)
				{
					$day = "จ.";
				}
				else if($date->format('N')==2)
				{
					$day = "อ.";
				}
				else if($date->format('N')==3)
				{
					$day = "พ.";
				}
				else if($date->format('N')==4)
				{
					$day = "พฤ.";
				}
				else if($date->format('N')==5)
				{
					$day = "ศ.";
				}
				else if($date->format('N')==6)
				{
					$day = "ส.";
				}
				else if($date->format('N')==7)
				{
					$day = "อท.";
				}
				if($date->format('m')==1)
				{
					$m = "ม.ค.";
				}
				else if($date->format('m')==2)
				{
					$m = "ก.พ.";
				}
				else if($date->format('m')==3)
				{
					$m = "มี.ค.";
				}
				else if($date->format('m')==4)
				{
					$m = "เม.ย.";
				}
				else if($date->format('m')==5)
				{
					$m = "พ.ค.";
				}
				else if($date->format('m')==6)
				{
					$m = "มิ.ย.";
				}
				else if($date->format('m')==7)
				{
					$m = "ก.ค.";
				}
				else if($date->format('m')==8)
				{
					$m = "ส.ค.";
				}
				else if($date->format('m')==9)
				{
					$m = "ก.ย.";
				}
				else if($date->format('m')==10)
				{
					$m = "ต.ค.";
				}
				else if($date->format('m')==11)
				{
					$m = "พ.ย.";
				}
				else if($date->format('m')==12)
				{
					$m = "ธ.ค.";
				}
				$yy = $date->format('Y')+543;
				$dshow = $day."".$date->format('d')."".$m."".substr($yy,2,2)."<br/>".$rs[6]." น.-".$rs[8]." น.<br/>".$rs[7];
?>
<tr>
<td rowspan="4"><?=$rs[0]."<br/>".$rs[9]?></td>
<td rowspan="4" align="left" valign="top"><?=$rs[1]."<br/>".$rs[2]."<br/>".$rs[3]."<br/>".$rs[4]?></td>
<td align="left"><?=$idstudent[0] ?? ''?>&nbsp;</td>
<td rowspan="4" align="left"><?=$teacher2?></td>
<td rowspan="4" align="center"><?=$dshow?></td>
<td align="left" valign="top"><?=$gum[0] ?? ''?></td>
<td align="left"><?=$telstudent[0] ?? ''?></td>
</tr>
<tr>
  <td align="left"><?=$idstudent[1] ?? ''?>&nbsp;</td>
  <td align="left" valign="top"><?=$gum[1] ?? ''?></td>
  <td align="left"><?=$telstudent[1] ?? ''?></td>
</tr>
<tr>
  <td align="left"><?=$idstudent[2] ?? ''?>&nbsp;</td>
  <td align="left" valign="top"><?=$gum[2] ?? ''?></td>
  <td align="left"><?=$telstudent[2] ?? ''?></td>
</tr>
<tr>
  <td align="left"><?=$idstudent[3] ?? ''?>&nbsp;</td>
  <td align="left" valign="top"><?=$gum[3] ?? ''?></td>
  <td align="left"><?=$telstudent[3] ?? ''?></td>
</tr>
<?
}
?>
<tr><td colspan="7" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
<p>
  <center><input type="button" name="button" id="button" value="ออกรายงาน" onclick="window.open('report/resulttitlepdfall.php?teacher=<?=htmlspecialchars($teacher,ENT_QUOTES)?>&y=<?=htmlspecialchars($y,ENT_QUOTES)?>&s=<?=htmlspecialchars($s,ENT_QUOTES)?>','_blank','')" /></center>
</p>
<?
	}
	else
	{
			  echo "<br/><center>ไม่มีข้อมูล</center>";
	}
	
mysqli_close($connect);
?>
