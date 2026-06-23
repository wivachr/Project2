<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
var idtypestudent;
	$(document).ready(function() {
	var popsrt = Math.random();
	$("#listtypestudent").load("basicdata/show/showtypestudent.php?pop="+popsrt);
	$("#edittypestudent").hide();
	$("#canceltypestudent").hide();
	 });
function add()
{
	var typestudentid = document.getElementById("typestudentid").value;
	var typestudentname = document.getElementById("typestudentname").value;
	document.getElementById("typestudentname").style.borderColor="";
	if(typestudentname=="")
	{
		document.getElementById("typestudentname").style.borderColor="#F00";
		document.getElementById("typestudentname").focus();
		return false;
	}
	else if(typestudentid=="")
	{
		document.getElementById("typestudentid").style.borderColor="#F00";
		document.getElementById("typestudentid").focus();
		return false;
	}
	<?
	include('../connectdatabase.php');
	$sql = "select id_curr from curriculum";
	$result = mysqli_query($connect, $sql);
	$mdfive = md5($password);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		if(typestudentid=="<?=$rs[0]?>")
		{
			alert("รหัสหลักสูตรนี้มีในระบบแล้ว");		
			document.getElementById("typestudentid").style.borderColor="#F00";
			document.getElementById("typestudentid").style.borderColor="#F00";
			document.getElementById("typestudentid").focus();
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
	var  qstr ="basicdata/add/addtypestudent.php?pop="+str;
	qstr += "&&typestudentname="+encodeURIComponent(typestudentname);
	qstr += "&&id="+encodeURIComponent(typestudentid);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listtypestudent").load("basicdata/show/showtypestudent.php?pop="+popsrt);
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
	document.getElementById("typestudentid").style.borderColor="";
	document.getElementById("typestudentname").style.borderColor="";
	document.getElementById("typestudentname").value="";
	document.getElementById("typestudentid").value = "";
	document.getElementById("typestudentid").disabled = false;
	$("#edittypestudent").hide();
	$("#canceltypestudent").hide();
	$("#addtypestudent").show();
}
function del(idtypestudent)
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
	var  qstr ="basicdata/del/deltypestudent.php?id="+idtypestudent+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listtypestudent").load("basicdata/show/showtypestudent.php?pop="+popsrt);
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
	document.getElementById("typestudentname").style.borderColor="";
	idtypestudent = id;
	document.getElementById("typestudentid").value = id;
	document.getElementById("typestudentname").value = name;
	document.getElementById("typestudentid").disabled = true;
	$("#edittypestudent").show();
	$("#canceltypestudent").show();
	$("#addtypestudent").hide();
}
function edit()
{
	var typestudentid = document.getElementById("typestudentid").value;
	var editname = document.getElementById("typestudentname").value;
	var req;
	document.getElementById("typestudentname").style.borderColor="";
	if(editname=="")
	{
		document.getElementById("typestudentname").style.borderColor="#F00";
		document.getElementById("typestudentname").focus();
		return false;
	}
	else if(typestudentid=="")
	{
		document.getElementById("typestudentid").style.borderColor="#F00";
		document.getElementById("typestudentid").focus();
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
	var  qstr ="basicdata/edit/edittypestudent.php?id="+idtypestudent+"&&editid="+encodeURIComponent(typestudentid)+"&&name="+encodeURIComponent(editname)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listtypestudent").load("basicdata/show/showtypestudent.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			document.getElementById("typestudentid").disabled = false;
			$("#edittypestudent").hide();
			$("#canceltypestudent").hide();
			$("#addtypestudent").show();
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
	document.getElementById("typestudentname").value="";
	document.getElementById("typestudentid").value="";
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลหลักสูตร</h2>
        </center>
  <table border="0" align="center">
             <tr>
              <td align="typestudent">รหัสหลักสูตร :</td>
              <td align="left"><label for="typestudentid"></label>
              <input type="text" name="typestudentid" id="typestudentid" /></td>
            </tr>
            <tr>
              <td align="typestudent">ชื่อหลักสูตร :</td>
              <td align="left"><label for="typestudentname"></label>
              <input type="text" name="typestudentname" id="typestudentname" /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="edittypestudent" id="edittypestudent" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addtypestudent" id="addtypestudent" value="เพิ่ม" onclick="add()"/>
              <input type="button" name="typestudentcancle" id="typestudentcancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="canceltypestudent" id="canceltypestudent" value="ยกเลิก"  onclick="cancel()"/></td>
    </tr>
  </table>
  <hr />
<br/>
<div id="listtypestudent" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>