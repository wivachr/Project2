<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idfaculty;
	$(document).ready(function() {
	var popsrt = Math.random();
$("#listfaculty").load("basicdata/show/showfaculty.php?pop="+popsrt);
	$("#editfaculty").hide();
	$("#cancelfaculty").hide();
	 });
function add()
{
	var idfac2 = document.getElementById("idfac2").value;
	var facultyname = document.getElementById("facultyname").value;
	var facultysname = document.getElementById("facultysname").value;
	document.getElementById("facultyname").style.borderColor="";
	document.getElementById("facultysname").style.borderColor="";
		if(idfac2=="")
	{
		document.getElementById("idfac2").style.borderColor="#F00";
		document.getElementById("idfac2").focus();
		return false;
	}
	if(facultyname=="")
	{
		document.getElementById("facultyname").style.borderColor="#F00";
		document.getElementById("facultyname").focus();
		return false;
	}
	else if(facultysname=="")
	{
		document.getElementById("facultysname").style.borderColor="#F00";
		document.getElementById("facultysname").focus();
		return false;
	}
	<?
	include('../connectdatabase.php');
	$sql = "select id_faculty from faculty";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		if(idfac2=="<?=$rs[0]?>")
		{
			alert("รหัสคณะนี้มีในระบบแล้ว");		
			document.getElementById("idfac2").style.borderColor="#F00";
			document.getElementById("idfac2").style.borderColor="#F00";
			document.getElementById("idfac2").focus();
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
	var  qstr ="basicdata/add/addfaculty.php?pop="+str;
	qstr += "&&facultyname="+encodeURIComponent(facultyname);
	qstr += "&&facultysname="+encodeURIComponent(facultysname);
	qstr += "&&idfac2="+encodeURIComponent(idfac2);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listfaculty").load("basicdata/show/showfaculty.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("facultyname").value="";
			document.getElementById("idfac2").value="";
			document.getElementById("facultysname").value="";
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
	document.getElementById("facultyname").style.borderColor="";
	document.getElementById("facultysname").style.borderColor="";
	document.getElementById("idfac2").style.borderColor="";
	document.getElementById("facultyname").value="";
	document.getElementById("facultysname").value="";
	document.getElementById("idfac2").value="";
	document.getElementById("idfac2").disabled = false;
	$("#editfaculty").hide();
	$("#cancelfaculty").hide();
	$("#addfaculty").show();
}
function del(idfaculty)
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
	var  qstr ="basicdata/del/delfaculty.php?id="+idfaculty+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listfaculty").load("basicdata/show/showfaculty.php?pop="+popsrt);
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
	document.getElementById("facultyname").style.borderColor="";
	document.getElementById("facultysname").style.borderColor="";
	document.getElementById("idfac2").style.borderColor="";
	idfaculty = id;
	document.getElementById("facultyname").value = name;
	document.getElementById("facultysname").value = sname;
	document.getElementById("idfac2").value = id;
	document.getElementById("idfac2").disabled = true;
	$("#editfaculty").show();
	$("#cancelfaculty").show();
	$("#addfaculty").hide();
}
function edit()
{
	var editname = document.getElementById("facultyname").value;
	var editsname = document.getElementById("facultysname").value;
	var idfac2 = document.getElementById("idfac2").value;
	document.getElementById("facultyname").style.borderColor="";
	document.getElementById("facultysname").style.borderColor="";
	document.getElementById("idfac2").style.borderColor="";
	if(idfac2=="")
	{
		document.getElementById("idfac2").style.borderColor="#F00";
		document.getElementById("idfac2").focus();
		return false;
	}
	if(editname=="")
	{
		document.getElementById("facultyname").style.borderColor="#F00";
		document.getElementById("facultyname").focus();
		return false;
	}
	else if(editsname=="")
	{
		document.getElementById("facultysname").style.borderColor="#F00";
		document.getElementById("facultysname").focus();
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
	var  qstr ="basicdata/edit/editfaculty.php?id="+idfaculty+"&&idfac2="+encodeURIComponent(idfac2)+"&&name="+encodeURIComponent(editname)+"&&sname="+encodeURIComponent(editsname)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listfaculty").load("basicdata/show/showfaculty.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("facultyname").value="";
			document.getElementById("facultysname").value="";
			document.getElementById("idfac2").value="";
			$("#editfaculty").hide();
			$("#cancelfaculty").hide();
			$("#addfaculty").show();
			document.getElementById("idfac2").disabled = false;
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
	document.getElementById("idfac2").value="";
	document.getElementById("facultyname").value="";
	document.getElementById("facultysname").value="";
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลคณะ</h2>
        </center>
  <table border="0" align="center">
              <tr>
              <td align="right">รหัสคณะ :</td>
              <td align="left"><label for="idfac2"></label>
              <input name="idfac2" type="text" id="idfac2" size="5" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อคณะ :</td>
              <td align="left"><label for="facultyname"></label>
              <input type="text" name="facultyname" id="facultyname" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อย่อคณะ :</td>
              <td align="center"><input type="text" name="facultysname" id="facultysname" /></td>
    </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editfaculty" id="editfaculty" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addfaculty" id="addfaculty" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="facultycancle" id="facultycancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelfaculty" id="cancelfaculty" value="ยกเลิก"  onclick="cancel()"/></td>
            </tr>
  </table>
  <hr />
<br/>
<div id="listfaculty" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>