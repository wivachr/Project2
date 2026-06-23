<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
var idtypeexam;
	$(document).ready(function() {
	var popsrt = Math.random();
$("#listtypeexam").load("basicdata/show/showtypeexam.php?pop="+popsrt);
	$("#edittypeexam").hide();
	$("#canceltypeexam").hide();
	 });
function add()
{
	var typeexamname = document.getElementById("typeexamname").value;
	document.getElementById("typeexamname").style.borderColor="";
	if(typeexamname=="")
	{
		document.getElementById("typeexamname").style.borderColor="#F00";
		document.getElementById("typeexamname").focus();
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
	var  qstr ="basicdata/add/addtypeexam.php?pop="+str;
	qstr += "&&typeexamname="+encodeURIComponent(typeexamname);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listtypeexam").load("basicdata/show/showtypeexam.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("typeexamname").value="";
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
	document.getElementById("typeexamname").style.borderColor="";
	document.getElementById("typeexamname").value="";
	$("#edittypeexam").hide();
	$("#canceltypeexam").hide();
	$("#addtypeexam").show();
}
function del(idtypeexam)
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
	var  qstr ="basicdata/del/deltypeexam.php?id="+idtypeexam+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listtypeexam").load("basicdata/show/showtypeexam.php?pop="+popsrt);
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
	document.getElementById("typeexamname").style.borderColor="";
	idtypeexam = id;
	document.getElementById("typeexamname").value = name;
	$("#edittypeexam").show();
	$("#canceltypeexam").show();
	$("#addtypeexam").hide();
}
function edit()
{
	var editname = document.getElementById("typeexamname").value;
	document.getElementById("typeexamname").style.borderColor="";
	if(editname=="")
	{
		document.getElementById("typeexamname").style.borderColor="#F00";
		document.getElementById("typeexamname").focus();
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
	var  qstr ="basicdata/edit/edittypeexam.php?id="+idtypeexam+"&&name="+encodeURIComponent(editname)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listtypeexam").load("basicdata/show/showtypeexam.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("typeexamname").value="";
			$("#edittypeexam").hide();
			$("#canceltypeexam").hide();
			$("#addtypeexam").show();
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
	document.getElementById("typeexamname").value="";
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลประเภทการสอบ</h2>
        </center>
  <table border="0" align="center">
            <tr>
              <td align="typeexam">ชื่อประเภทการสอบ :</td>
              <td align="left"><label for="typeexamname"></label>
              <input type="text" name="typeexamname" id="typeexamname" /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="edittypeexam" id="edittypeexam" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addtypeexam" id="addtypeexam" value="เพิ่ม" onclick="add()"/>
              <input type="button" name="typeexamcancle" id="typeexamcancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="canceltypeexam" id="canceltypeexam" value="ยกเลิก"  onclick="cancel()"/></td>
    </tr>
  </table>
  <hr />
<br/>
<div id="listtypeexam" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>