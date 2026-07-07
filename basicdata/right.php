<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idright;
	$(document).ready(function() {
	var popsrt = Math.random();
$("#listright").load("basicdata/show/showright.php?pop="+popsrt);
	$("#editright").hide();
	$("#cancelright").hide();
	 });
function add()
{
	var titlename = document.getElementById("rightname").value;
	document.getElementById("rightname").style.borderColor="";
	if(titlename=="")
	{
		document.getElementById("rightname").style.borderColor="#F00";
		document.getElementById("rightname").focus();
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
	var  qstr ="basicdata/add/addright.php?pop="+str;
	qstr += "&&rightname="+encodeURIComponent(titlename);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listright").load("basicdata/show/showright.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("rightname").value="";
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
	document.getElementById("rightname").style.borderColor="";
	document.getElementById("rightname").value="";
	$("#editright").hide();
	$("#cancelright").hide();
	$("#addright").show();
}
function del(idright)
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
	var  qstr ="basicdata/del/delright.php?id="+idright+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listright").load("basicdata/show/showright.php?pop="+popsrt);
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
	document.getElementById("rightname").style.borderColor="";
	idright = id;
	document.getElementById("rightname").value = name;
	$("#editright").show();
	$("#cancelright").show();
	$("#addright").hide();
}
function edit()
{
	var editname = document.getElementById("rightname").value;
	document.getElementById("rightname").style.borderColor="";
	if(editname=="")
	{
		document.getElementById("rightname").style.borderColor="#F00";
		document.getElementById("rightname").focus();
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
	var  qstr ="basicdata/edit/editright.php?id="+idright+"&&name="+encodeURIComponent(editname)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listright").load("basicdata/show/showright.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("rightname").value="";
			$("#editright").hide();
			$("#cancelright").hide();
			$("#addright").show();
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
	document.getElementById("rightname").value="";
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลสิทธิ์</h2>
        </center>
  <table border="0" align="center">
            <tr>
              <td align="right">ชื่อสิทธิ์ :</td>
              <td align="left"><label for="rightname"></label>
              <input type="text" name="rightname" id="rightname" /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editright" id="editright" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addright" id="addright" value="เพิ่ม" onclick="add()"/>
              <input type="button" name="rightcancle" id="rightcancle" value="ล้าง"  onclick="cleardata()"/>
              <input type="button" name="cancelright" id="cancelright" value="ยกเลิก"  onclick="cancel()"/></td>
    </tr>
  </table>
  <hr />
<br/>
<div id="listright" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>