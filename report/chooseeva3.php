<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	$id = (int)$id;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
</script>
</head>

<body>
<form id="form" name="form" method="post" action="">
<span id="resultt" style="color:#F00"></span>
  <table width="100%" border="0">
    <tr>
      <td colspan="2" align="center"><h3>ออกใบประเมินการสอบความก้าวหน้าโครงงานพิเศษ รหัส
        <?=$id?>
      </h3></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <? include('../connectdatabase.php'); 
	  $num = 0;
	  $teacher = ''; $master = ''; $gum = ''; $coad = ''; $idco = '';
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
	  ?>
<table border="0" align="center" >
  <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="col">สถานะโครงงาน :</th>
          <td align="left"><?=$rs[17]?></td>
        </tr>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="col">ชื่อโครงงาน :</th>
          <td align="left"><?=$rs[1]?></td>
        </tr>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="col">กรณีศึกษา :</th>
          <td align="left"><? 
	  if($rs[2]=="")
	  echo "ไม่มีกรณีศึกษา";
	  else
	  echo $rs[2];
	  ?></td>
        </tr>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="col">ชื่อโครงงาน(ภาษาอังกฤษ) :</th>
          <td align="left"><?=$rs[12]?></td>
        </tr>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="col">กรณีศึกษา(ภาษาอังกฤษ) :</th>
          <td align="left"><? 
	  if($rs[13]=="")
	  echo "ไม่มีกรณีศึกษา";
	  else
	  echo $rs[13];
	  ?></td>
        </tr>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="row">ผู้จัดทำ :</th>
          <td align="left"><table cellpadding="0" cellspacing="0">
            <? 
	  $numtel = 0;
	  foreach($student as $s){
		  echo '<tr><td>'.$s.'</td><td>'.$showtel[$numtel].'</td></tr>';
		  $numtel++;
	  }
	  ?>
          </table></td>
        </tr>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="row">อาจารย์ที่ปรึกษาร่วม :</th>
          <td align="left"><? if($coad==""){?>
            ไม่มีอาจารย์ที่ปรึกษาร่วม
            <? }else{echo $coad;}?></td>
        </tr>
        <tr>
          <th align="right" valign="top" scope="row">อาจารย์ที่ปรึกษา :</th>
          <td align="left"><?=$teacher?></td>
        </tr>
        <? if($master!="")
	{
		?>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="row">ประธาน :</th>
          <td align="left"><?=$master?></td>
        </tr>
        <? }
	  if($gum!="")
	  {
	  ?>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="row">กรรมการ :</th>
          <td align="left"><?
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='กรรมการ'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $gum = $rs3[18]." ".$rs3[7]." ".$rs3[8];
				  echo $gum."<br/>";
			  }
	  ?></td>
        </tr>
        <? } ?>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="row">อีเมลล์ผู้จัดทำ :</th>
          <td align="left"><?=$rs[8]?></td>
        </tr>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="row">ที่อยู่ผู้จัดทำ :</th>
          <td align="left"><?=$rs[7]?></td>
        </tr>
        <tr>
          <th align="right" valign="top" nowrap="nowrap" scope="row">ทก.01(.pdf) :</th>
          <td align="left"><a href="<?=$rs[9]?>" target="_blank">ดู ทก.</a></td>
        </tr>
    </table>
<? 			 
   			}
			  mysqli_close($connect);
	?></td>
    </tr>
  </table>
  <p>
    <input type="button" name="button2" id="button2" value="พิมพ์ใบประเมิน"  onClick="window.open('report/big2.php?id=<?=$id?>', '_blank', '')" />
    <input type="button" name="button" id="button" onclick="cancelprint()" value="กลับ" />
  </p>
  <br/>
  <br/>
</form>
</body>
</html>