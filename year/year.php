<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
                    <? include('../connectdatabase.php');
			  $year = 0; $semester = 0;
			  $sql = "select * from academicyear";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  $year=$rs[0];
				  $semester =$rs[1];
			  }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function addyear()
{
	
		 var answer = confirm  ("คุณต้องการจะเปลี่ยนปีการศึกษาใช่หรือไม่ ?")
if (answer)
{
	var year = document.getElementById("year").value;
	var semester = document.getElementById("semester").value;
	document.getElementById("year").style.borderColor ="";
	if(year =="")
	{
		document.getElementById("year").style.borderColor ="#FF0000";
		document.getElementById("year").focus();
		return false;
	}
	if(year < <?=(int)$year?>)
	{
		alert("กรุณาเลือกภาคปีการศึกษาที่มากกว่าปัจจุบัน");
		return false;
	}
	if(year == <?=(int)$year?>)
	{
		if(semester <= <?=(int)$semester?>)
		{
			alert("กรุณาเลือกภาคปีการศึกษาที่มากกว่าปัจจุบัน");
			return false;
		}
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
	var  qstr ="year/changeyear.php?pop="+str;
	qstr += "&&year="+encodeURIComponent(year);
	qstr += "&&semester="+encodeURIComponent(semester);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var p = Math.random();
			$("#showmanage").load("year/year.php?p="+p);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("showyear9").innerHTML = " ภาคเรียนที่ "+semester+" ปีการศึกษา "+year;
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
</script>
<title></title>
</head>

<body>
  <center>
  <h2>    เปลี่ยนภาคปีการศึกษา</h2>
  <table id="tableadd" border="0" align="center">
  <tr>
    <td colspan="2" align="right">ภาคเรียน :
      <select name="semester" id="semester">
        <option <? if($semester==1)echo 'selected="selected"'; ?> value="1">1</option>
        <option <? if($semester==2)echo 'selected="selected"'; ?> value="2">2</option>
        <option <? if($semester==3)echo 'selected="selected"'; ?> value="3">3</option>
      </select>
      ปีการศึกษา :
      <input name="year" type="text" id="year" size="4" maxlength="4" value="<?=$year?>"/></td>
  </tr>
            <tr>
              <td colspan="2" align="center">
                <p>
                  <input type="button" name="addstudent" id="addstudent" value="เปลี่ยนปีการศึกษา" onclick="addyear()"/>
              </p></td>
            </tr>
</table>
</center>
<div id="yearresult"></div>
<br/>
</body>
</html>