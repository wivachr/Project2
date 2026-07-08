<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idstatusproject;
	$(document).ready(function() {
	var popsrt = Math.random();
	$("#liststatusproject").load("basicdata/show/showstatusproject.php?pop="+popsrt);
	$("#editstatusproject").hide();
	$("#cancelstatusproject").hide();
	 });
function add()
{
	var statusprojectname = document.getElementById("statusprojectname").value;
	document.getElementById("statusprojectname").style.borderColor="";
	if(statusprojectname=="")
	{
		document.getElementById("statusprojectname").style.borderColor="#F00";
		document.getElementById("statusprojectname").focus();
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
	var  qstr ="basicdata/add/addstatusproject.php?pop="+str;
	qstr += "&&statusprojectname="+encodeURIComponent(statusprojectname);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#liststatusproject").load("basicdata/show/showstatusproject.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("statusprojectname").value="";
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
	document.getElementById("statusprojectname").style.borderColor="";
	document.getElementById("statusprojectname").value="";
	$("#editstatusproject").hide();
	$("#cancelstatusproject").hide();
	$("#addstatusproject").show();
}
function del(idstatusproject)
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
	var  qstr ="basicdata/del/delstatusproject.php?id="+idstatusproject+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#liststatusproject").load("basicdata/show/showstatusproject.php?pop="+popsrt);
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
	document.getElementById("statusprojectname").style.borderColor="";
	idstatusproject = id;
	document.getElementById("statusprojectname").value = name;
	$("#editstatusproject").show();
	$("#cancelstatusproject").show();
	$("#addstatusproject").hide();
}
function edit()
{
	var editname = document.getElementById("statusprojectname").value;
	document.getElementById("statusprojectname").style.borderColor="";
	if(editname=="")
	{
		document.getElementById("statusprojectname").style.borderColor="#F00";
		document.getElementById("statusprojectname").focus();
		return false;
	}
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
	var  qstr ="basicdata/edit/editstatusproject.php?id="+idstatusproject+"&&name="+encodeURIComponent(editname)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#liststatusproject").load("basicdata/show/showstatusproject.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("statusprojectname").value="";
			$("#editstatusproject").hide();
			$("#cancelstatusproject").hide();
			$("#addstatusproject").show();
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
	document.getElementById("statusprojectname").value="";
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลสถานะโครงงาน</h2>
        </center>
  <table border="0" align="center">
            <tr>
              <td align="statusproject">ชื่อสถานะโครงงาน :</td>
              <td align="left"><label for="statusprojectname"></label>
              <input type="text" name="statusprojectname" id="statusprojectname" /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editstatusproject" id="editstatusproject" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addstatusproject" id="addstatusproject" value="เพิ่ม" onclick="add()"/>
              <input type="button" name="statusprojectcancle" id="statusprojectcancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelstatusproject" id="cancelstatusproject" value="ยกเลิก"  onclick="cancel()"/></td>
    </tr>
  </table>
  <hr />
<br/>
<div id="liststatusproject" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>