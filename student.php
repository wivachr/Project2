<? session_start();?>
<? include('change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="_js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#showmanage").load("project/project.php");
	$("#changepassword").click(function () {
			$("#showmanage").load("password/changepassword.php");
	  		$("#showmanage").fadeIn();
    });
		$("#project").click(function () {
			$("#showmanage").load("project/project.php");
	  		$("#showmanage").fadeIn();
    });
		$("#viewexam").click(function () {
			var dang = Math.random();
			$("#showmanage").load("project/viewexam.php?pop="+dang);
	  		$("#showmanage").fadeIn();
    });
		$("#viewedit").click(function () {
			var dang = Math.random()
			$("#showmanage").load("project/viewedit.php?pop="+dang);
	  		$("#showmanage").fadeIn();
    });
 });
 	 function submittitleexam()
	 {
		 var answer = confirm  ("ยืนยันการยื่นสอบหัวข้อ ?")
if (answer)
{
		var idproject = document.getElementById("idproject").value;
		var x = document.getElementById("result");
		if(document.getElementById("bup").value=="")
		{
			document.getElementById("fileupload").style.borderColor = "#FF6666";
			return false;
		}
		x.innerHTML = "";
		var  req;
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
		var  qstr ="project/submittitleexam.php?pop="+str;
		qstr += "&&idproject="+encodeURIComponent(idproject);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var popsrt = Math.random();
				$("#showmanage").load("project/project.php?pop="+popsrt);
				var resultarea= document.getElementById('result');
				resultarea.innerHTML = req.responseText;
			}
			else
			{
				var x = document.getElementById("result");
				x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
}
	 }
 	 function submit100exam()
	 {
		 var answer = confirm  ("ยืนยันการยื่นสอบร้อย?")
if (answer)
{
		var idproject = document.getElementById("idproject").value;
		var x = document.getElementById("result");
		x.innerHTML = "";
		var  req;
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
		var  qstr ="project/submit100exam.php?pop="+str;
		qstr += "&&idproject="+encodeURIComponent(idproject);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var popsrt = Math.random();
				$("#showmanage").load("project/project.php?pop="+popsrt);
				var resultarea= document.getElementById('result');
				resultarea.innerHTML = req.responseText;
			}
			else
			{
				var x = document.getElementById("result");
				x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
}
	 }
	 function registerproject2(idproject)
	 {
		 var answer = confirm  ("ยืนยันการลงทะเบียนใช่หรือไม่ ?")
if (answer)
{
		var  req;
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
		var  qstr ="project/registerproject2.php?pop="+str;
		qstr += "&&idproject="+encodeURIComponent(idproject);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var parts = req.responseText.split("|");
				if(parts[0]=="OK")
				{
					alert("ลงทะเบียนโปรเจค 2 เรียบร้อยแล้ว\nรหัสโครงงานใหม่คือ "+parts[1]+"\nใช้รหัสผ่านเดิมในการเข้าสู่ระบบด้วยรหัสโครงงานนี้");
					var popsrt = Math.random();
					$("#showmanage").load("project/project.php?pop="+popsrt);
				}
				else
				{
					alert(parts[1]);
				}
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
}
	 }
 	 function submit60exam()
	 {
		 var answer = confirm  ("ยืนยันการยื่นสอบหกสิบ ?")
if (answer)
{
		var idproject = document.getElementById("idproject").value;
		var x = document.getElementById("result");
		x.innerHTML = "";
		var  req;
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
		var  qstr ="project/submit60exam.php?pop="+str;
		qstr += "&&idproject="+encodeURIComponent(idproject);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var popsrt = Math.random();
				$("#showmanage").load("project/project.php?pop="+popsrt);
				var resultarea= document.getElementById('result');
				resultarea.innerHTML = req.responseText;
			}
			else
			{
				var x = document.getElementById("result");
				x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
}
	 }
 function logout()
{
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
	var  qstr ="logout.php?pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#login").load("login.php?pop="+popsrt);
   			var resultarea= document.getElementById('loginresult');
   			resultarea.innerHTML = req.responseText;
		}
		else
		{
			var x = document.getElementById("loginresult");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
}
	 function addmani()
	{
	var idstu1 = document.getElementById("idstu1").value;
	var tel1 = document.getElementById("tel1").value;
	document.getElementById("idstu1").style.borderColor="";
	document.getElementById("tel1").style.borderColor="";
	if(idstu1=="")
	{
		document.getElementById("idstu1").style.borderColor="#F00";
		document.getElementById("idstu1").focus();
		return false;
	}
	else if(tel1=="")
	{
		document.getElementById("tel1").style.borderColor="#F00";
		document.getElementById("tel1").focus();
		return false;
	}
	var  req;
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
	var  qstr ="project/addmanipulator.php?pop="+str;
	qstr += "&&idstu1="+encodeURIComponent(idstu1);
	qstr += "&&tel1="+encodeURIComponent(tel1);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#showmanage").load("project/project.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("idstu1").value="";
			document.getElementById("tel1").value = "";
		}
		else
		{
			var x = document.getElementById("result");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
}
	function uploadfalse()
{
document.getElementById('fileupload').value ="";
document.getElementById('upmsg').style.color="#FF6666";
document.getElementById('upmsg').innerHTML = 'กรุณาอัพโหลดไฟล์ประเภท pdf' ;
document.getElementById('btnUpload').value = "อัพโหลด ทก.01";
document.getElementById('btnUpload').disabled = false;
document.getElementById('frmUpload').reset() ;
return true ;
}
function uploadok(pathfile)
{
document.getElementById('fileupload').value ="";
document.getElementById('upmsg').style.color="";
document.getElementById('btnUpload').value = "อัพโหลด ทก.01";
document.getElementById('btnUpload').disabled = false;
document.getElementById('frmUpload').reset() ;
			alert('อัพโหลดไฟล์ ทก.01 สำเร็จ');
			var popsrt = Math.random();
			$("#showmanage").load("project/project.php?pop="+popsrt);
return true ;
}
	 function funcaddco()
	 {
		var idtitle= document.getElementById("idtitle").value;
		var namecoadvisor = document.getElementById("namecoadvisor").value;
		var snamecoadvisor = document.getElementById("snamecoadvisor").value;
		document.getElementById("idtitle").style.borderColor="";
		document.getElementById("namecoadvisor").style.borderColor="";
		document.getElementById("snamecoadvisor").style.borderColor="";
		if(idtitle==0)
		{
			document.getElementById("idtitle").style.borderColor="#F00";
			document.getElementById("idtitle").focus();
			return false;
		}
		else if(namecoadvisor=="")
		{
			document.getElementById("namecoadvisor").style.borderColor="#F00";
			document.getElementById("namecoadvisor").focus();
			return false;
		}
		else if(snamecoadvisor=="")
		{
			document.getElementById("snamecoadvisor").style.borderColor="#F00";
			document.getElementById("snamecoadvisor").focus();
			return false;
		}
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
	var  qstr ="project/addcoadvisor.php?pop="+str;
	qstr += "&&idtitle="+encodeURIComponent(idtitle);
	qstr += "&&namecoadvisor="+encodeURIComponent(namecoadvisor);
	qstr += "&&snamecoadvisor="+encodeURIComponent(snamecoadvisor);
	qstr += "&&idproject="+encodeURIComponent(document.getElementById("idproject").value);		
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#showmanage").load("project/project.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;

		}
		else
		{
			var x = document.getElementById("result");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
	 }
