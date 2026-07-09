<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || ($_SESSION['right']!='2' && $_SESSION['right']!='3')) { exit; } ?>
 <? 	include('../connectdatabase.php');
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
         ?> 
         <h2>รายชื่อโครงงานพิเศษที่ยังไม่ยื่นเรื่องสอบร้อยเปอร์เซ็นต์เมื่อเกินเวลาที่กำหนด 2 ภาคเรียน</h2><br/>
         <?
		$sql = "select id_project,name_project,semester_project,year_project,name_statusproject from academicyear,project,statusproject where statusproject.id_statusproject=project.id_statusproject AND (((year-year_project)*2)+semester)-semester_project > 1 AND (project.id_statusproject <> '0' AND project.id_statusproject <> '17' AND project.id_statusproject <> '18' AND project.id_statusproject <> '16' AND project.id_statusproject <> '12' AND project.id_statusproject <> '13' AND project.id_statusproject <> '14')";
		$result = mysqli_query($connect, $sql);
		if(mysqli_num_rows($result)!=0)
		{
			?><table width="100%"  border="1" bordercolor="#000000"  cellpadding="0" cellspacing="1">
         <tr>
          <td width="11%"  align="center" bgcolor="#CCCCCC">รหัสโครงงาน</td>
          <td width="29%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงาน</td>
          <td width="10%"  align="center" bgcolor="#CCCCCC">รหัสประจำตัว</td>
		  <td width="10%"  align="center" bgcolor="#CCCCCC">ภาคปีการศึกษาที่ลงทะเบียน</td>
		  <td width="25%"  align="center" bgcolor="#CCCCCC">สถานะโครงงาน</td>
		  <td width="15%"  align="center" bgcolor="#CCCCCC"></td>
    	</tr><?
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
				//$sql = "update project set id_statusproject='17' where id_project='".$rs[0]."'";
				//mysqli_query($connect, $sql);
				//$sql = "update user set status_user='0' where username='".$rs[0]."'";
				//mysqli_query($connect, $sql);
				?>
				<tr><td rowspan="4"><?=$rs[0]?></td><td rowspan="4" align="left"><a href="project/viewproject.php?idview=<?=$rs[0]?>" target="_blank"><?=$rs[1]?></a></td>
				  <td align="left"><?=$idstudent[0] ?? ''?>&nbsp;</td>
			    <td rowspan="4"><?=$rs[2]."/".$rs[3]?></td><td rowspan="4" align="left"><?=$rs[4]?></td><td rowspan="4"><a href="javascript:void(0);" onClick="del2(<?=$rs[0]?>)">ยกเลิก</a></td></tr>
      <tr>
				  <td align="left"><?=$idstudent[1] ?? ''?>&nbsp;</td>
		   </tr>
				<tr>
				  <td align="left"><?=$idstudent[2] ?? ''?>&nbsp;</td>
		   </tr>
				<tr>
				  <td align="left"><?=$idstudent[3] ?? ''?>&nbsp;</td>
		   </tr>
                <?
			}
			?>
			<tr><td colspan="6" bgcolor="#CCCCCC">&nbsp;</td></tr></table>

              <p>
  <input type="button" name="button" id="button" value="ออกรายงาน" onclick="window.open('report/exp.php','_blank','')" />
</p>
            <?
		}
		else
	  {
		  echo "<br/>ไม่มีรายชื่อโครงงานพิเศษที่ยังไม่ยื่นสอบร้อยเปอร์เซ็นต์เมื่อครบกำหนด";
	  }
mysqli_close($connect);
?>
