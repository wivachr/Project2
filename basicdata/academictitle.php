<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idacademictitle;
	$(document).ready(function() {
	var popsrt = Math.random();
	$("#listacademictitle").load("basicdata/show/showacademictitle.php?pop="+popsrt);
	$("#editbutton").hide();
	$("#cancelbutton").hide();
	 });
function add()
{
	var academictitlename = document.getElementById("academictitlename").value;
	var it = document.getElementById("academictitlei").value;
	document.getElementById("academictitlename").style.borderColor="";
	document.getElementById("academictitlei").style.borderColor="";
	if(academictitlename=="")
	{
		document.getElementById("academictitlename").style.borderColor="#F00";
		document.getElementById("academictitlename").focus();
		return false;
	}
	else if(it=="")
	{
		document.getElementById("academictitlei").style.borderColor="#F00";
		document.getElementById("academictitlei").focus();
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
	var  qstr ="basicdata/add/addacademictitle.php?pop="+str;
	qstr += "&&academictitlename="+encodeURIComponent(academictitlename);
	qstr += "&&it="+encodeURIComponent(it);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listacademictitle").load("basicdata/show/showacademictitle.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("academictitlename").value="";
			document.getElementById("academictitlei").value="";
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
	document.getElementById("academictitlename").value="";
	document.getElementById("academictitlei").value="";
}
function cancel()
{
	document.getElementById("academictitlename").style.borderColor="";
	document.getElementById("academictitlename").value="";
	document.getElementById("academictitlei").style.borderColor="";
	document.getElementById("academictitlei").value="";
	$("#editbutton").hide();
	$("#cancelbutton").hide();
	$("#add").show();
}
function del(idacademictitle)
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
	var  qstr ="basicdata/del/delacademictitle.php?id="+idacademictitle+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listacademictitle").load("basicdata/show/showacademictitle.php?pop="+popsrt);
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
function showedit(id,name,i)
{
	document.getElementById("academictitlename").style.borderColor="";
	idacademictitle = id;
	document.getElementById("academictitlename").value = name;
	document.getElementById("academictitlei").value = i;
	$("#editbutton").show();
	$("#cancelbutton").show();
	$("#add").hide();
}
function edit()
{
	var editname = document.getElementById("academictitlename").value;
	var i = document.getElementById("academictitlei").value;
	document.getElementById("academictitlename").style.borderColor="";
	document.getElementById("academictitlei").style.borderColor="";
	if(editname=="")
	{
		document.getElementById("academictitlename").style.borderColor="#F00";
		document.getElementById("academictitlename").focus();
		return false;
	}
	else if(i=="")
	{
		document.getElementById("academictitlei").style.borderColor="#F00";
		document.getElementById("academictitlei").focus();
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
	var  qstr ="basicdata/edit/editacademictitle.php?id="+idacademictitle+"&&i="+encodeURIComponent(i)+"&&name="+encodeURIComponent(editname)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listacademictitle").load("basicdata/show/showacademictitle.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("academictitlename").value="";
			document.getElementById("academictitlei").value="";
			$("#editbutton").hide();
			$("#cancelbutton").hide();
			$("#add").show();
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
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลคำนำหน้าชื่อทางวิชาการ</h2>
        </center>

                <table border="0" align="center">
            <tr>
              <td align="right">คำนำหน้าชื่อทางวิชาการ :</td>
              <td align="left">
                <input type="text" name="academictitlename" id="academictitlename" /></td>
  </tr>
              <tr>
              <td align="right">ชื่อย่อคำนำหน้าชื่อทางวิชาการ :</td>
              <td align="left">
                <input type="text" name="academictitlei" id="academictitlei" /></td>
  </tr>
            <tr>
              <td colspan="2" align="center">
              <input type="button" name="editbutton" id="editbutton" value="บันทึก" onclick="edit()" />
              <input type="button" name="add" id="add" value="เพิ่ม" onclick="add()" />
              <input type="button" name="button2" id="button2" value="ล้าง" onclick="cleardata()"/>
              <input type="button" name="cancelbutton" id="cancelbutton" value="ยกเลิก" onclick="cancel()"/></td>
    </tr>
</table>
                <hr />
<br/>
  <div id="listacademictitle" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>