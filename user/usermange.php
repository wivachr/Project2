<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
var iduser;
	$(document).ready(function() {
	var popsrt = Math.random();
$("#listuser").load("user/showuser.php?pop="+popsrt);
	$("#edituser").hide();
	$("#canceluser").hide();
	 });
function add()
{
	var username1 = document.getElementById("username1").value;
	var usersname = document.getElementById("usersname").value;
	var nameuser = document.getElementById("nameuser").value;
	var password = document.getElementById("password").value;
	var repassword = document.getElementById("repassword").value;
	var rightid = document.getElementById("rightid").value;
	document.getElementById("username1").style.borderColor="";
	document.getElementById("usersname").style.borderColor="";
	document.getElementById("nameuser").style.borderColor="";
	document.getElementById("password").style.borderColor="";
	document.getElementById("repassword").style.borderColor="";
	document.getElementById("rightid").style.borderColor="";
	if(username1=="")
	{
		document.getElementById("username1").style.borderColor="#F00";
		document.getElementById("username1").focus();
		return false;
	}
	else if(usersname=="")
	{
		document.getElementById("usersname").style.borderColor="#F00";
		document.getElementById("usersname").focus();
		return false;
	}
	else if(nameuser=="")
	{
		document.getElementById("nameuser").style.borderColor="#F00";
		document.getElementById("nameuser").focus();
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
	else if(rightid=="0")
	{
		document.getElementById("rightid").style.borderColor="#F00";
		document.getElementById("rightid").focus();
		return false;
	}
	else if(password!=repassword)
	{

		alert("โปรดใส่รหัสผ่านให้ตรงกัน");
		document.getElementById("password").style.borderColor="#F00";
		document.getElementById("repassword").style.borderColor="#F00";
		document.getElementById("password").focus();
		return false;
	}
	<?
	include('../connectdatabase.php');
	$sql = "select username from user";
	$result = mysqli_query($connect, $sql);
	$password = $password ?? '';
	$mdfive = md5($password);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		if(nameuser==<?=json_encode((string)$rs[0]);?>)
		{
			alert("มีชื่อผู้ใช้นี้แล้วในระบบ");		
			document.getElementById("nameuser").style.borderColor="#F00";
			document.getElementById("nameuser").style.borderColor="#F00";
			document.getElementById("nameuser").focus();
			return false;
		}
		<?
	}
	?>
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
	var  qstr ="user/adduser.php?pop="+str;
	qstr += "&&username1="+encodeURIComponent(username1);
	qstr += "&&usersname="+encodeURIComponent(usersname);
	qstr += "&&nameuser="+encodeURIComponent(nameuser);
	qstr += "&&password="+encodeURIComponent(password);
	qstr += "&&rightid="+encodeURIComponent(rightid);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listuser").load("user/showuser.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
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

function cancel()
{
	document.getElementById("usersname").style.borderColor="";
	document.getElementById("nameuser").style.borderColor="";
	document.getElementById("password").style.borderColor="";
	document.getElementById("repassword").style.borderColor="";
	document.getElementById("rightid").style.borderColor="";
	cleardata();
	$("#edituser").hide();
	$("#canceluser").hide();
	$("#adduser").show();
}
function del(iduser)
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
	var  qstr ="user/deluser.php?id="+iduser+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listuser").load("user/showuser.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#edituser").hide();
			$("#canceluser").hide();
			$("#adduser").show();
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
function reset1(iduser)
{
var answer = confirm  ("ยืนยันรีเซ็ทพาสเวิร์ด")
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
	var  qstr ="user/resetuser.php?id="+iduser+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listuser").load("user/showuser.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#edituser").hide();
			$("#canceluser").hide();
			$("#adduser").show();
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
function showedit(id,name,sname,user,rightid)
{
	document.getElementById("usersname").style.borderColor="";
	document.getElementById("nameuser").style.borderColor="";
	document.getElementById("password").style.borderColor="";
	document.getElementById("repassword").style.borderColor="";
	document.getElementById("rightid").style.borderColor="";
	iduser = id;
	document.getElementById("username1").value = name;
	document.getElementById("usersname").value = sname;
	document.getElementById("nameuser").value = user;
	document.getElementById("rightid").value = rightid;
	$("#edituser").show();
	$("#canceluser").show();
	$("#adduser").hide();
}
function edit()
{
	var editname = document.getElementById("username1").value;
	var editsname = document.getElementById("usersname").value;
	var editnameuser = document.getElementById("nameuser").value;
	var editpassword = document.getElementById("password").value;
	var editrepassword = document.getElementById("repassword").value;
	var editrightid = document.getElementById("rightid").value;
		document.getElementById("username1").style.borderColor="";
	document.getElementById("usersname").style.borderColor="";
	document.getElementById("nameuser").style.borderColor="";
	document.getElementById("password").style.borderColor="";
	document.getElementById("repassword").style.borderColor="";
	document.getElementById("rightid").style.borderColor="";
	var x = document.getElementById("result");
	x.innerHTML = "";
	if(editname=="")
	{
		document.getElementById("username1").style.borderColor="#F00";
		document.getElementById("username1").focus();
		return false;
	}
	else if(editsname=="")
	{
		document.getElementById("usersname").style.borderColor="#F00";
		document.getElementById("usersname").focus();
		return false;
	}
	else if(editnameuser=="")
	{
		document.getElementById("nameuser").style.borderColor="#F00";
		document.getElementById("nameuser").focus();
		return false;
	}
	else if(editpassword=="")
	{
		document.getElementById("password").style.borderColor="#F00";
		document.getElementById("password").focus();
		return false;
	}
	else if(editrepassword=="")
	{
		document.getElementById("repassword").style.borderColor="#F00";
		document.getElementById("repassword").focus();
		return false;
	}
	else if(editrightid=="0")
	{
		document.getElementById("rightid").style.borderColor="#F00";
		document.getElementById("rightid").focus();
		return false;
	}
	else if(editpassword!=editrepassword)
	{
		alert("โปรดใส่รหัสผ่านให้ตรงกัน");
		document.getElementById("password").style.borderColor="#F00";
		document.getElementById("repassword").style.borderColor="#F00";
		document.getElementById("password").focus();
		return false;
	}
	<?
	include('../connectdatabase.php');
	$sql = "select id_user,username from user";
	$result = mysqli_query($connect, $sql);
	$password = $password ?? '';
	$mdfive = md5($password);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		if(editnameuser==<?=json_encode((string)$rs[1]);?>&&iduser!=<?=(int)$rs[0];?>)
		{
			alert("มีชื่อผู้ใช้นี้แล้วในระบบ");		
			document.getElementById("nameuser").style.borderColor="#F00";
			document.getElementById("nameuser").style.borderColor="#F00";
			document.getElementById("nameuser").focus();
			return false;
		}
		<?
	}
	?>
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
	var  qstr ="user/edituser.php?id="+iduser+"&&name="+encodeURIComponent(editname)+"&&sname="+encodeURIComponent(editsname)+"&&nameuser=";
	qstr += encodeURIComponent(editnameuser)+"&&password="+encodeURIComponent(editpassword)+"&&rightid="+editrightid+"&&pop="+str;				
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listuser").load("user/showuser.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#edituser").hide();
			$("#canceluser").hide();
			$("#adduser").show();
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
function cleardata()
{
	document.getElementById("username1").value="";
	document.getElementById("usersname").value="";
	document.getElementById("nameuser").value="";
	document.getElementById("password").value="";
	document.getElementById("repassword").value="";
	document.getElementById("rightid").value=1;
}
</script>
<title></title>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลผู้ใช้งานระบบ</h2>
        </center>
  <table border="0" align="center">
            <tr>
              <td align="right">ชื่อ :</td>
              <td align="left"><label for="username1"></label>
              <input type="text" name="username1" id="username1" /></td>
            </tr>
            <tr>
              <td align="right">นามสกุล :</td>
              <td align="left"><label for="usersname"></label>
              <input type="text" name="usersname" id="usersname" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อผู้ใช้งานระบบ :</td>
              <td align="left"><label for="nameuser"></label>
              <input type="text" name="nameuser" id="nameuser" /></td>
            </tr>
            <tr>
              <td align="right">รหัสผ่าน :</td>
              <td align="left"><label for="password"></label>
              <input type="password" name="password" id="password" /></td>
            </tr>
              <td align="right">ยืนยันรหัสผ่าน :</td>
              <td align="left"><label for="repassword"></label>
                <input type="password" name="repassword" id="repassword" /></td>
            </tr>
            <tr>
              <td align="right">สิทธิ์ :</td>
              <td align="left"><label for="rightid"></label>
                <select name="rightid" id="rightid">
                <option value="0">
                  ---เลือกสิทธิ์---
                </option>
              <? include('../connectdatabase.php'); 
			  $sql = "select * from `right` where id_right = 1 OR id_right = 2 order by id_right";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                <option value="<?=$rs[0]?>">
                  <?=$rs[1]?>
                </option>
                <?
			  }
			  mysqli_close($connect);
			  ?>
              </select></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="edituser" id="edituser" value="บันทึก" onclick="edit()"/>
                <input type="submit" name="adduser" id="adduser" value="เพิ่ม" onclick="add()"/>
                <input type="reset" name="clearuser" id="clearuser" value="ล้าง" onclick="cleardata()" />
                <input type="button" name="canceluser" id="canceluser" value="ยกเลิก" onclick="cancel()"/></td>
    </tr>
      </table>
      <br/>
      <div id="listuser" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>