function savemani()
{
	var idstu2 = document.getElementById("idstu2").value;
	var tel2 = document.getElementById("tel2").value;
	document.getElementById("idstu2").style.borderColor="";
	document.getElementById("tel2").style.borderColor="";
	if(idstu2=="")
	{
		document.getElementById("idstu2").style.borderColor="#F00";
		document.getElementById("idstu2").focus();
		return false;
	}
	else if(tel2=="")
	{
		document.getElementById("tel2").style.borderColor="#F00";
		document.getElementById("tel2").focus();
		return false;
	}
	var  req;
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
	var  qstr ="project/editmanipulator2.php?pop="+str;
	qstr += "&&idstu="+encodeURIComponent(idstu2);
	qstr += "&&tel2="+encodeURIComponent(tel2);
	qstr += "&&idmani="+encodeURIComponent(idmaniedit);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
		 var popsrt = Math.random();
		$("#showmanage").load("project/project.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
				document.getElementById('cresult').innerHTML = "";
	document.getElementById('showname').innerHTML = "";
	document.getElementById("idstu2").value = "";
	document.getElementById("tel2").value = "";
		}
		else
		{
			var x = document.getElementById("result");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
	}
	function cancele2()
{
	document.getElementById('cresult').innerHTML = "";
	document.getElementById('showname').innerHTML = "";
	document.getElementById("idstu2").value = "";
	document.getElementById("tel2").value = "";
	$("#edtting").hide();
}
function delco(idco)
{
var answer = confirm  ("ยืนยันการลบ ?")
if (answer)
{
	var  req;
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
	var  qstr ="project/delcoadvisor.php?id="+idco+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#showmanage").load("project/project.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
		}
		else
		{
			var x = document.getElementById("result");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
}
}
function delmani(idmani)
{
var answer = confirm  ("ยืนยันการลบ ?")
if (answer)
{
	var  req;
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
	var  qstr ="project/delmanipulator.php?id="+idmani+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#showmanage").load("project/project.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
		}
		else
		{
			var x = document.getElementById("result");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
}
}
function save()
{
	var nameproject = document.getElementById("nameproject").value;
	var casestudy = document.getElementById("casestudy").value;
	var idteacher = document.getElementById("idteacher").value;
	var email = document.getElementById("email").value;
	var address = document.getElementById("address").value;
	var idproject = document.getElementById("idproject").value;
	var engnameproject = document.getElementById("engnameproject").value;
	var engcasestudy = document.getElementById("engcasestudy").value;
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
	var  qstr ="project/editproject.php?id="+idproject+"&&address="+address+"&&email="+encodeURIComponent(email)+"&&idteacher="+encodeURIComponent(idteacher)+"&&nameproject="+encodeURIComponent(nameproject)+"&&casestudy="+encodeURIComponent(casestudy)+"&&engnameproject="+encodeURIComponent(engnameproject)+"&&engcasestudy="+encodeURIComponent(engcasestudy)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#showmanage").load("project/project.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cancel()
			
		}
		else
		{
			var x = document.getElementById("result");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
}
</script>
<title>หน้าจอสำหรับนักศึกษา</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
	font-family: Tahoma, Geneva, sans-serif;
}
body {
	background-image: url();
	background-color: #DDD;
}
.F14 {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?
if((!(empty($_SESSION['fullname'])))&&$_SESSION['right']==4)
{
?>
<table width="1020" height="768" border="0" align="center"cellpadding="0" cellspacing="0">
  <tr>
    <td height="150" colspan="2" background="image/head.gif" valign="middle"><img src="image/logo_it.png" width="200" height="200" align="left" style="margin-left:15px" /></td>
  </tr>
  <tr height="20">
    <td colspan="2" align="right" bgcolor="#000000"><span style="color:#FFF">
    	<? include('connectdatabase.php'); 
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
	mysqli_close($connect);
	?>
      ปีการศึกษา <?=$year?> ภาคเรียนที่ <?=$semester?></span></td>
  </tr>
  <tr>
    <td width="200" valign="top" bgcolor="#CCCCCC" class="F14">
    <br />
    <br />
    <div>
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="index.php">หน้าหลัก</a><br />
	&nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="project">จัดการข้อมูลโครงงานพิเศษ</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="viewexam">ดูประวัติการสอบ</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="viewedit">ดูประวัติการแก้ไข</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="changepassword">เปลี่ยนรหัสผ่าน</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="index.php" onclick="logout()">ออกจากระบบ</a><br />
    		<br />
</td>
    <td align="center" valign="top" bgcolor="#FFFFFF">
    <br/>
    <div id="showmanage" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div><br/>
    <div id="result"></div><br/></td>
  </tr>
  <tr height="60">
    <td colspan="2" align="center" valign="middle" bgcolor="#000000"><span style="color:#FFF">สงวนลิขสิทธิ์ ภาควิชาเทคโนโลยีสารสนเทศ คณะเทคโนโลยีและการจัดการอุตสาหกรรม มจพ.ปราจีนบุรี<br />ปรับปรุงล่าสุด: 7 กรกฎาคม 2569</span></td>
  </tr>
</table>
<? }?>
</body>
</html>
