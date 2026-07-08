<? session_start(); ?>
<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var a = true;
var b = true;
var c = true;
var idmaniedit;
	$(document).ready(function() {
	var popsrt = Math.random();
	$("#save").hide();
	$("#cancel").hide();
	$("#s1").hide();
	$("#s2").hide();
	$("#s3").hide();
	$("#edtting").hide();
	$("#s4").hide();
	$("#s5").hide();
	$("#s6").hide();
	$("#s7").hide();
	$("#adding").hide();
	$("#namecoadvisor").hide();
	$("#snamecoadvisor").hide();
	/* changetorgor display managed by PHP inline style */
	$("#nco").hide();
	$("#tco").hide();
	$("#sco").hide();
	$("#cob").hide();
	$("#idtitle").hide();
	$("#titleco").hide();
	$("#addma").hide();
	$("#addco").hide();
	$("#ctg").hide();
	$("#delco").hide();
	$("#editma").hide();
		  $("#ctg").click(function () {
			  if(a)
			  document.getElementById('ctg').innerHTML = "ยกเลิก";
			  else
			  document.getElementById('ctg').innerHTML = "เปลี่ยน ทก.";
			  a = !a;
			  $("#changetorgor").toggle();
		  });
	  $("#addma").click(function () {
		  if(b)
		  {
		  document.getElementById('addma').innerHTML = "ยกเลิก";
		  $("#edtting").hide();
		  }
		  else
		  {
		  	document.getElementById('addma').innerHTML = "เพิ่มผู้จัดทำ";
					document.getElementById('cresult').innerHTML = "";
					document.getElementById('showname').innerHTML = "";
					document.getElementById("idstu1").value = "";
					document.getElementById("tel1").value = "";
		  }
		  b = !b;
	  $("#adding").toggle();
   		 });
	  $("#addco").click(function () {
		  if(c)
		  document.getElementById('addco').innerHTML = "ยกเลิก";
		  else
		  document.getElementById('addco').innerHTML = "เพิ่มอาจารย์ที่ปรึกษาร่วม";
		  c = !c;
	  $("#namecoadvisor").toggle();
	  $("#snamecoadvisor").toggle();
	  $("#nco").toggle();
	  $("#sco").toggle();
	  $("#tco").toggle();
	  $("#cob").toggle();
	  $("#idtitle").toggle();
	  $("#titleco").toggle();
   		 });
	      <? include('../connectdatabase.php'); 
		  	$sql = "select * from academicyear";
			 $result = mysqli_query($connect, $sql);
			 while($rs = mysqli_fetch_array($result))
			{
				$year = $rs[0];
				$semester = $rs[1];
			}
	  		  $sql = "select * from project where id_user='".$_SESSION['iduser']."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  $statusproject = $rs[10];
			  }
			  if($statusproject=='1')
			  {
				  ?>
				  $("#s1").show();
					$("#addma").show();
					$("#addco").show();
					$("#ctg").show();
					$("#delma").show();
					$("#editma").show();
					$("#delco").show();
				  $("#tg01").hide();
				  <?
			  }
			  else if($statusproject=='2')
			  {
				  ?>
				  $("#s2").show();
				 	$("#addma").show();
					$("#addco").show();
					$("#ctg").show();
					$("#delma").show();
					$("#editma").show();
					$("#delco").show();
					$("#tg01").hide();
				  <?
			  }
			  else if($statusproject=='6')
			  {
				  ?>
				  $("#s3").show();
				  <?
			  }
			  else if($statusproject=='10'||$statusproject=='19')
			  {
				  ?>
				  $("#s5").show();
				  <?
			  }
			  else if($statusproject=='11')//พิมพ์ใบยื่นสอบ
			  {
				  ?>
				  $("#s4").show();
				  <?
			  }
			  else if($statusproject=='7')//พิมพ์ใบยื่นสอบ
			  {
				  ?>
				  $("#s6").show();
				  <?
			  }
			  else if($statusproject=='15')//พิมพ์ใบยื่นสอบ
			  {
				  ?>
				  $("#s7").show();
			  		$("#addma").show();
					$("#addco").show();
					$("#ctg").show();
					$("#delma").show();
					$("#editma").show();
					$("#delco").show();
					$("#tg01").hide();
					<?
			  }
	?>
	 });
	 function showtorgor()
	 {
		 $("#changetorgor").show();
	 }
	 function editma(id,idstu,tel)
	{
		$("#edtting").show();
		document.getElementById('addma').innerHTML = "เพิ่มผู้จัดทำ";
		document.getElementById('showename').innerHTML = "แก้ไขผู้จัดทำรหัส "+idstu;
		document.getElementById('showname2').innerHTML = "";
		document.getElementById('cresult2').innerHTML = "";
		document.getElementById('idstu2').value = idstu;
		document.getElementById('tel2').value = tel;
		b = true;
		idmaniedit = id;
		$("#adding").hide();
	}
	 function edit()
	 {
		 document.getElementById("nameproject").disabled=false;
		 document.getElementById("casestudy").disabled=false;
		 document.getElementById("idteacher").disabled=false;
		 document.getElementById("email").disabled=false;
		 document.getElementById("address").disabled=false;
		 document.getElementById("engnameproject").disabled=false;
		 document.getElementById("engcasestudy").disabled=false;
		$("#save").show();
		if(<?=$statusproject?>=='1')
		$("#s1").hide();
		else if(<?=$statusproject?>=='2')
		$("#s2").hide();
		else if(<?=$statusproject?>=='15')
		$("#s7").hide();
		$("#cancel").show();
	 }

	 function cancel()
	 {
		 document.getElementById("nameproject").disabled=true;
		 document.getElementById("casestudy").disabled=true;
		 document.getElementById("idteacher").disabled=true;
		 document.getElementById("email").disabled=true;
		 document.getElementById("address").disabled=true;
		 document.getElementById("engnameproject").disabled=true;
		 document.getElementById("engcasestudy").disabled=true;
		$("#save").hide();
		if(<?=$statusproject?>=='1')
		$("#s1").show();
		else if(<?=$statusproject?>=='2')
		$("#s2").show();
		else if(<?=$statusproject?>=='15')
		$("#s7").show();
		$("#cancel").hide();
	 }
	 function checkid2()
{
		<?
		include('../connectdatabase.php');
		$result = mysqli_query($connect, "select manipulator.id_student from project,manipulator where project.id_project=manipulator.id_project AND 			project.year_project='$year' AND project.semester_project='$semester' AND (project.id_statusproject<>'0' AND project.id_statusproject<>'18')");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[0]?>==document.getElementById("idstu2").value)
			{
			document.getElementById('cresult2').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
			document.getElementById('showname2').innerHTML = "";
					document.getElementById("idstu2").value = "";
					document.getElementById("tel2").value = "";
					return false;
			}
			<?
			}
		}
		$result = mysqli_query($connect, "select * from registration,student where student.id_student=registration.id_student AND year_registration='$year' and semester_registration='$semester'");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[2]?>==document.getElementById("idstu2").value)
			{
				document.getElementById('cresult2').innerHTML = "";
					document.getElementById('showname2').innerHTML = "<? echo $rs[7]." ".$rs[8] ?>";
					return true;
			}
			<?
			}
		}
		mysqli_close($connect);
	?>
			document.getElementById('cresult2').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
			document.getElementById('showname2').innerHTML = "";
	document.getElementById("idstu2").value = "";
	document.getElementById("tel2").value = "";
}
function checkid()
{
		<?
		include('../connectdatabase.php');
		$result = mysqli_query($connect, "select manipulator.id_student from project,manipulator where project.id_project=manipulator.id_project AND 			project.year_project='$year' AND project.semester_project='$semester' AND (project.id_statusproject<>'0' AND project.id_statusproject<>'18')");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[0]?>==document.getElementById("idstu1").value)
			{
					document.getElementById('cresult').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
					document.getElementById('showname').innerHTML = "";
					document.getElementById("idstu1").value = "";
					document.getElementById("tel1").value = "";
					return false;
			}
			<?
			}
		}
		$result = mysqli_query($connect, "select * from registration,student where student.id_student=registration.id_student AND year_registration='$year' and semester_registration='$semester'");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[2]?>==document.getElementById("idstu1").value)
			{
				document.getElementById('cresult').innerHTML = "";
					document.getElementById('showname').innerHTML = "<? echo $rs[7]." ".$rs[8] ?>";
					return true;
			}
			<?
			}
		}
		mysqli_close($connect);
	?>
					document.getElementById('cresult').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
					document.getElementById('showname').innerHTML = "";
					document.getElementById("idstu1").value = "";
					document.getElementById("tel1").value = "";
}
function clickupload()
{

if ( document.getElementById('fileupload').value.length == 0 )
{
alert( 'ระบุ File ที่จะ Upload' ) ;
return false ;
}
document.getElementById('upmsg').style.color="";
document.getElementById('btnUpload').disabled = true ;

return true ;
}
</script><title></title>
<style type="text/css">
body, td, th { font-family: Tahoma, Geneva, sans-serif; font-size: 13px; }
.left { text-align: left; }
#main-wrap { max-width: 820px; margin: 0 auto; }
table.info-table { width: auto; margin: 0 auto; border-collapse: collapse; }
table.info-table th { text-align: right; padding: 5px 12px; width: 200px; white-space: nowrap; font-weight: normal; color: #333; }
table.info-table td { text-align: left; padding: 5px 12px; }
table.info-table tr:nth-child(even) { background: #f7f7f7; }
.section-divider { border: none; border-top: 1px solid #ccc; margin: 10px 0; }
.action-row { text-align: center; padding: 12px 0; border-top: 1px solid #ddd; margin-top: 8px; }
.action-row input[type=button] { margin: 3px 4px; padding: 4px 10px; }
</style>
</head>
<body>
<div id="main-wrap">
<center>
    <h2>รายละเอียดโครงงานพิเศษของคุณ</h2>
</center>
      <? include('../connectdatabase.php'); 
	  $num = 0;
	  		  $sql = "select * from project,statusproject where project.id_statusproject=statusproject.id_statusproject AND id_user='".$_SESSION['iduser']."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
			  $teacher = "";
			   $sql = "select * from assignexam,room,exam where assignexam.id_room=room.id_room AND assignexam.id_exam=exam.id_exam AND id_statusproject ='21' AND id_project='".$rs[0]."'";
			   $result = mysqli_query($connect, $sql);
			   while($rs2 = mysqli_fetch_array($result))
			  {
				  echo "<h2 style='color:#0000CC'>คุณมีการสอบในวันที่ $rs2[2] เวลา $rs2[3] ห้อง $rs2[7]</h2>";
			  }
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
			   $sql = "select * from committee where id_project='".$rs[0]."' AND position='ที่ปรึกษา'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $teacher = $rs3[1];
			  }
			  $master = '';
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='ประธาน'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $master = $rs3[18]." ".$rs3[7]." ".$rs3[8];
			  }
			  $gum = '';
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='กรรมการ'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $gum = $rs3[18]." ".$rs3[7]." ".$rs3[8];
			  }
			  $coad = '';
			  $idco = 0;
			  $sql = "select * from coadvisor,title where title.id_title = coadvisor.id_title AND id_project='".$rs[0]."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs4 = mysqli_fetch_array($result))
			  {
				  $idco = $rs4[0];
				  $coad = $rs4[6].$rs4[3]." ".$rs4[4];
			  }
	  ?>

  <table class="info-table" border="0" align="center">
      <tr>
      <th>สถานะโครงงาน :</th>
      <td><strong><?=$rs[17]?></strong></td>
    </tr>
    <tr>
      <th>รหัสโครงงาน :</th>
      <td><?=$rs[0]?></td>
    </tr>
    <tr>
      <th>ประเภทโครงงาน :</th>
      <td><strong><?
      if($rs[14]=='year')
      {
      	echo "โปรเจคปี";
      	echo empty($rs[15]) ? " (โปรเจค 1)" : " (โปรเจค 2)";
      }
      else
      {
      	echo "โปรเจคเทอม";
      }
      ?></strong>
      <?
      $has2nd = false;
      if($rs[14]=='year'&&empty($rs[15]))
      {
      	$sql = "select id_project from project where parent_project_id='".$rs[0]."' limit 1";
      	$result = mysqli_query($connect, $sql);
      	$has2nd = mysqli_num_rows($result)>0;
      }
      if($rs[14]=='year'&&empty($rs[15])&&!$has2nd&&in_array($rs[10], array(6,7,8,9,10,11,12,13,14,15,16,19,20,21,23,24))) { ?>
      &nbsp;<input type="button" value="ลงทะเบียนโปรเจค 2" onclick="registerproject2(<?=$rs[0]?>)"/>
      <? } ?>
      </td>
    </tr>
    <tr>
      <th>ชื่อโครงงาน :</th>
      <td>
      <input id="idproject" name="idproject" type="hidden" value="<?=$rs[0]?>" />
      <input name="nameproject" type="text" disabled="disabled" value="<?=$rs[1]?>" id="nameproject" size="55" maxlength="1000"/>
      </td>
    </tr>
    <tr>
      <th>กรณีศึกษา :</th>
      <td><input name="casestudy" type="text" id="casestudy" size="55" maxlength="1000" value="<?=$rs[2]?>" disabled="disabled"/></td>
    </tr>
    <tr>
      <th>ชื่อโครงงาน(ภาษาอังกฤษ) :</th>
      <td>
      <input name="engnameproject" type="text" disabled="disabled" value="<?=$rs[12]?>" id="engnameproject" size="55" maxlength="1000"/>
      </td>
    </tr>
    <tr>
      <th>กรณีศึกษา(ภาษาอังกฤษ) :</th>
      <td><input name="engcasestudy" type="text" id="engcasestudy" size="55" maxlength="1000" value="<?=$rs[13]?>" disabled="disabled"/></td>
    </tr>
    <?
	$sql = "select * from race where id_project='".$rs[0]."'";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result)!=0)
{
	while($rs2 = mysqli_fetch_array($result))
	{
	?>
    <tr>
      <th align="right" valign="top" nowrap="nowrap" scope="row">เข้าแข่งขันในโครงการ :</th>
      <td align="left">
      <?=$rs2[2]?>
      </td>
  </tr> 
    <?
	}
}
	?>
    <tr>
      <th valign="top">ผู้จัดทำ :</th>
      <td>
      <table cellpadding="0" cellspacing="0" border="0">
      <? 
	  $count = 0;
	  foreach($student as $s){
		  echo "<tr>";
		  if($num > 1)
		  {
		  	 if($statusproject=='1'||$statusproject=='2')
				  echo '<td>'.$s.'&nbsp;</td><td>'.$showtel[$count].'&nbsp;</td><td><a href="javascript:void(0);" id="editma" onclick="editma('.$idmani[$count].','.$idstuedit[$count].',\''.$etel[$count].'\')">แก้ไข</a>'.' <a href="javascript:void(0);" id="delma" onclick="delmani('.$idmani[$count].')">ลบ</a></td>';
			  else
			   echo '<td>'.$s.'&nbsp;</td><td>'.$showtel[$count].'</td>';
		  }
		  else
		  {
		  if($statusproject=='1'||$statusproject=='2')
		  echo '<td>'.$s.'&nbsp;</td><td>'.$showtel[$count].'&nbsp;</td><td><a href="javascript:void(0);" id="editma" onclick="editma('.$idmani[$count].','.$idstuedit[$count].',\''.$etel[$count].'\')">แก้ไข</a></td>';
		  			  else
			   echo '<td>'.$s.'&nbsp;</td><td>'.$showtel[$count].'</td>';
		  }
		  $count += 1;
		  echo "</tr>";
	  }
	  ?>
      </table>
