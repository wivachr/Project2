<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var oldyear;
var oldsemester;
var oldidstudent;
var oldidsubject;
var oldsection;
var keyr =""
	$(document).ready(function() {
	$("#editregister").hide();
	$("#cancelregister").hide();
	if ($("#showmanage").length === 0) {
		var popsrt = Math.random();
		$("#listregister").load("register/showregister.php?pop="+popsrt);
	}
	 });
  function cpr(l,i)
 {
	var str = Math.random();
	$("#listregister").load("register/showregister.php?pop="+str+"&&start="+l+"&&page="+i+"&&key="+encodeURIComponent(keyr));
	$("#listregister").fadeIn();
 }
 function searchexamr()
 {
	var str = Math.random();
	keyr = document.getElementById("sexam").value;
	$("#listregister").load("register/showregister.php?pop="+str+"&&key="+encodeURIComponent(document.getElementById("sexam").value));
	$("#listregister").fadeIn();
 } 
function add()
{
	var yearregis = document.getElementById("yearregis").value;
	var semesterregis = document.getElementById("semesterregis").value;
	var idsregis = document.getElementById("idsregis").value;
	var idsuregis = document.getElementById("idsuregis").value;
	var section = document.getElementById("section").value;
	document.getElementById("yearregis").style.borderColor="";
	document.getElementById("semesterregis").style.borderColor="";
	document.getElementById("idsregis").style.borderColor="";
	document.getElementById("idsuregis").style.borderColor="";
	document.getElementById("section").style.borderColor="";
	if(yearregis=="")
	{
		document.getElementById("yearregis").style.borderColor="#F00";
		document.getElementById("yearregis").focus();
		return false;
	}
	else if(semesterregis==0)
	{
		document.getElementById("semesterregis").style.borderColor="#F00";
		document.getElementById("semesterregis").focus();
		return false;
	}
	else if(idsregis=="")
	{
		document.getElementById("idsregis").style.borderColor="#F00";
		document.getElementById("idsregis").focus();
		return false;
	}
	else if(idsuregis==0)
	{
		document.getElementById("idsuregis").style.borderColor="#F00";
		document.getElementById("idsuregis").focus();
		return false;
	}
	else if(section=="")
	{
		document.getElementById("section").style.borderColor="#F00";
		document.getElementById("section").focus();
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
	var  qstr ="register/addregister.php?pop="+str;
	qstr += "&&yearregis="+encodeURIComponent(yearregis);
	qstr += "&&semesterregis="+encodeURIComponent(semesterregis);
	qstr += "&&idsregis="+encodeURIComponent(idsregis);
	qstr += "&&idsuregis="+encodeURIComponent(idsuregis);
	qstr += "&&section="+encodeURIComponent(section);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listregister").load("register/showregister.php?pop="+popsrt);
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
	$("#editregister").hide();
	$("#cancelregister").hide();
	$("#addregister").show();
}
function del(year,semester,idstudent,idsubject,section)
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
	var  qstr ="register/delregister.php?&&pop="+str;
	qstr += "&&yearregis="+encodeURIComponent(year);
	qstr += "&&semesterregis="+encodeURIComponent(semester);
	qstr += "&&idsregis="+encodeURIComponent(idstudent);
	qstr += "&&idsuregis="+encodeURIComponent(idsubject);
	qstr += "&&section="+encodeURIComponent(section);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listregister").load("register/showregister.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editregister").hide();
			$("#cancelregister").hide();
			$("#addregister").show();
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
function showedit(year,semester,idstudent,idsubject,section)
{
	oldyear=year;
	oldsemester=semester;
	oldidstudent=idstudent;
	oldidsubject=idsubject;
	oldsection=section;
	document.getElementById("yearregis").value=year;
	document.getElementById("semesterregis").value=semester;
	document.getElementById("idsregis").value=idstudent;
	document.getElementById("idsuregis").value=idsubject;
	document.getElementById("section").value=section;
	$("#editregister").show();
	$("#cancelregister").show();
	$("#addregister").hide();
}
function edit()
{
	var y = document.getElementById("yearregis").value;
	var s = document.getElementById("semesterregis").value;
	var sid = document.getElementById("idsregis").value;
	var suid = document.getElementById("idsuregis").value;
	var sec = document.getElementById("section").value;
	document.getElementById("yearregis").style.borderColor="";
	document.getElementById("semesterregis").style.borderColor="";
	document.getElementById("idsregis").style.borderColor="";
	document.getElementById("idsuregis").style.borderColor="";
	document.getElementById("section").style.borderColor="";
	if(y=="")
	{
		document.getElementById("yearregis").style.borderColor="#F00";
		document.getElementById("yearregis").focus();
		return false;
	}
	else if(s==0)
	{
		document.getElementById("semesterregis").style.borderColor="#F00";
		document.getElementById("semesterregis").focus();
		return false;
	}
	else if(sid=="")
	{
		document.getElementById("idsregis").style.borderColor="#F00";
		document.getElementById("idsregis").focus();
		return false;
	}
	else if(suid==0)
	{
		document.getElementById("idsuregis").style.borderColor="#F00";
		document.getElementById("idsuregis").focus();
		return false;
	}
	else if(sec=="")
	{
		document.getElementById("section").style.borderColor="#F00";
		document.getElementById("section").focus();
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
	var  qstr ="register/editregister.php?pop="+str;
	qstr += "&&yearregis="+encodeURIComponent(y);
	qstr += "&&semesterregis="+encodeURIComponent(s);
	qstr += "&&idsregis="+encodeURIComponent(sid);
	qstr += "&&idsuregis="+encodeURIComponent(suid);
	qstr += "&&section="+encodeURIComponent(sec);
	qstr += "&&oldyearregis="+encodeURIComponent(oldyear);
	qstr += "&&oldsemesterregis="+encodeURIComponent(oldsemester);
	qstr += "&&oldidsregis="+encodeURIComponent(oldidstudent);
	qstr += "&&oldidsuregis="+encodeURIComponent(oldidsubject);
	qstr += "&&oldsection="+encodeURIComponent(oldsection);		
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listregister").load("register/showregister.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editregister").hide();
			$("#cancelregister").hide();
			$("#addregister").show();
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
	document.getElementById("yearregis").value="";
	document.getElementById("semesterregis").value=0;
	document.getElementById("idsregis").value="";
	document.getElementById("idsuregis").value=0;
	document.getElementById("section").value="";
}
</script><title></title>
</head>

<body>
  <center><h2>    จัดการข้อมูลลงทะเบียน</h2>
  </center>
  <table border="0" align="center">
  <tr>
  <td align="right">ปีการศึกษา :</td>
  <td align="left"><input name="yearregis" type="text" id="yearregis" size="13" maxlength="10" /></td>
  </tr>
            <tr>
              <td align="right">ภาคเรียน :</td>
              <td align="left">
                <select name="semesterregis" id="semesterregis">
                <option value="0">
                    ---เลือกภาคเรียน---
                  </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="right">รหัสนักศึกษา :</td>
              <td align="left">
              <input name="idsregis" type="text" id="idsregis" size="12" maxlength="13" /></td>
            </tr>
            <tr>
              <td align="right">วิชา :</td>
              <td align="left">
                <select name="idsuregis" id="idsuregis">
                  <option value="0">--- เลือกวิชา ---</option>
                  
                                <? include('../connectdatabase.php'); 
			  $sql = "select * from subject";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs[0]?>"><?=$rs[0]?> <?=$rs[1]?></option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
              </select></td>
            </tr>
            <tr>
              <td align="right">ตอนที่ :</td>
              <td align="left"><label for="section"></label>
              <input name="section" type="text" id="section" size="2" maxlength="2" /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editregister" id="editregister" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addregister" id="addregister" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="clearregister" id="clearregister" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelregister" id="cancelregister" value="ยกเลิก" onclick="cancel()"/></td>
            </tr>
      </table>
  <hr />
<br/>
      <div id="listregister" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>