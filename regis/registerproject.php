<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ลงทะเบียนโครงงานพิเศษ</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
.Dang {
	color: #F00;
}
.Dang {
	font-size: 16px;
}
.Dang .Dang {
	font-weight: bold;
}
</style>
	<? include('../connectdatabase.php'); 
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
	mysqli_close($connect);
	?>
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
function checkid()
{
	if($('#idstu1').val()=="")
		return false;
	$("div#loader").show();
	var formdata = {
		idstudent:$('#idstu1').val()
	};
	$.ajax({
		url: "check_ajax/canuse.php",
		type: "GET",
		data: formdata,
		success: function(msg){
			if(msg!="")
			{
				document.getElementById('cresult').innerHTML = "รหัสนักศึกษานี้มีการลงทะเบียนโครงงานแล้ว";
				document.getElementById('showname').innerHTML = "";
				document.getElementById("idstu1").value = "";
				$("div#loader").hide();
				return false
			}
			else
			{
				$.ajax({
					url: "check_ajax/isregis.php",
					type: "GET",
					dataType: 'json',
					data: formdata,
					success: function(msg){
						if(msg.check)
						{
							document.getElementById('cresult').innerHTML = '<img src="../image/check.jpg" width="10" height="10" />';
							document.getElementById("year").value=msg.year;
							document.getElementById("semester").value=msg.semester;
							document.getElementById("id_subject").value=msg.id_subject;
							document.getElementById("sec").value=msg.sec;
							document.getElementById('showname').innerHTML = msg.showname;
							$("div#loader").hide();
						}
						else
						{
							document.getElementById('cresult').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
							document.getElementById('showname').innerHTML = "";
							document.getElementById("idstu1").value = "";
							$("div#loader").hide();
							return false
						}
					}
				});
			}
		}
	});
}
function check()
{
	var nameproject = document.getElementById("nameproject").value;
	var engnameproject = document.getElementById("engnameproject").value;
	var casestudy = document.getElementById("casestudy").value;
	var engcasestudy = document.getElementById("engcasestudy").value;
	var tel = document.getElementById("tel").value;
	var idstu1 = document.getElementById("idstu1").value;
	var idteacher = document.getElementById("idteacher").value;
	var email = document.getElementById("email").value;
	var address = document.getElementById("address").value;
	var password = document.getElementById("password").value;
	var repassword = document.getElementById("repassword").value;
	document.getElementById("nameproject").style.borderColor="";
	document.getElementById("engcasestudy").style.borderColor="";
	document.getElementById("engnameproject").style.borderColor="";
	document.getElementById("tel").style.borderColor="";
	document.getElementById("idstu1").style.borderColor="";
	document.getElementById("idteacher").style.borderColor="";
	document.getElementById("email").style.borderColor="";
	document.getElementById("address").style.borderColor="";
	document.getElementById("password").style.borderColor="";
	document.getElementById("repassword").style.borderColor="";
	document.getElementById('passnotmatch').innerHTML = "";
	if(nameproject=="")
	{
		document.getElementById("nameproject").style.borderColor="#F00";
		document.getElementById("nameproject").focus();
		return false;
	}
	if(engnameproject=="")
	{
		document.getElementById("engnameproject").style.borderColor="#F00";
		document.getElementById("engnameproject").focus();
		return false;
	}
	if(casestudy!="")
	{
		if(engcasestudy=="")
		{
			document.getElementById("engcasestudy").style.borderColor="#F00";
			document.getElementById("engcasestudy").focus();
			return false;
		}
	}
	if(idstu1=="")
	{
		document.getElementById("idstu1").style.borderColor="#F00";
		document.getElementById("idstu1").focus();
		return false;
	}
	else if(idteacher==0)
	{
		document.getElementById("idteacher").style.borderColor="#F00";
		document.getElementById("idteacher").focus();
		return false;
	}
	else if(email=="")
	{
		document.getElementById("email").style.borderColor="#F00";
		document.getElementById("email").focus();
		return false;
	}
	else if(address=="")
	{
		document.getElementById("address").style.borderColor="#F00";
		document.getElementById("address").focus();
		return false;
	}
	else if(password=="")
	{
		document.getElementById("password").style.borderColor="#F00";
		document.getElementById("password").focus();
		return false;
	}
	else if(repassword=="")
	{
		document.getElementById("repassword").style.borderColor="#F00";
		document.getElementById("repassword").focus();
		return false;
	}
	else if(tel=="")
	{
		document.getElementById("tel").style.borderColor="#F00";
		document.getElementById("tel").focus();
		return false;
	}
	else if(password!=repassword)
	{
		document.getElementById("repassword").style.borderColor="#F00";
		document.getElementById("password").style.borderColor="#F00";
		document.getElementById("password").focus();
		document.getElementById('passnotmatch').innerHTML = "<br/>รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน";
		return false;
	}
}
function clearre()
{
	document.getElementById('cresult').innerHTML = "";
	document.getElementById('showname').innerHTML = "";
}
</script>
</head>
<body>
<div id="loader" style="display:block; position: fixed; width:100%; height:100%; top:0px; left:0px; background:#999 url(check_ajax/loader.gif) no-repeat center;overflow:hidden;opacity:0.5;filter:alpha(opacity=50);display:none">
</div>
<center>

	<? 
	if (isset($_POST["regis"])) {
		?>
		<table width="100%" height="400" border="0" align="center">
 		 <tr>
    		<td valign="middle" align="center">
    <?
					include('../connectdatabase.php');
					$sql = "select max(id_project) from project where year_project = '$year' AND semester_project ='$semester'";
					$result = mysqli_query($connect, $sql);	
						while($rs = mysqli_fetch_array($result))
						{
							if($rs[0]!=NULL)
								$id = $rs[0]+1;
							else
								$id = substr($year,2,4).$semester."001";
						}
					$sql = "select max(id_user) from user";
					$result = mysqli_query($connect, $sql);
					$mdfive = md5("$password");
					while($rs = mysqli_fetch_array($result))
					{
						$iduser = $rs[0]+1;
					}
					$name1 = "ผู้จัดทำโครงงานพิเศษรหัส ".$id;
					$sname = "";
					$sql = "insert into user values('$iduser','$name1','$sname','$id','$mdfive','4','1')";
					mysqli_query($connect, $sql);
					$sql = "insert into project values('$id','$nameproject','$casestudy','$id_subject','$year','$semester','$sec','$address','$email','','1','$iduser','$engnameproject','$engcasestudy')";
					mysqli_query($connect, $sql);
					$sql = "select max(id_manipulator) from manipulator";
					$result = mysqli_query($connect, $sql);
					while($rs = mysqli_fetch_array($result))
					{
						$idmanipulator = $rs[0]+1;
					}
					$sql = "insert into manipulator values('$idmanipulator','$idstu1','$id','$tel')";
					mysqli_query($connect, $sql);
					$sql = "select max(id_committee) from committee";
					$result = mysqli_query($connect, $sql);
					while($rs = mysqli_fetch_array($result))
					{
						$idcommittee = $rs[0]+1;
					}
					$sql = "insert into committee values('$idcommittee','$idteacher','$id','ที่ปรึกษา')";
					mysqli_query($connect, $sql);
					echo '<b>ลงทะเบียนเสร็จเรียบร้อย</b><br>';
					echo '<b>ชื่อผู้ใช้งานสำหรับเข้าสู่ระบบของท่านคือ '.$id.'</b><br>';
					echo "<br><CENTER><input type=\"button\" value=\"ปิดหน้าจอ\" onclick=\"window.close();\" 
    				style=\"cursor:hand\"></CENTER>";
					mysqli_close($connect);

			?>
            </td>
  </tr>
</table>
            <?
	}
	else
	{
	?>
  <h2>ลงทะเบียนประจำปีการศึกษา <?=$year?> ภาคเรียน <?=$semester?></h2>
</center>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
  <table width="100%" border="0" align="center" >
    <tr>
      <td align="right" valign="middle" nowrap="nowrap" scope="row">รหัสนักศึกษาผู้จัดทำ :</td>
      <td>
      <input name="idstu1" type="text" id="idstu1" size="13" maxlength="13" onblur="checkid()"/> 
      *
      <span id="cresult" style="color:#F00"></span> <span id="showname" style="color:#030"></span></td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="col">ชื่อโครงงาน :</td>
      <th align="left" scope="col">
      <input name="nameproject" type="text" id="nameproject" size="50" maxlength="1000" />
      <input type="hidden" name="id_subject" id="id_subject" /><input type="hidden" name="year" id="year" /><input type="hidden" name="semester" id="semester" /><input type="hidden" name="sec" id="sec" />
      *</th>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="col">กรณีศึกษา :</td>
      <th align="left" scope="col">
      <input name="casestudy" type="text" id="casestudy" size="50" maxlength="1000" /></th>
    </tr>
    <tr>
            <tr>
      <td align="right" nowrap="nowrap" scope="col">ชื่อโครงงาน(ภาษาอังกฤษ) :</td>
      <th align="left" scope="col">
      <input name="engnameproject" type="text" id="engnameproject" size="50" maxlength="1000" />
      *</th>
    </tr>
            <tr>
      <td align="right" nowrap="nowrap" scope="col">กรณีศึกษา(ภาษาอังกฤษ) :</td>
      <th align="left" scope="col">
      <input name="engcasestudy" type="text" id="engcasestudy" size="50" maxlength="1000" />
      </th>
    </tr>
        <tr>
      <td align="right" scope="row">อาจารย์ที่ปรึกษา :</td>
      <th scope="row" align="left"><label for="idteacher"></label>
        <select name="idteacher" id="idteacher">
          <option value="0">---เลือกอาจารย์---</option>
                            <? include('../connectdatabase.php'); 
			  $sql = "select * from teacher order by initials_teacher";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs[0]?>">
                    <? echo $rs[5]." ".$rs[3]." ".$rs[4]; ?>
                  </option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
        </select>
        *</th>
    </tr>
    <tr>
        <td align="right" valign="middle" nowrap="nowrap" scope="row">เบอร์โทรศัพท์ :</td>
      <td>
      <input name="tel" type="text" id="tel" size="15" maxlength="20" onblur="checkid()"/>
      *</td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="row">อีเมลล์ผู้จัดทำ :</td>
      <td>
      <input type="text" name="email" id="email" />
      *
      </td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap" scope="row">ที่อยู่ผู้จัดทำ :</td>
      <td>
      <textarea id="address" name="address" cols="40" rows="3"></textarea>
      *
      </td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="row">รหัสผ่านเข้าสู่ระบบ :</td>
      <th align="left" scope="row">
      <input name="password" type="password" id="password" value="" size="10" />
      <span id="passnotmatch" style="color:#F00"></span>
      *</th>
    </tr>
        <tr>
      <td align="right" nowrap="nowrap" scope="row">ยืนยันรหัสผ่าน :</td>
      <th align="left" scope="row">
      <input name="repassword" type="password" id="repassword" value="" size="10" />
      *</th>
    </tr>
    <tr>
      <th colspan="2" scope="row"><input type="submit" name="regis" id="regis" value="ลงทะเบียน"/>
      <input type="reset" name="button2" id="button2" value="ล้าง"  onclick="clearre()"/></th>
    </tr>
  </table>
</form>
<p>
  <? } ?>
</p>
<span class="Dang"><span class="Dang">*หมายเหตุ เมื่อลงทะเบียนเรียบร้อยแล้วระบบจะแสดง username โปรดเก็บ usrename นี้ไว้เพื่อใช้ในการเข้าสู่ระบบ </span>
</span>
</body>
</html>