<? include('change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="_js/jquery.js"></script>
<script type="text/javascript">
var keyp="";
	$(document).ready(function() {
	var popsrt = Math.random();
	$("#showmanage").load("project/showproject2.php?pop="+popsrt);
	 });
  function cpp(l,i)
 {
	var str = Math.random();
	$("#showmanage").load("project/showproject2.php?pop="+str+"&&start="+l+"&&page="+i+"&&key="+keyp);
	$("#showmanage").fadeIn();
 }
 function searchexamp()
 {
	var str = Math.random();
	keyp = document.getElementById("sexam").value;
	$("#showmanage").load("project/showproject2.php?pop="+str+"&&key="+encodeURIComponent(document.getElementById("sexam").value));
	$("#showmanage").fadeIn();
 } 
</script>
<title>ดูข้อมูลโครงงานพิเศษ</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
	font-family: Tahoma, Geneva, sans-serif;
}
body {
	background-image: url();
	background-color: #DDD;
}
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1020" height="768" border="0" align="center"cellpadding="0" cellspacing="0">
  <tr>
    <td height="151" background="image/head.gif">&nbsp;</td>
  </tr>
  <tr height="20">
    <td bgcolor="#000000">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><h2><br />
      ดูข้อมูลโครงงานพิเศษ<br/>
    </h2>
      <div id="showmanage" align="center">กำลังโหลดข้อมูล <img src="image/indicator_verybig.gif" width="20" height="20" /></div><br/>
    <div id="result"></div><br/></td>
  </tr>
  <tr height="60">
    <td valign="top" bgcolor="#000000">&nbsp;</td>
  </tr>
</table>
</body>
</html>
