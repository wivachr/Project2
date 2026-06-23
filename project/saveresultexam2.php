<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td colspan="2" align="center"><h3>บันทึกผลการสอบร้อย รหัส 
    <?=$id?></h3>
              <?  
include('../connectdatabase.php'); 
	  $num = 0;
	  			  $checkexam = false;
	  		  $sql = "select * from project,statusproject where project.id_statusproject=statusproject.id_statusproject AND id_project='".$id."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
			  $sql = "select * from manipulator,student,title where title.id_title = student.id_title AND manipulator.id_student=student.id_student AND id_project='".$rs[0]."' order by id_manipulator";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  $student[$num] = $rs2[1]." ".$rs2[13].$rs2[6]." ".$rs2[7]."&nbsp;";
				  $showtel[$num] = "<strong>เบอร์โทรศัพท์ :</strong> ".$rs2[3];
				  $idstuedit[$num] = $rs2[1];
				  $idmani[$num] = $rs2[0];
				  $etel[$num] = $rs2[3];
				  $num += 1;
			  }
 $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='ที่ปรึกษา'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $teacher = $rs3[18]." ".$rs3[7]." ".$rs3[8];
			  }
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='ประธาน'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $master = $rs3[18]." ".$rs3[7]." ".$rs3[8];
			  }
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='กรรมการ'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $gum = $rs3[18]." ".$rs3[7]." ".$rs3[8];
			  }
			  $sql = "select * from coadvisor,title where title.id_title = coadvisor.id_title AND id_project='".$rs[0]."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs4 = mysqli_fetch_array($result))
			  {
				  $idco = $rs4[0];
				  $coad = $rs4[6].$rs4[3]." ".$rs4[4];
			  }

			  $sql10 = "select * from exam where id_typeexam='2' AND id_statusproject='23' AND id_project='".$rs[0]."'";
			  $result10 = mysqli_query($connect, $sql10);
				if(mysqli_num_rows($result10)!=0)
				{
					$checkexam = true;
				}
	  ?>
<table width="70%" border="1" align="center" bordercolor="#000000" >
    <tr>
      <th width="31%" align="right" valign="top" nowrap="nowrap" scope="col">ชื่อโครงงาน :</th>
      <td width="69%" align="left">
      <?=$rs[1]?>
      </td>
    </tr>
    <tr>
      <th align="right" valign="top" nowrap="nowrap" scope="col">กรณีศึกษา :</th>
      <td align="left">
      <? 
	  if($rs[2]=="")
	  echo "ไม่มีกรณีศึกษา";
	  else
	  echo $rs[2];
	  ?>
</tr>
    <tr>
      <th align="right" valign="top" nowrap="nowrap" scope="col">ชื่อโครงงาน(ภาษาอังกฤษ) :</th>
      <td align="left">
      <?=$rs[12]?>
      </td>
    </tr>
    <tr>
      <th align="right" valign="top" nowrap="nowrap" scope="col">กรณีศึกษา(ภาษาอังกฤษ) :</th>
      <td align="left">
      <? 
	  if($rs[13]=="")
	  echo "ไม่มีกรณีศึกษา";
	  else
	  echo $rs[13];
	  ?>
</tr>
    <tr>
      <th align="right" valign="top" nowrap="nowrap" scope="row">ผู้จัดทำ :</th>
      <td align="left">
      <table cellpadding="0" cellspacing="0">
      <? 
	  $numtel = 0;
	  foreach($student as $s){
		  echo '<tr><td>'.$s.'</td><td>'.$showtel[$numtel].'</td></tr>';
		  $numtel++;
	  }
	  ?>
      </table>
</td>
    </tr>
    <? if($master!="")
	{
		?>
      <? }
	  if($gum!="")
	  {
	  ?>
      <? } ?>
  </table>
<p>
  <? 			 
   			}
	?>
</p></td>
  </tr>
  <tr>
    <td width="236" align="right">ผลการสอบ :</td>
    <td width="771" align="left"><input type="radio" name="resultexam" id="r1" value="0" />
    ผ่าน
      <? if(!$checkexam){?><input type="radio" name="resultexam" id="r3" value="2" />
ไม่ผ่านยื่นสอบใหม่ภายในช่วงเวลา<? } ?>
<input type="radio" name="resultexam" id="r4" value="3" />
ไม่ผ่าน(F)</label></td>
  </tr>
   <tr>
    <td width="236" align="right" valign="top">ความคิดเห็นเพิ่มเติม :</td>
    <td width="771" align="left"><label for="comment"></label>
    <textarea name="comment" id="comment" cols="80" rows="10"></textarea></td>
  </tr>
  <tr>
  <tr>
    <td colspan="2" align="center"><input type="button" name="saveresult" id="saveresult" value="บันทึกผล" onclick="saving2(<?=$id?>,<?=$idsubmit?>)" />
    <input type="button" name="cancel" onclick="cancels()" id="cancel" value="ยกเลิก" /></td>
  </tr>
</table>
</body>
</html>