</td>
    </tr>
		<tr><th></th>
        <td>
        <div id="adding">
        <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td align="right">รหัสนักศึกษา : </td><td>&nbsp;<input name="idstu1" type="text" id="idstu1" size="13" maxlength="13" onblur="checkid()"/> <span id="cresult" style="color:#F00"></span><span id="showname" style="color:#030"></span></td></tr>
        <tr>
        <td align="right">เบอร์โทรศัพท์ : </td><td>&nbsp;<input name="tel1" type="text" id="tel1" size="14" maxlength="25"/></td>
        </tr>
        <tr>
        <td colspan="2"><input type="button" name="addm" id="addm" value="เพิ่มผู้จัดทำ" onclick="addmani()"/></td>
        </tr>
        </table>
        </div>
        <div id="edtting">
         <table cellpadding="0" cellspacing="0" border="0">
         <tr>
         <td colspan="2" align="left"><div id="showename"></div></td>
         </tr>
        <tr>

        <td align="right">รหัสนักศึกษา : </td><td><input name="idstu2" type="text" id="idstu2" size="13" maxlength="13" onblur="checkid2()"/> <span id="cresult2" style="color:#F00"></span><span id="showname2" style="color:#030"></span></td></tr>
        <tr>
        <td align="right">เบอร์โทรศัพท์ : </td><td><input name="tel2" type="text" id="tel2" size="14" maxlength="25"/></td>
        </tr>
        <tr>
        <td colspan="2">              <input type="button" value="บันทึก" onclick="savemani()" />
              <input type="button" value="ยกเลิก" onclick="cancele2()" /></td>
        </tr>
        </table>
          </div>
          </td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <td><a href="javascript:void(0);" id="addma">เพิ่มผู้จัดทำ</a></td>
    </tr>
    <tr>
      <th>อาจารย์ที่ปรึกษาร่วม :</th>
      <td><? if($coad==""){?><a href="javascript:void(0);" id="addco">เพิ่มอาจารย์ที่ปรึกษาร่วม</a><span id="tg01">ไม่มีอาจารย์ที่ปรึกษาร่วม</span><? }else{echo $coad.' <a id="delco" href="javascript:void(0);" onclick="delco('.$idco.')">ลบ</a>';}?></td>
    </tr>
                <tr>
              <th><span id="tco">คำนำหน้าชื่อที่ปรึกษาร่วม :</span></th>
              <td>
                <select name="idtitle" id="idtitle">
                <option value="0">
                    ---เลือกคำนำหน้าชื่อ---
                  </option>
                  <?
			  $sql = "select * from title order by id_title";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs2[0]?>">
                    <?=$rs2[1]?>
                  </option>
                  <?
			  }
			  ?>
                </select>
              </td>
            </tr>
    <tr>
    <th><span id="nco">ชื่ออาจารย์ที่ปรึกษาร่วม :</span></th>
    <td><input type="text" name="namecoadvisor" id="namecoadvisor" /></td>
    </tr>
    <tr>
    <th><span id="sco">นามสกุลอาจารย์ที่ปรึกษาร่วม :</span></th>
    <td><input type="text" name="snamecoadvisor" id="snamecoadvisor" /></td>
    </tr>
    <tr>
    <th>&nbsp;</th>
    <td><input name="cob" type="button" id="cob" value="เพิ่มอาจารย์ที่ปรึกษาร่วม" onclick="funcaddco();"/></td>
    </tr>
    <tr>
      <th>อาจารย์ที่ปรึกษา :</th>
      <td><select name="idteacher" id="idteacher" disabled="disabled">
          <option value="0">---เลือกอาจารย์---</option>
              <? 
			  $sql = "select * from teacher order by initials_teacher";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  if($teacher==$rs2[0])
				  {
				  ?>
                  <option value="<?=$rs2[0]?>" selected="selected">
                    <? echo $rs2[5]." ".$rs2[3]." ".$rs2[4]; ?>
                  </option>
                  <?
				  }
				  else
				  {
				  ?>
                  <option value="<?=$rs2[0]?>">
                    <? echo $rs2[5]." ".$rs2[3]." ".$rs2[4]; ?>
                  </option>
                  <?  
				  }
			  }
			  ?>
        </select>
      </td>
    </tr>
    <? if($master!="") { ?>
        <tr>
      <th>ประธาน :</th>
      <td><?=$master?></td>
      </tr>
      <? }
	  if($gum!="") { ?>
         <tr>
      <th valign="top">กรรมการ :</th>
      <td>
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
      <th>อีเมลล์ผู้จัดทำ :</th>
      <td><input name="email" type="text" disabled="disabled" id="email" value="<?=$rs[8]?>" size="35"/></td>
    </tr>
    <tr>
      <th valign="top">ที่อยู่ผู้จัดทำ :</th>
      <td><textarea id="address" name="address" cols="40" rows="3" disabled="disabled"><?=$rs[7]?></textarea></td>
    </tr>
    <tr>
      <th valign="middle">ทก.01(.pdf) :</th>
      <td valign="top">
      <input name="bup" id="bup" type="hidden" value="<?=$rs[9]?>" />
      <? if($rs[9]!="") { ?>
      <a href="<?=$rs[9]?>" target="_blank">ดู ทก.</a>
      &nbsp;<a href="javascript:void(0);" id="ctg">เปลี่ยน ทก.</a>
      <? } ?>
      <div id="changetorgor"<? if($rs[9]!="") echo ' style="display:none"'; ?>>
            <iframe id="uploadtarget" name="uploadtarget" src="" style="width:0px;height:0px;border:0"></iframe>
      <form id="frmUpload" action="project/upload.php?idproject=<?=$rs[0]?>" method="post" enctype="multipart/form-data" onsubmit="return clickupload();" target="uploadtarget">
      <span id="upmsg"></span><br>
<input id="fileupload" name="fileupload" type="file">&nbsp;
<input id="btnUpload" type="submit" value="อัพโหลด ทก.01">
</form>
      </div>
      <div id="s1" style="margin-top:15px">
      <? if($rs[9]!=""&&$rs[10]=='1') { ?>
      <input type="button" id="btnsubmittitleexam" value="ยื่นสอบหัวข้อ" onclick="submittitleexam()"/>
      <? } ?>
      </div>
      <div id="s2" style="margin-top:15px">
      <? if($rs[10]=='2') { ?>
      <input type="button" id="btnprinttitleexam" value="พิมพ์ใบยื่นสอบหัวข้อ" onClick="window.open('report/formsubmittitleexam.php', '_blank', '')"/>
      <? } ?>
      </div>
      <div id="s3" style="margin-top:15px">
      <? if($rs[10]=='6') { ?>
      <input type="button" id="btnsubmit100exam" value="ยื่นสอบร้อย%" onclick="submit100exam()"/>
      <? } ?>
      </div>
      <div id="s4" style="margin-top:15px">
      <? if($rs[10]=='11') { ?>
      <input type="button" id="btnprint100exam" value="พิมพ์ใบยื่นสอบร้อย%" onClick="window.open('report/formsubmit100exam.php', '_blank', '')"/>
      <? } ?>
      </div>
      </td>
    </tr>
  </table>
  <? 			 
   			}
			  mysqli_close($connect);
	?>
<br/></div><!-- /main-wrap -->
</body>
</html>