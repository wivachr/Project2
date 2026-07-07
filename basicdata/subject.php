<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idsubject;
	$(document).ready(function() {
	var popsrt = Math.random();
$("#listsubject").load("basicdata/show/showsubject.php?pop="+popsrt);
	$("#editsubject").hide();
	$("#cancelsubject").hide();
	 });
function add()
{
	var subjectname = document.getElementById("subjectname").value;
	var credits = document.getElementById("credits").value;
	var idsubject = document.getElementById("idsubject").value;
	document.getElementById("subjectname").style.borderColor="";
	document.getElementById("credits").style.borderColor="";
	document.getElementById("idsubject").style.borderColor="";
	if(subjectname=="")
	{
		document.getElementById("subjectname").style.borderColor="#F00";
		document.getElementById("subjectname").focus();
		return false;
	}
	else if(credits=="0")
	{
		document.getElementById("credits").style.borderColor="#F00";
		document.getElementById("credits").focus();
		return false;
	}
	else if(idsubject=="")
	{
		document.getElementById("idsubject").style.borderColor="#F00";
		document.getElementById("idsubject").focus();
		return false;
	}
		<?
	include('../connectdatabase.php');
	$sql = "select id_subject from subject";
	$result = mysqli_query($connect, $sql);
	$mdfive = md5($password);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		if(idsubject=="<?=$rs[0]?>")
		{
			alert("รหัสวิชานี้มีในระบบแล้ว");		
			document.getElementById("idsubject").style.borderColor="#F00";
			document.getElementById("idsubject").style.borderColor="#F00";
			document.getElementById("idsubject").focus();
			return false;
		}
		<?
	}
	?>
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
	var  qstr ="basicdata/add/addsubject.php?pop="+str;
	qstr += "&&subjectname="+encodeURIComponent(subjectname);
	qstr += "&&credits="+credits;
	qstr += "&&idsubject="+idsubject;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listsubject").load("basicdata/show/showsubject.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
			cleardata();
   			resultarea.innerHTML = req.responseText;
			document.getElementById("subjectname").value="";
			document.getElementById("credits").value=0;
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
	document.getElementById("subjectname").style.borderColor="";
	document.getElementById("credits").style.borderColor="";
	document.getElementById("subjectname").value="";
	document.getElementById("credits").value=0;
	document.getElementById("idsubject").disabled = false;
	cleardata();
	$("#editsubject").hide();
	$("#cancelsubject").hide();
	$("#addsubject").show();
}
function del(idsubject)
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
	var  qstr ="basicdata/del/delsubject.php?id="+idsubject+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listsubject").load("basicdata/show/showsubject.php?pop="+popsrt);
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
function showedit(id,name,sname)
{
	document.getElementById("subjectname").style.borderColor="";
	document.getElementById("credits").style.borderColor="";
	idsubject = id;
	document.getElementById("idsubject").value = idsubject;
	document.getElementById("subjectname").value = name;
	document.getElementById("credits").value = sname;
	document.getElementById("idsubject").disabled = true;
	$("#editsubject").show();
	$("#cancelsubject").show();
	$("#addsubject").hide();
}
function edit()
{
	var editname = document.getElementById("subjectname").value;
	var credits = document.getElementById("credits").value;
	var editidsubject = document.getElementById("idsubject").value;
	document.getElementById("subjectname").style.borderColor="";
	document.getElementById("credits").style.borderColor="";
	if(editname=="")
	{
		document.getElementById("subjectname").style.borderColor="#F00";
		document.getElementById("subjectname").focus();
		return false;
	}
	else if(credits=="0")
	{
		document.getElementById("credits").style.borderColor="#F00";
		document.getElementById("credits").focus();
		return false;
	}
	else if(editidsubject=="")
	{
		document.getElementById("idsubject").style.borderColor="#F00";
		document.getElementById("idsubject").focus();
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
	var  qstr ="basicdata/edit/editsubject.php?id="+idsubject+"&&name="+encodeURIComponent(editname)+"&&credits="+credits+"&&pop="+str+"&&idedit="+editidsubject;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listsubject").load("basicdata/show/showsubject.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			document.getElementById("idsubject").disabled = false;
			document.getElementById("subjectname").value="";
			document.getElementById("idsubject").value="";
			document.getElementById("credits").value=0;
			$("#editsubject").hide();
			$("#cancelsubject").hide();
			$("#addsubject").show();
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
	document.getElementById("idsubject").value="";
	document.getElementById("subjectname").value="";
	document.getElementById("credits").value=0;
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลวิชา</h2>
        </center>
  <table border="0" align="center">
              <tr>
              <td align="right">รหัสวิชา :</td>
              <td align="left">
              <input type="text" name="idsubject" id="idsubject" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อวิชา :</td>
              <td align="left"><label for="subjectname"></label>
              <input type="text" name="subjectname" id="subjectname" /></td>
            </tr>
            <tr>
              <td align="right">หน่วยกิต :</td>
              <td align="left"><label for="credits"></label>
                <select name="credits" id="credits">
                  <option value="0">---เลือกหน่วยกิต---</option>
                  <option value="1">1</option>
                  <option value="3">3</option>
              </select></td>
    </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editsubject" id="editsubject" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addsubject" id="addsubject" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="subjectcancle" id="subjectcancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelsubject" id="cancelsubject" value="ยกเลิก"  onclick="cancel()"/></td>
            </tr>
            <tr>
              <td colspan="2" align="center">&nbsp;</td>
            </tr>
  </table>
  <hr />
<br/>
<div id="listsubject" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>