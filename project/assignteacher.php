<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
function MoveOption(objSourceElement, objTargetElement, flag)    {  

	var aryTempSourceOptions = new Array();        var x = 0;      
	
	//looping through source element to find selected options        
	for (var i = 0; i < objSourceElement.length; i++) {            
		if (objSourceElement.options[i].selected) {                //need to move this option to target element    
			if(objSourceElement.options[i].value==0)
			{
				return false;
			}
			var intTargetLen = objTargetElement.length++;    
			if(flag == '1'){  //นี้คือส่วนที่ ดัดแปลง ครับ ทั้งหมด ครับ คือแค่เอามาต่อ สติงกันแค่นั้นครับ
			objTargetElement.options[intTargetLen].text = objSourceElement.options[i].text;  
			}
			else if(flag == '0'){
				objTargetElement.options[intTargetLen].text = objSourceElement.options[i].text;
				objTargetElement.options[intTargetLen].value = objSourceElement.options[i].value;
			}
			else{
			objTargetElement.options[intTargetLen].text = objSourceElement.options[i].text;  	
			}
			objTargetElement.options[intTargetLen].value = objSourceElement.options[i].value;     //นี้คือส่วนที่ ดัดแปลง ครับ 
		}            
		else {                //storing options that stay to recreate select element                
			var objTempValues = new Object();
			objTempValues.text = objSourceElement.options[i].text;                
			objTempValues.value = objSourceElement.options[i].value;                
			aryTempSourceOptions[x] = objTempValues;                
			x++;           
		 }        
	}                //resetting length of source        
	objSourceElement.length = aryTempSourceOptions.length;       
	//looping through temp array to recreate source select element        
	for (var i = 0; i < aryTempSourceOptions.length; i++) {     
			objSourceElement.options[i].text = aryTempSourceOptions[i].text;            
			objSourceElement.options[i].value = aryTempSourceOptions[i].value;            
			objSourceElement.options[i].selected = false;        
	}    
}  

</script>
</head>

<body>
<form id="form" name="form" method="post" action="">
<span id="resultt" style="color:#F00"></span>
  <table width="100%" border="0">
    <tr>
      <td colspan="2" align="center"><h3>แต่งตั้งกรรมการโครงงานพิเศษ รหัส
        <?=$id?>
      </h3>
      <?  
include('../connectdatabase.php'); 
	  $num = 0;
	  		  $sql = "select * from project,statusproject where project.id_statusproject=statusproject.id_statusproject AND id_project='".$id."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
			  $coad = "";
			  $gum = "";
			  $master = "";
			  $teacher = "";
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
      <td width="411" align="right">ประธาน :</td>
      <td width="594" align="left"><select name="idteacher" id="idteacher">
        <option value="0">---เลือกอาจารย์---</option>
        <?
			  $sql = "select * from teacher order by initials_teacher";
			  
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
        <option value="<?=$rs[0]?>"> <? echo $rs[5]." ".$rs[3]." ".$rs[4]; ?> </option>
        <?
			  }
			  mysqli_close($connect);
			  ?>
      </select></td>
    </tr>
    <tr>
      <td height="25" align="right" class="c1">กรรมการ :</td>
      <td align="left" class="c1"><select name="matid" id="matid" style="width:150px" >
        <option value="0">---เลือกอาจารย์---</option>
        <? include('../connectdatabase.php'); 
			  $sql = "select * from teacher order by initials_teacher";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
        <option value="<?=$rs[0]?>"> <? echo $rs[5]." ".$rs[3]." ".$rs[4]; ?> </option>
        <?
			  }
			  mysqli_close($connect);
			  ?>
      </select>
        <input type="button" name="add" value="เพิ่ม" onclick="MoveOption(this.form.matid, this.form.temp,'1')" /></td>
    </tr>
    <tr>
      <td height="25" class="c1">&nbsp;</td>
      <td align="left" class="c1"><select name="temp" id="temp" size="3" multiple="multiple" style="width: 150px;">
      </select>
        <input type="button" name="remove" value="ลบ" onclick="MoveOption(this.form.temp, this.form.matid,'0')" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="button" name="assignb" id="assignb" value="แต่งตั้ง" onclick="assigning(<?=$id?>)" />
        <input type="button" name="cancel" onclick="cancelt()" id="cancel" value="ยกเลิก" /></td>
    </tr>
  </table>
</form>
</body>
</html>