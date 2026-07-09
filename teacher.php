<? session_start(); ?>
<? include('change.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="_js/jquery.js"></script>
<script type="text/javascript">
var keyp="";
var t;
  <? include('connectdatabase.php'); 
  $sql = "select * from teacher where id_user='".$_SESSION['iduser']."'";
    $result = mysqli_query($connect, $sql);
 while($rs2 = mysqli_fetch_array($result))
{
	?> 
	t = <?=$rs2[0];?>;
	<?
}
 mysqli_close($connect);
  ?>
$(document).ready(function() {
	$("#report").hide();
	$("#showmanage").load("project/showprojectteacher.php");
	$("#changepassword").click(function () {
			$("#showmanage").load("password/changepassword.php");
	  		$("#showmanage").fadeIn();
    });
		$("#viewproject").click(function () {
			$("#showmanage").load("project/showprojectteacher.php");
	  		$("#showmanage").fadeIn();
    });
		$("#viewallproject").click(function () {
			$("#showmanage").load("project/showallprojectteacher.php");
	  		$("#showmanage").fadeIn();
    });
		$("#profile").click(function () {
			$("#showmanage").load("teacher/formeditteacher.php");
	  		$("#showmanage").fadeIn();
    });
		$("#viewedit").click(function () {
			$("#showmanage").load("project/viewedit.php");
	  		$("#showmanage").fadeIn();
    });
			$("#tableex").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/showtableexamfix-2.php?pop="+str+"&t="+t);
	  		$("#showmanage").fadeIn();
    });
	$("#noproject").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/shownoproject.php?pop="+str);
	  		$("#showmanage").fadeIn();
    });
	$("#noexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/shownoexam2.php?pop="+str+"&t="+t);
	  		$("#showmanage").fadeIn();
    });
	$("#staproject").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/tablestatusproject2.php?pop="+str+"&teacher="+t);
	  		$("#showmanage").fadeIn();
    });
	$("#reportbutton").click(function () {
	  $("#report").toggle();
    });
 });
  function cpp(l,i)
 {
	var str = Math.random();
	$("#showmanage").load("project/showprojectteacher.php?pop="+str+"&&start="+l+"&&page="+i+"&&key="+keyp);
	$("#showmanage").fadeIn();
 }
   function cpp2(l,i)
 {
	var str = Math.random();
	$("#showmanage").load("project/showallprojectteacher.php?pop="+str+"&&start="+l+"&&page="+i+"&&key="+keyp);
	$("#showmanage").fadeIn();
 }
 function searchexamp()
 {
	var str = Math.random();
	keyp = document.getElementById("sexam").value;
	$("#showmanage").load("project/showprojectteacher.php?pop="+str+"&&key="+encodeURIComponent(document.getElementById("sexam").value));
	$("#showmanage").fadeIn();
 } 
 function searchexamp2()
 {
	var str = Math.random();
	keyp = document.getElementById("sexam").value;
	$("#showmanage").load("project/showallprojectteacher.php?pop="+str+"&&key="+encodeURIComponent(document.getElementById("sexam").value));
	$("#showmanage").fadeIn();
 } 
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
}
</script>
<title>หน้าจอสำหรับอาจารย์</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
	font-family: Tahoma, Geneva, sans-serif;
}
body {
	background-image: url();
	background-color: #DDD;
}
.F14 {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
</head>
<?
if((!(empty($_SESSION['fullname'])))&&$_SESSION['right']==3)
{
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1020" height="768" border="0" align="center"cellpadding="0" cellspacing="0">
  <tr>
    <td height="150" colspan="2" background="image/head.gif" valign="middle"><img src="image/logo_it.png" width="200" height="200" align="left" style="margin-left:15px" /></td>
  </tr>
  <tr>
    <td height="20" colspan="2" align="right" bgcolor="#000000"><span style="color:#FFF">
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
    <div>
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="index.php">หน้าหลัก</a><br />
	&nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="viewproject">ดูข้อมูลโครงงานพิเศษที่ตัวเองเป็นที่ปรึกษา</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="viewallproject">ดูข้อมูลโครงงานพิเศษทั้งหมด</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="profile">แก้ไขข้อมูลส่วนตัว</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="reportbutton">ออกรายงาน</a><br />
        <div id="report" >
          <hr />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="tableex">- ตารางสอบ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="staproject">- สถานะโครงงานพิเศษ</a><br />
          <!--&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="exp">- โครงงานพิเศษที่ครบกำหนด2ภาคเรียน</a><br />-->
          <hr />
    </div>
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="changepassword">เปลี่ยนรหัสผ่าน</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="index.php" onclick="logout()">ออกจากระบบ</a><br />    <br />
	</td>
    <td align="center" valign="top" bgcolor="#FFFFFF">
    <br/>
    <div id="showmanage" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div><br/>
    <div id="result"></div><br/>
    </td>
  </tr>
  <tr height="60">
    <td colspan="2" align="center" valign="middle" bgcolor="#000000"><span style="color:#FFF">สงวนลิขสิทธิ์ ภาควิชาเทคโนโลยีสารสนเทศ คณะเทคโนโลยีและการจัดการอุตสาหกรรม มจพ.ปราจีนบุรี<br />ปรับปรุงล่าสุด: 7 กรกฎาคม 2569</span></td>
  </tr>
</table>
<? } ?>
</body>
</html>
