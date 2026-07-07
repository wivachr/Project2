<? session_start();?>
<? include('change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="_js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
   $("#login").load("login.php");
 });
 function showme(a)
 {
	 alert(a);
 }
function login()
{
	var uname = document.getElementById("uname").value;
	var password = document.getElementById("password").value;
	document.getElementById("uname").style.borderColor="";
	document.getElementById("password").style.borderColor="";
	if(uname=="")
	{
		document.getElementById("uname").style.borderColor="#F00";
		document.getElementById("uname").focus();
		return false;
	}
	else if(password=="")
	{
		document.getElementById("password").style.borderColor="#F00";
		document.getElementById("password").focus();
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
	var  qstr ="loging.php?pop="+str;
	qstr += "&&uname="+encodeURIComponent(uname);
	qstr += "&&password="+encodeURIComponent(password);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#login").load("login.php?pop="+popsrt);
   			var resultarea= document.getElementById('loginresult');
   			resultarea.innerHTML = req.responseText;
			if(resultarea.innerHTML=="")
			{
				window.open('intopage.php','_self','');
			}
			document.getElementById("uname").value="";
			document.getElementById("password").value="";
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
<title>หน้าหลัก</title>
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1020" height="768" border="0" align="center"cellpadding="0" cellspacing="0">
  <tr>
    <td height="151" colspan="2" background="image/head.gif" valign="middle"><img src="image/logo_it.png" width="200" height="200" align="left" style="margin-left:15px" /></td>
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
    <div id="login">
กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif>
    </div>
    <div id="loginresult" align="center">
    </div>
    <br />
    <br />
    &nbsp; <a href="report/showtableexam2.php" target="_blank">- ตารางสอบโครงงานพิเศษ</a><br />
    &nbsp; <a href="showproject.php" target="_blank">- ดูรายชื่อหัวข้อโครงงานพิเศษ</a><br />
    </td>
    <td align="center" valign="top" bgcolor="#FFFFFF">
    <br/>
    <br/>
    <?
	  include('connectdatabase.php');
	  $manualpdf = "";
	  $sqlmanual = "select pdf_news from news where topic_news like '%คู่มือจัดทำเล่มปริญญานิพนธ์%' order by date_news desc limit 1";
	  $resultmanual = mysqli_query($connect, $sqlmanual);
	  if($rsmanual = mysqli_fetch_array($resultmanual))
	  {
		  $manualpdf = $rsmanual[0];
	  }
	  if(!empty($manualpdf))
	  {
	?>
    <a href="news/<?=htmlspecialchars($manualpdf, ENT_QUOTES)?>" target="_new" style="text-decoration:none; font-size:18px; color:#666; border: solid 1px #000; padding:10px">ดาวน์โหลดคู่มือจัดทำปริญญานิพนธ์</a>
    <? } ?>
    <br/>
    <br/>
    <br/>
    <br/>
                  <?
	  		  $sql2 = "select * from news order by date_news desc";
			  $result2 = mysqli_query($connect, $sql2);
			  	if(mysqli_num_rows($result2)!=0)
				{
			  ?>
      <table width="500" cellspacing="0">
        <tr bgcolor="#999999">
          <td height="30" colspan="2" align="center"><h2>ข่าวประกาศจากภาควิชา</h2></td>
        </tr>
              <? 
	  		  $sql = "select * from news order by date_news desc";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  $date2 = explode("-", $rs[4]);
			  $pdflink = !empty($rs[5]) ? " <a href='news/".htmlspecialchars($rs[5],ENT_QUOTES)."' target='_blank'>[PDF]</a>" : "";
			  if($rs[0]%2==1)
              echo "<tr bgcolor='#CCCCCC' align='left'><td><img src='image/icon_01new.gif' width='15' height='11' /> <a href='news/viewnews.php?id=$rs[0]' target='_blank'>$rs[1]</a>$pdflink</td><td align='right'>$date2[2]/$date2[1]/$date2[0]</td></tr>";
			  else
              echo "<tr bgcolor='#E9E9E9' align='left'><td><img src='image/icon_01new.gif' width='15' height='11' /><a href='news/viewnews.php?id=$rs[0]' target='_blank'> $rs[1]</a>$pdflink</td><td align='right'>$date2[2]/$date2[1]/$date2[0]</td></tr>";
			  }
			  ?>
      </table>
            <br/>
      <br/>
      <br/>
      <? } ?>

    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle" bgcolor="#000000" height="60"><span style="color:#FFF">สงวนลิขสิทธิ์ ภาควิชาเทคโนโลยีสารสนเทศ คณะเทคโนโลยีและการจัดการอุตสาหกรรม มจพ.ปราจีนบุรี<br />ปรับปรุงล่าสุด: 7 กรกฎาคม 2569</span></td>
  </tr>
</table>
</body>
</html>
