<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
var iddepartment;
	$(document).ready(function() {
	var popsrt = Math.random();
$("#listdepartment").load("basicdata/show/showdepartment.php?pop="+popsrt);
	$("#editdepartment").hide();
	$("#canceldepartment").hide();
	 });
function add()
{
	var iddept2 = document.getElementById("iddept2").value;
	var departmentname = document.getElementById("departmentname").value;
	var departmentsname = document.getElementById("departmentsname").value;
	var facultyid = document.getElementById("facultyid").value;
	document.getElementById("departmentname").style.borderColor="";
	document.getElementById("departmentsname").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("iddept2").style.borderColor="";
	if(iddept2=="")
	{
		document.getElementById("iddept2").style.borderColor="#F00";
		document.getElementById("iddept2").focus();
		return false;
	}
	if(departmentname=="")
	{
		document.getElementById("departmentname").style.borderColor="#F00";
		document.getElementById("departmentname").focus();
		return false;
	}
	else if(departmentsname=="")
	{
		document.getElementById("departmentsname").style.borderColor="#F00";
		document.getElementById("departmentsname").focus();
		return false;
	}
	else if(facultyid==0)
	{
		document.getElementById("facultyid").style.borderColor="#F00";
		document.getElementById("facultyid").focus();
		return false;
	}
	<?
	include('../connectdatabase.php');
	$sql = "select id_department from department";
	$result = mysqli_query($connect, $sql);
	$mdfive = md5($password);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		if(iddept2=="<?=$rs[0]?>")
		{
			alert("รหัสภาควิชานี้มีในระบบแล้ว");		
			document.getElementById("iddept2").style.borderColor="#F00";
			document.getElementById("iddept2").style.borderColor="#F00";
			document.getElementById("iddept2").focus();
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
	var  qstr ="basicdata/add/adddepartment.php?pop="+str;
	qstr += "&&iddept2="+encodeURIComponent(iddept2);
	qstr += "&&departmentname="+encodeURIComponent(departmentname);
	qstr += "&&departmentsname="+encodeURIComponent(departmentsname);
	qstr += "&&facultyid="+facultyid;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listdepartment").load("basicdata/show/showdepartment.php?pop="+popsrt);
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
	document.getElementById("departmentname").style.borderColor="";
	document.getElementById("departmentsname").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("iddept2").style.borderColor="";
	cleardata();
	document.getElementById("iddept2").disabled = false;
	$("#editdepartment").hide();
	$("#canceldepartment").hide();
	$("#adddepartment").show();
}
function del(iddepartment)
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
	var  qstr ="basicdata/del/deldepartment.php?id="+iddepartment+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listdepartment").load("basicdata/show/showdepartment.php?pop="+popsrt);
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
function showedit(id,name,sname,idfaculty)
{
	document.getElementById("departmentname").style.borderColor="";
	document.getElementById("departmentsname").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("iddept2").style.borderColor="";
	iddepartment = id;
	document.getElementById("iddept2").value = id;
	document.getElementById("departmentname").value = name;
	document.getElementById("departmentsname").value = sname;
	document.getElementById("facultyid").value = idfaculty;
	document.getElementById("iddept2").disabled = true;
	$("#editdepartment").show();
	$("#canceldepartment").show();
	$("#adddepartment").hide();
}
function edit()
{
	var iddept2 = document.getElementById("iddept2").value;
	var editname = document.getElementById("departmentname").value;
	var editsname = document.getElementById("departmentsname").value;
	var facultyid = document.getElementById("facultyid").value;
	document.getElementById("departmentname").style.borderColor="";
	document.getElementById("departmentsname").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	if(iddept2=="")
	{
		document.getElementById("iddept2").style.borderColor="#F00";
		document.getElementById("iddept2").focus();
		return false;
	}
	if(editname=="")
	{
		document.getElementById("departmentname").style.borderColor="#F00";
		document.getElementById("departmentname").focus();
		return false;
	}
	else if(editsname=="")
	{
		document.getElementById("departmentsname").style.borderColor="#F00";
		document.getElementById("departmentsname").focus();
		return false;
	}
	else if(facultyid==0)
	{
		document.getElementById("facultyid").style.borderColor="#F00";
		document.getElementById("facultyid").focus();
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
	var  qstr ="basicdata/edit/editdepartment.php?id="+iddepartment+"&&iddept2="+encodeURIComponent(iddept2)+"&&name="+encodeURIComponent(editname)+"&&facultyid="+facultyid+"&&sname="+encodeURIComponent(editsname)+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listdepartment").load("basicdata/show/showdepartment.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			document.getElementById("iddept2").disabled = false;
			$("#editdepartment").hide();
			$("#canceldepartment").hide();
			$("#adddepartment").show();
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
	document.getElementById("departmentname").value="";
	document.getElementById("iddept2").value="";
	document.getElementById("departmentsname").value="";
	document.getElementById("facultyid").value=0;
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลภาควิชา</h2>
        </center>
  <table border="0" align="center">
              <tr>
              <td align="right">รหัสภาควิชา :</td>
              <td align="left"><label for="iddept2"></label>
              <input name="iddept2" type="text" id="iddept2" size="5" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อภาควิชา :</td>
              <td align="left"><label for="departmentname"></label>
              <input type="text" name="departmentname" id="departmentname" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อย่อภาควิชา :</td>
              <td align="left"><label for="departmentsname">
                <input type="text" name="departmentsname" id="departmentsname" />
              </label></td>
    </tr>
            <tr>
              <td align="right">คณะ :</td>
              <td align="left"><select name="facultyid" id="facultyid">
              <option value="0">---เลือกคณะ---</option>
              <? include('../connectdatabase.php'); 
			  $sql = "select * from faculty";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                    <option value="<?=$rs[0]?>"><?=$rs[1]?></option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
              </select></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editdepartment" id="editdepartment" value="บันทึก" onclick="edit()"/>
                <input type="button" name="adddepartment" id="adddepartment" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="departmentcancle" id="departmentcancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="canceldepartment" id="canceldepartment" value="ยกเลิก"  onclick="cancel()"/></td>
            </tr>
  </table>
  <hr />
<br/>
<div id="listdepartment" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>