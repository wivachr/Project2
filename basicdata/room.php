<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idroom;
	$(document).ready(function() {
	$("#editroom").hide();
	$("#cancelroom").hide();
	if ($("#showmanage").length === 0) {
		var popsrt = Math.random();
		$("#listroom").load("basicdata/show/showroom.php?pop="+popsrt);
	}
	 });
function add()
{
	var roomname = document.getElementById("roomname").value;
	document.getElementById("roomname").style.borderColor="";
	if(roomname=="")
	{
		document.getElementById("roomname").style.borderColor="#F00";
		document.getElementById("roomname").focus();
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
	var  qstr ="basicdata/add/addroom.php?pop="+str;
	qstr += "&&roomname="+encodeURIComponent(roomname);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listroom").load("basicdata/show/showroom.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("roomname").value="";
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
	document.getElementById("roomname").style.borderColor="";
	document.getElementById("roomname").value="";
	$("#editroom").hide();
	$("#cancelroom").hide();
	$("#addroom").show();
}
function del(idroom)
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
	var  qstr ="basicdata/del/delroom.php?id="+idroom+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listroom").load("basicdata/show/showroom.php?pop="+popsrt);
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
function showedit(id,name)
{
	document.getElementById("roomname").style.borderColor="";
	idroom = id;
	document.getElementById("roomname").value = name;
	$("#editroom").show();
	$("#cancelroom").show();
	$("#addroom").hide();
}
function edit()
{
	var editname = document.getElementById("roomname").value;
	var req;
	document.getElementById("roomname").style.borderColor="";
	if(editname=="")
	{
		document.getElementById("roomname").style.borderColor="#F00";
		document.getElementById("roomname").focus();
		return false;
	}
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
	var  qstr ="basicdata/edit/editroom.php?id="+idroom+"&&name="+encodeURIComponent(editname)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listroom").load("basicdata/show/showroom.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("roomname").value="";
			$("#editroom").hide();
			$("#cancelroom").hide();
			$("#addroom").show();
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
	document.getElementById("roomname").value="";
}
</script>
</head>

<body>
        <center>
          <h2>          จัดการข้อมูลห้องสอบ</h2>
        </center>
  <table border="0" align="center">
            <tr>
              <td align="room">ชื่อห้องสอบ :</td>
              <td align="left"><label for="roomname"></label>
              <input type="text" name="roomname" id="roomname" /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editroom" id="editroom" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addroom" id="addroom" value="เพิ่ม" onclick="add()"/>
              <input type="button" name="roomcancle" id="roomcancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelroom" id="cancelroom" value="ยกเลิก"  onclick="cancel()"/></td>
    </tr>
  </table>
  <hr />
<br/>
<div id="listroom" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>