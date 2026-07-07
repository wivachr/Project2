<? include('../change.php'); ?>
	<? include('../connectdatabase.php'); 
	$c = 0;
	$sql = "select * from committee where id_project = '$id'  and position<>'ที่ปรึกษา'";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$t[$c]=$rs[1];
		$c+=1;
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="_js/datetimepicker.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	<? include('../connectdatabase.php'); 
	$sql = "select * from teacherfreetime where id_teacher = '$t[0]' OR id_teacher = '$t[1]' OR id_teacher = '$t[2]'";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{

		if($rs[0]=="1")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('M'+i).style.backgroundColor = "#FF6666";
				<?
			}
			}
		}
		if($rs[0]=="2")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('T'+i).style.backgroundColor = "#FF6666";
				<?
			}
			}
		}
		if($rs[0]=="3")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('W'+i).style.backgroundColor = "#FF6666";
				<?
			}
			}
		}
		if($rs[0]=="4")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('H'+i).style.backgroundColor = "#FF6666";
				<?
			}
			}
		}
		if($rs[0]=="5")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('F'+i).style.backgroundColor = "#FF6666";
				<?
			}
			}
		}
	}
	mysqli_close($connect);
	?>
	 });

	 function assigningex2(id,idsubmit)
	 {
		var b = true;
		var a = true;
		 var dateassex=document.getElementById("dateassex").value;
		 var timeassex=document.getElementById("timeassex").value;
		 var endtimeassex=document.getElementById("endtimeassex").value;
		 var roomassex=document.getElementById("roomassex").value;
		 document.getElementById("dateassex").style.borderColor="";
		 document.getElementById("timeassex").style.borderColor="";
		 document.getElementById("endtimeassex").style.borderColor="";
		 document.getElementById("roomassex").style.borderColor="";
		 if(dateassex=="")
		 {
			document.getElementById("dateassex").style.borderColor="#F00";
			document.getElementById("dateassex").focus();
			return false;
		 }
		 else if(timeassex==0)
		 {
			document.getElementById("timeassex").style.borderColor="#F00";
			document.getElementById("timeassex").focus();
			return false;
		 }
		 else if(endtimeassex==0)
		 {
			document.getElementById("endtimeassex").style.borderColor="#F00";
			document.getElementById("endtimeassex").focus();
			return false;
		 }
		 else if(roomassex==0)
		 {
			document.getElementById("roomassex").style.borderColor="#F00";
			document.getElementById("roomassex").focus();
			return false;
		 }
if(timeassex.substring(0,2)>=endtimeassex.substring(0,2))
		 {
			alert("กรุณาใส่เวลาเริ่มต้นให้น้อยกว่าเวลาสิ้นสุด");
			document.getElementById("timeassex").style.borderColor="#F00";
			document.getElementById("timeassex").focus();
			return false;
		 }
		 		var dtt =  dateassex.split('-');
		var d1 = new Date(dtt[0]-543, dtt[1]-1, dtt[2]);
		 	<?
	include('../connectdatabase.php');
	$sql = "select * from teacherfreetime where id_teacher = '$t[0]' OR id_teacher = '$t[1]' OR id_teacher = '$t[2]'";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		var air;
		
		for(air = timeassex.substring(0,2);air <= endtimeassex.substring(0,2);air++)
		{
			if(a)
			{
				if(air==<?=$rs[1]+7;?> && d1.getDay() == <?=$rs[0]?>)
				{
					//alert(air);
					var answer = confirm  ("เวลาที่จัดสอบตรงกับเวลาที่ไม่ว่างของคณะกรรมการจะดำเนินการต่อหรือไม่ ?")
					if (answer)
					{
						a = false;
						break;
					}
					return false;
				}
			}
		}

		<?
	}
	?>
		 	<?
	include('../connectdatabase.php');
	$sql = "SELECT date_assignexam,time_assignexam,	endtime_assignexam
FROM exam, project, committee,assignexam
WHERE project.id_project = committee.id_project
AND exam.id_exam = assignexam.id_exam
AND exam.id_project = project.id_project
AND exam.id_statusproject = '21'
AND (
committee.id_teacher = '$t[0]'
OR committee.id_teacher = '$t[1]'
OR committee.id_teacher = '$t[2]'
)";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$stt = substr($rs[1],0,2);
		$ett = substr($rs[2],0,2);
		?>
		//alert("<?=$rs[0]?>");
		//alert("<?=substr($rs[1],0,2)?>");
		//alert("<?=$rs[2]?>");
		if(b)
		{
			if(dateassex=="<?=$rs[0]?>")
			{
				var ctime;
				for(ctime=timeassex.substring(0,2);ctime<=endtimeassex.substring(0,2);ctime++)
				{
					if(ctime>='<?=$stt?>'&&ctime<='<?=$ett?>')
					{
							var answer = confirm  ("เวลาที่จัดสอบนี้เคยมีการจัดสอบไปแล้วจะดำเนินการต่อหรือไม่ ?");
							if (answer)
							{
								b = false;
								break;
							}
							return false;
					}
				}
			}
		}
		<?
	}
	?>
		var x = document.getElementById("result");
		x.innerHTML = "";
		var req;
		if(window.ActiveXObject)
		{
			req=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else if (window.XMLHttpRequest)
		{
			req=new XMLHttpRequest();
		}
		else
		{
			alert("Browser not support");
			return false;
		}
		var str = Math.random();
		var  qstr ="project/assigningexam2.php?pop="+str;
		qstr += "&&dateassex="+encodeURIComponent(dateassex);
		qstr += "&&timeassex="+encodeURIComponent(timeassex);
		qstr += "&&endtimeassex="+encodeURIComponent(endtimeassex);
		qstr += "&&roomassex="+encodeURIComponent(roomassex);
		qstr += "&&id="+encodeURIComponent(id);	
		qstr += "&&idsubmit="+encodeURIComponent(idsubmit);	
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var resultarea= document.getElementById('showmanage');
   				resultarea.innerHTML = req.responseText;
				var popsrt = Math.random();
				alert('จัดวันสอบเรียบร้อยแล้ว');
				$("#showmanage").load("project/shows4.php?pop="+popsrt);
	
			}
			else
			{
				var x = document.getElementById("showmanage");
				x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
	 }
