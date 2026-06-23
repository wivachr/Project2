<? include('../change.php'); ?>
<h2>รายชื่อนักศึกษาที่ยังไม่มีหัวข้อ</h2>
 <? 	include('../connectdatabase.php'); 
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}

	 $sql = "select name_title,student.id_student,name_student,sname_student from title,student,registration where student.id_student=registration.id_student  AND 	year_registration='$year' AND 	semester_registration='$semester' AND title.id_title=student.id_title AND student.id_student NOT IN(select id_student from manipulator,project where manipulator.id_project =project.id_project AND year_project = '$year' AND semester_project = '$semester')
UNION
select name_title,student.id_student,name_student,sname_student from title,student,manipulator,project,registration where student.id_student=registration.id_student AND project.id_project = manipulator.id_project AND title.id_title=student.id_title AND manipulator.id_student=student.id_student AND (project.id_statusproject='0' OR project.id_statusproject='18') AND 	year_registration='$year' AND 	semester_registration='$semester' AND student.id_student NOT IN (select student.id_student from title,student,manipulator,project,registration where student.id_student=registration.id_student AND project.id_project = manipulator.id_project AND title.id_title=student.id_title AND manipulator.id_student=student.id_student AND project.id_statusproject<>'0' AND project.id_statusproject<>'18' AND year_registration='$year' AND 	semester_registration='$semester')";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
		?>
        <table width="60%"  border="1" bordercolor="#000000"  cellpadding="0" cellspacing="1">
    <tr>
      <td width="30%"  align="center" bgcolor="#CCCCCC">รหัสนักศึกษา</td>
      <td width="70%"  align="center" bgcolor="#CCCCCC">ชื่อ-สกุลนักศึกษา</td>
    </tr>
        <?
while($rs = mysqli_fetch_array($result))
{	
?>
<tr>
<td ><?=$rs[1]?></td>
<td  align="left" valign="top"><?=$rs[0].$rs[2]." ".$rs[3]?></td>
</tr>
<?
}
?>
<tr><td colspan="2" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
<p>
  <input type="button" name="button" id="button" value="ออกรายงาน" onclick="window.open('report/noproject.php','_blank','')" />
</p>
<?
	}
	else
	{
	  echo "<br/>ไม่มีรายชื่อนักศึกษาที่ยังไม่มีหัวข้อ";
	}
mysqli_close($connect);
?>

