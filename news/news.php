<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
var idnews;
	$(document).ready(function() {
	$("#editnews").hide();
	$("#cancelnews").hide();
	if ($("#showmanage").length === 0) {
		var popsrt = Math.random();
		$("#listnews").load("news/shownews.php?pop="+popsrt);
	}
	 });
function add()
{
	var topicnews = document.getElementById("topicnews").value;
	var detailnews = document.getElementById("detailnews").value;
	document.getElementById("topicnews").style.borderColor="";
	document.getElementById("detailnews").style.borderColor="";

	if(topicnews=="")
	{
		document.getElementById("topicnews").style.borderColor="#F00";
		document.getElementById("topicnews").focus();
		return false;
	}
	else if(detailnews=="")
	{
		document.getElementById("detailnews").style.borderColor="#F00";
		document.getElementById("detailnews").focus();
		return false;
	}
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
	var  qstr ="news/addnews.php?pop="+str;
	qstr += "&&topicnews="+encodeURIComponent(topicnews);
	qstr += "&&detailnews="+detailnews;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listnews").load("news/shownews.php?pop="+popsrt);
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
	cleardata();
	$("#editnews").hide();
	$("#cancelnews").hide();
	$("#addnews").show();
}
function del(id)
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
	var  qstr ="news/delnews.php?&&pop="+str;
	qstr += "&&id="+encodeURIComponent(id);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listnews").load("news/shownews.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editnews").hide();
			$("#cancelnews").hide();
			$("#addnews").show();
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
function showedit(id,topic,detail)
{
	idnews = id;
	document.getElementById("topicnews").value=topic;
	document.getElementById("detailnews").value=detail;
	$("#editnews").show();
	$("#cancelnews").show();
	$("#addnews").hide();
}
function edit()
{
	var topicnews = document.getElementById("topicnews").value;
	var detailnews = document.getElementById("detailnews").value;
	document.getElementById("topicnews").style.borderColor="";
	document.getElementById("detailnews").style.borderColor="";
	if(topicnews=="")
	{
		document.getElementById("topicnews").style.borderColor="#F00";
		document.getElementById("topicnews").focus();
		return false;
	}
	else if(detailnews=="")
	{
		document.getElementById("detailnews").style.borderColor="#F00";
		document.getElementById("detailnews").focus();
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
	var  qstr ="news/editnews.php?pop="+str;
	qstr += "&&id="+encodeURIComponent(idnews);
	qstr += "&&topicnews="+encodeURIComponent(topicnews);
	qstr += "&&detailnews="+encodeURIComponent(detailnews);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listnews").load("news/shownews.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editnews").hide();
			$("#cancelnews").hide();
			$("#addnews").show();
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
	document.getElementById("topicnews").value="";
	document.getElementById("detailnews").value="";
}
</script><title></title>
</head>

<body>
  <center><h2>    จัดการข้อมูลข่าวสาร</h2>
  </center>
  <table border="0" align="center">
  <tr>
  <td align="right">หัวข้อข่าวสาร :</td>
  <td align="left"><input name="topicnews" type="text" id="topicnews" size="20" maxlength="100" /></td>
  </tr>
            <tr>
              <td align="right" valign="top">รายละเอียดข่าวสาร :</td>
              <td align="left"><label for="detailnews"></label>
              <textarea name="detailnews" id="detailnews" cols="45" rows="5"></textarea></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editnews" id="editnews" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addnews" id="addnews" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="clearnews" id="clearnews" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelnews" id="cancelnews" value="ยกเลิก" onclick="cancel()"/></td>
            </tr>
      </table>
  <hr />
<br/>
      <div id="listnews" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>