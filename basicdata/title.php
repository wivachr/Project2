<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idtitle;
	$(document).ready(function() {
	var popsrt = Math.random();
	$("#listtitle").load("basicdata/show/showtitle.php?pop="+popsrt);
	$("#editbutton").hide();
	$("#cancelbutton").hide();
	 });
function add()
{
	var titlename = document.getElementById("titlename").value;
	var idtitle2 = document.getElementById("idtitle2").value;
	document.getElementById("titlename").style.borderColor="";
	document.getElementById("idtitle2").style.borderColor="";
	if(idtitle2=="")
	{
		document.getElementById("idtitle2").style.borderColor="#F00";
		document.getElementById("idtitle2").focus();
		return false;
	}
	if(titlename=="")
	{
		document.getElementById("titlename").style.borderColor="#F00";
		document.getElementById("titlename").focus();
		return false;
	}
	<?
	include('../connectdatabase.php');
	$sql = "select id_title from title";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		if(idtitle2=="<?=$rs[0]?>")
		{
			alert("รหัสภาควิชานี้มีในระบบแล้ว");		
			document.getElementById("idtitle2").style.borderColor="#F00";
			document.getElementById("idtitle2").style.borderColor="#F00";
			document.getElementById("idtitle2").focus();
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
	var  qstr ="basicdata/add/addtitle.php?pop="+str;
	qstr += "&&titlename="+encodeURIComponent(titlename);
	qstr += "&&idtitle2="+encodeURIComponent(idtitle2);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listtitle").load("basicdata/show/showtitle.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("titlename").value="";
			document.getElementById("idtitle2").value="";
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
	document.getElementById("titlename").value="";
	document.getElementById("idtitle2").value="";
}
function cancel()
{
	document.getElementById("titlename").style.borderColor="";
	document.getElementById("idtitle2").style.borderColor="";
	document.getElementById("titlename").value="";
	document.getElementById("idtitle2").value="";
	document.getElementById("idtitle2").disabled = false;
	$("#editbutton").hide();
	$("#cancelbutton").hide();
	$("#add").show();
}
function del(idtitle)
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
	var  qstr ="basicdata/del/deltitle.php?id="+idtitle+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
				var popsrt = Math.random();
	$("#listtitle").load("basicdata/show/showtitle.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
			document.getElementById("idtitle2").disabled = false;
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
	document.getElementById("titlename").style.borderColor="";
	document.getElementById("idtitle2").style.borderColor="";
	idtitle = id;
	document.getElementById("idtitle2").value = id;
	document.getElementById("titlename").value = name;
	document.getElementById("idtitle2").disabled = true;
	$("#editbutton").show();
	$("#cancelbutton").show();
	$("#add").hide();
}
function edit()
{
	var editname = document.getElementById("titlename").value;
	var idtitle2 = document.getElementById("idtitle2").value;
	document.getElementById("titlename").style.borderColor="";
	document.getElementById("idtitle2").style.borderColor="";
	if(idtitle2=="")
	{
		document.getElementById("idtitle2").style.borderColor="#F00";
		document.getElementById("idtitle2").focus();
		return false;
	}
	if(editname=="")
	{
		document.getElementById("titlename").style.borderColor="#F00";
		document.getElementById("titlename").focus();
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
	var  qstr ="basicdata/edit/edittitle.php?id="+idtitle+"&&name="+encodeURIComponent(editname)+"&&idtitle2="+encodeURIComponent(idtitle2)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listtitle").load("basicdata/show/showtitle.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("titlename").value="";
			document.getElementById("idtitle2").value="";
			document.getElementById("idtitle2").disabled = false;
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
          จัดการข้อมูลคำนำหน้าชื่อ</h2>
        </center>

                <table border="0" align="center">
            <tr>
              <td align="right">รหัสคำนำหน้าชื่อ :</td>
              <td align="left">
                <input name="idtitle2" type="text" id="idtitle2" size="5" /></td>
  </tr>
            <tr>
              <td align="right">คำนำหน้าชื่อ :</td>
              <td align="left"><label for="titlename"></label>
                <input type="text" name="titlename" id="titlename" /></td>
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
  <div id="listtitle" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>