</script><title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td colspan="2" align="center"><h3>จัดสอบร้อย รหัส <?=$id?></h3>
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
    <td width="495" align="right">วันที่จัดสอบ :</td>
    <td width="493" align="left">
    	  		<input name="dateassex" type="text" id="dateassex" size="9" maxlength="9" readonly="readonly"><a href="javascript:NewCal('dateassex','ddmmyyyy')"><img src="image/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
  </tr>
  <tr>
    <td align="right">เวลาที่เริ่มสอบ :</td>
    <td align="left"><label for="timeassex"></label>
      <select name="timeassex" id="timeassex">
        <option value="0">--- เลือกเวลา ---</option>
        <?
		for($i=8;$i<21;$i++)
		{
									if($i<10)
			$i="0".$i;
		?>
        <option value="<?=$i?>:00"><?=$i?>:00</option>
        <?
		}
		?>
    </select></td>
  </tr>
  <tr>
    <td align="right">เวลาที่จบ :</td>
    <td align="left"><label for="endtimeassex"></label>
      <select name="endtimeassex" id="endtimeassex">
        <option value="0">--- เลือกเวลา ---</option>
        <?
		for($i=8;$i<21;$i++)
		{
									if($i<10)
			$i="0".$i;
		?>
        <option value="<?=$i?>:00"><?=$i?>:00</option>
        <?
		}
		?>
    </select></td>
  </tr>
    <tr>
    <td align="right">ห้องสอบ :</td>
    <td align="left">
            <select name="roomassex" id="roomassex">
          <option value="0">---เลือกห้องเรียน---</option>
                            <?
							include('../../connectdatabase.php');
			  $sql = "select * from room";
			  
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs[0]?>">
                    <? echo $rs[1]; ?>
                  </option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
        </select>
        </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="button" name="assigexb" id="assigexb" value="จัดสอบ" onclick="assigningex2(<?=$id?>,<?=$idsubmit?>)" />
    <input type="submit" name="cancel" id="cancel" onclick="cancele();" value="ยกเลิก" /></td>
  </tr>
</table>
<h3>ตารางว่างของคณะกรรมการ</h3>
<table width="56%" border="1">
  <tr>
    <td align="center" bgcolor="#CCCCCC">Day</td>
    <td align="left" bgcolor="#CCCCCC">08:00 </td>
    <td align="left" bgcolor="#CCCCCC">09:00 </td>
    <td align="left" bgcolor="#CCCCCC">10:00</td>
    <td align="left" bgcolor="#CCCCCC">11:00</td>
    <td align="left" bgcolor="#CCCCCC">12:00</td>
    <td align="left" bgcolor="#CCCCCC">13:00</td>
    <td align="left" bgcolor="#CCCCCC">14:00</td>
    <td align="left" bgcolor="#CCCCCC">15:00</td>
    <td align="left" bgcolor="#CCCCCC">16:00</td>
    <td align="left" bgcolor="#CCCCCC">17:00</td>
    <td align="left" bgcolor="#CCCCCC">18:00</td>
    <td align="left" bgcolor="#CCCCCC">19:00</td>
    <td align="left" bgcolor="#CCCCCC">20:00</td>
  </tr>
  <tr>
  <td align="center" bgcolor="#CCCCCC">M</td>
  <?
  for($i=1;$i<14;$i++)
  {
	  ?>
      <td align="center" bgcolor="#99FF99" id="M<?=$i?>">&nbsp;</td>
      <?
  }
  ?>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">T</td>
  <?
  for($i=1;$i<14;$i++)
  {
	  ?>
      <td align="center" bgcolor="#99FF99" id="T<?=$i?>">&nbsp;</td>
      <?
  }
  ?>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">W</td>
  <?
  for($i=1;$i<14;$i++)
  {
	  ?>
      <td align="center" bgcolor="#99FF99" id="W<?=$i?>">&nbsp;</td>
      <?
  }
  ?>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">H</td>
  <?
  for($i=1;$i<14;$i++)
  {
	  ?>
      <td align="center" bgcolor="#99FF99" id="H<?=$i?>">&nbsp;</td>
      <?
  }
  ?>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">F</td>
  <?
  for($i=1;$i<14;$i++)
  {
	  ?>
      <td align="center" bgcolor="#99FF99" id="F<?=$i?>">&nbsp;</td>
      <?
  }
  ?>
  </tr>
</table>
<p>

</p>
</body>
</html>