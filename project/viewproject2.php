<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ดูข้อมูลโครงงานพิเศษ</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
</style>
</head>
<body>
<? include('../connectdatabase.php'); 
	  $num = 0;
	  		  $sql = "select * from project,statusproject where project.id_statusproject=statusproject.id_statusproject AND id_project='".$idview."'";
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
 $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='ที่ปรึกษา'";
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
	  ?>
<center>
        <h2>ข้อมูลโครงงานพิเศษรหัส <?=$idview?></h2>
    </center>
<table width="700"  bordercolor="#666666" style="border:outset" border="0" align="center" >
      <tr>
      <td width="195" align="right" nowrap="nowrap" scope="col">สถานะโครงงาน :</td>
      <td width="487" align="left">
      <?=$rs[15]?>
      </td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="col">ชื่อโครงงาน :</td>
      <td align="left">
      <?=$rs[1]?>
      </td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="col">กรณีศึกษา :</td>
      <td align="left">
      <? 
	  if($rs[2]=="")
	  echo "ไม่มีกรณีศึกษา";
	  else
	  echo $rs[2];
	  ?>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="col">ชื่อโครงงาน(ภาษาอังกฤษ) :</td>
      <td align="left">
      <?=$rs[12]?>
      </td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="col">กรณีศึกษา(ภาษาอังกฤษ) :</td>
      <td align="left">
      <? 
	  if($rs[13]=="")
	  echo "ไม่มีกรณีศึกษา";
	  else
	  echo $rs[13];
	  ?>
    </tr>
    <?
	$sql = "select * from race where id_project='$idview'";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result)!=0)
{
	while($rs2 = mysqli_fetch_array($result))
	{	?>
    <tr>
      <td align="right" valign="top" nowrap="nowrap" scope="row">เข้าแข่งขันในโครงการ :</td>
      <td align="left">
      <?=$rs2[2]?>
      </td>
  </tr> 
    <tr>
      <td align="right" valign="top" nowrap="nowrap" scope="row">สถานะการเข้าแข่งขัน :</td>
      <td align="left">
      <?=$rs2[3]?>
      </td>
  </tr> 
    <?
	}
}
	?>
    <tr>
      <td align="right" valign="top" nowrap="nowrap" scope="row">ผู้จัดทำ :</td>
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
    <tr>
      <td align="right" nowrap="nowrap" scope="row">อาจารย์ที่ปรึกษาร่วม :</td>
      <td align="left"><? if($coad==""){?>ไม่มีอาจารย์ที่ปรึกษาร่วม<? }else{echo $coad;}?></td>
    </tr>
    <tr>
      <td align="right" scope="row">อาจารย์ที่ปรึกษา :</td>
      <td align="left">
      <?=$teacher?>
      </td>
    </tr>
    <? if($master!="")
	{
		?>
        <tr>
      <td align="right" nowrap="nowrap" scope="row">ประธาน :</td>
      <td align="left"><?=$master?>
      </td>
      </tr>
      <? }
	  if($gum!="")
	  {
	  ?>
         <tr>
      <td align="right" valign="top" nowrap="nowrap" scope="row">กรรมการ :</td>
      <td align="left">
	  <?
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='กรรมการ'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $gum = $rs3[18]." ".$rs3[7]." ".$rs3[8];
				  echo $gum."<br/>";
			  }
	  ?>
      </td>
    </tr>
      <? } ?>
    <tr>
      <td align="right" nowrap="nowrap" scope="row">อีเมลล์ผู้จัดทำ :</td>
      <td align="left">
      <?=$rs[8]?>
      </td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap" scope="row">ที่อยู่ผู้จัดทำ :</td>
      <td align="left">
      <?=$rs[7]?>
      </td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="row">ทก.01(.pdf) :</td>
      <td align="left">
      <a href="../<?=$rs[9]?>" target="_blank">ดู ทก.</a> 
      </td>
    </tr>
  </table>
  <p>
    <? 			 
   			}

	?>
<center><h2>&nbsp;</h2></center>
<center>
<h2>&nbsp;</h2></center>
</body>
</html>