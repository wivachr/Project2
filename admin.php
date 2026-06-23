<? session_start();?>
<? include('change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="_js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
   $("#basicdata").hide();
   $("#basicdatamanage").hide();
   $("#user").load("user/usermange.php");
   //ปุ่มด้านซ้าย
   $("#user").hide();
       $("#basicdatabutton").click(function () {
	  $("#user").hide();
	  $("#basicdata").toggle("slow");
	  
    });
	   $("#userbutton").click(function () {
		$("#user").load("user/usermange.php");
	  $("#basicdata").hide();
	  $("#basicdatamanage").hide();
	  $("#user").toggle("slow");
    });
	//จัดการข้อมูลพื้นฐาน
	//คำนำหน้าชื่อ
       $("#titltebutton").click(function () {
	   $("#basicdatamanage").load("basicdata/title.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//สิทธิ์
       $("#rightbutton").click(function () {
	  $("#basicdatamanage").load("basicdata/right.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//หลักสูตร
       $("#typestudentbutton").click(function () {
	  $("#basicdatamanage").load("basicdata/typestudent.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//คณะ
       $("#kanarbutton").click(function () {
	  $("#basicdatamanage").load("basicdata/faculty.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//ภาค
       $("#pakbutton").click(function () {
	  $("#basicdatamanage").load("basicdata/department.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//สาขา
       $("#sakabutton").click(function () {
	  $("#basicdatamanage").load("basicdata/division.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//ประเภทการสอบ
       $("#typeexambutton").click(function () {
	  $("#basicdatamanage").load("basicdata/typeexam.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//วิชา
       $("#subjectbutton").click(function () {
	  $("#basicdatamanage").load("basicdata/subject.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//สถานะโปรเจค
       $("#statusprojectbutton").click(function () {
	  $("#basicdatamanage").load("basicdata/statusproject.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//ห้องเรียน
       $("#roombutton").click(function () {
	  $("#basicdatamanage").load("basicdata/room.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
	//คำนำหน้าชื่อทางวิชาการ
       $("#academictitltebutton").click(function () {
	  $("#basicdatamanage").load("basicdata/academictitle.php");
	  $("#basicdatamanage").fadeIn("slow");
    });
 });
 function logout()
{
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
	var  qstr ="logout.php?pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#login").load("login.php?pop="+popsrt);
   			var resultarea= document.getElementById('loginresult');
   			resultarea.innerHTML = req.responseText;
		}
		else
		{
			var x = document.getElementById("loginresult");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
	//alert("แง้ง");
	//setTimeout("location.reload(true);",5);
}
</script>
<title>หน้าจอสำหรับผู้ดูแลระบบ</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
	font-family: Tahoma, Geneva, sans-serif;
}
body {
	background-image: url();
	background-color: #DDD;
	font-size: 14px;
}
.F14 {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
</head>
<?
if((!(empty($_SESSION['fullname'])))&&$_SESSION['right']==1)
{
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1020" height="768" border="0" align="center"cellpadding="0" cellspacing="0">
  <tr>
    <td height="151" colspan="2" background="image/head.gif">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" height="20" bgcolor="#000000" align="right"><span style="color:#FFF">
    	<? include('connectdatabase.php'); 
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
	mysqli_close($connect);
	?>
      ภาคเรียนที่ <?=$semester?> ปีการศึกษา <?=$year?></span></td>
  </tr>
  <tr>
    <td width="200" valign="top" bgcolor="#CCCCCC" class="F14">
    <br />
    <br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="index.php">หน้าหลัก</a><br />
	&nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="basicdatabutton">จัดการข้อมูลพิ้นฐาน</a><br />
          <div id="basicdata" >
          <hr />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="titltebutton">- จัดการข้อมูลคำนำหน้าชื่อ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="academictitltebutton">- จัดการข้อมูลคำนำหน้าชื่อทางวิชาการ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="rightbutton">- จัดการข้อมูลสิทธิ์</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="typestudentbutton">- จัดการข้อมูลหลักสูตร</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="kanarbutton">- จัดการข้อมูลคณะ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="pakbutton">- จัดการข้อมูลภาควิชา</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="sakabutton">- จัดการข้อมูลสาขาวิชา</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="typeexambutton">- จัดการข้อมูลประเภทการสอบ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="subjectbutton">- จัดการข้อมูลวิชา</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="statusprojectbutton">- จัดการข้อมูลสถานะโครงงาน</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="roombutton">- จัดการข้อมูลห้องสอบ</a>
          <hr />
      </div>
	&nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="userbutton">จัดการข้อมูลผู้ใช้</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="index.php" onclick="logout();">ออกจากระบบ</a><br />    <br /></td>
    
    <td align="left" valign="top" bgcolor="#FFFFFF">
        <br />
      <div id="user">
      </div>
      <div id="basicdatamanage">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
      <div id="result" align="center">  </div>
      <!-- เอาไว้คั้นเฉยๆ --><!-- เอาไว้คั้นเฉยๆ -->
    </p></td>
  </tr>
  <tr>
    <td colspan="2" height="60" valign="top" bgcolor="#000000">&nbsp;</td>
  </tr>
</table>
<? } ?>
</body>
</html>
