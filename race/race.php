<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
var idrace;
	$(document).ready(function() {
	$("#editrace").hide();
	$("#cancelrace").hide();
	if ($("#showmanage").length === 0) {
		var popsrt = Math.random();
		$("#listrace").load("race/showrace.php?pop="+popsrt);
	}
	 });
function add()
{
	var topicrace = document.getElementById("topicrace").value;
	var detailrace = document.getElementById("detailrace").value;
	var statusrace = document.getElementById("statusrace").value;
	document.getElementById("topicrace").style.borderColor="";
	document.getElementById("detailrace").style.borderColor="";
	document.getElementById("statusrace").style.borderColor="";
	
	if(topicrace=="")
	{
		document.getElementById("topicrace").style.borderColor="#F00";
		document.getElementById("topicrace").focus();
		return false;
	}
	else if(detailrace=="")
	{
		document.getElementById("detailrace").style.borderColor="#F00";
		document.getElementById("detailrace").focus();
		return false;
	}
	else if(statusrace=="")
	{
		document.getElementById("statusrace").style.borderColor="#F00";
		document.getElementById("statusrace").focus();
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
	var  qstr ="race/addrace.php?pop="+str;
	qstr += "&&topicrace="+encodeURIComponent(topicrace);
	qstr += "&&detailrace="+encodeURIComponent(detailrace);
	qstr += "&&statusrace="+encodeURIComponent(statusrace);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listrace").load("race/showrace.php?pop="+popsrt);
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
	$("#editrace").hide();
	$("#cancelrace").hide();
	$("#addrace").show();
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
	var  qstr ="race/delrace.php?&&pop="+str;
	qstr += "&&id="+encodeURIComponent(id);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listrace").load("race/showrace.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editrace").hide();
			$("#cancelrace").hide();
			$("#addrace").show();
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
function showedit(id,topic,detail,status)
{
	idrace = id;
	document.getElementById("topicrace").value=topic;
	document.getElementById("detailrace").value=detail;
	document.getElementById("statusrace").value=status;
	$("#editrace").show();
	$("#cancelrace").show();
	$("#addrace").hide();
}
function edit()
{
	var topicrace = document.getElementById("topicrace").value;
	var detailrace = document.getElementById("detailrace").value;
	var statusrace = document.getElementById("statusrace").value;
	document.getElementById("topicrace").style.borderColor="";
	document.getElementById("detailrace").style.borderColor="";
	document.getElementById("statusrace").style.borderColor="";
	if(topicrace=="")
	{
		document.getElementById("topicrace").style.borderColor="#F00";
		document.getElementById("topicrace").focus();
		return false;
	}
	else if(detailrace=="")
	{
		document.getElementById("detailrace").style.borderColor="#F00";
		document.getElementById("detailrace").focus();
		return false;
	}
		else if(statusrace=="")
	{
		document.getElementById("statusrace").style.borderColor="#F00";
		document.getElementById("statusrace").focus();
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
	var  qstr ="race/editrace.php?pop="+str;
	qstr += "&&id="+encodeURIComponent(idrace);
	qstr += "&&topicrace="+encodeURIComponent(topicrace);
	qstr += "&&detailrace="+encodeURIComponent(detailrace);
	qstr += "&&statusrace="+encodeURIComponent(statusrace);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listrace").load("race/showrace.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editrace").hide();
			$("#cancelrace").hide();
			$("#addrace").show();
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
	document.getElementById("statusrace").value="";
	document.getElementById("topicrace").value="";
	document.getElementById("detailrace").value="";
	document.getElementById('presult').innerHTML = "";
}
function checkproject()
{
		<?
		include('../connectdatabase.php');
		$result = mysqli_query($connect, "select id_project,name_project from project");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[0]?>==document.getElementById("topicrace").value)
			{
					document.getElementById('presult').innerHTML = <?=json_encode("ชื่อโครงงาน : ".(string)$rs[1]);?>;
					return true;
			}
			<?
			}
		}
		mysqli_close($connect);
	?>
	document.getElementById('presult').innerHTML = "";
	document.getElementById("topicrace").value = "";
}
</script><title></title>
</head>

<body>
  <center><h2>    จัดการข้อมูลการเข้าแข่งขัน</h2>
  </center>
  <table border="0" align="center">
  <tr>
  <td align="right">รหัสโครงงานพิเศษที่เข้าร่วม :</td>
  <td align="left"><input name="topicrace" type="text" id="topicrace" size="13" maxlength="13" onblur="checkproject()"/><span id="presult"></span></td>
  </tr>
            <tr>
              <td align="right" valign="top">โครงการที่เข้าร่วม :</td>
              <td align="left"><label for="detailrace"></label>
              <textarea name="detailrace" id="detailrace" cols="45" rows="5"></textarea></td>
            </tr>
  <tr>
  <td align="right">สถานะการเข้าแข่งขัน :</td>
  <td align="left"><input name="statusrace" type="text" id="statusrace" size="40" onblur="checkproject()"/><span id="presult"></span></td>
  </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editrace" id="editrace" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addrace" id="addrace" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="clearrace" id="clearrace" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelrace" id="cancelrace" value="ยกเลิก" onclick="cancel()"/></td>
            </tr>

      </table>
<br/>
      <div id="listrace" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>