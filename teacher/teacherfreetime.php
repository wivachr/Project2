<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
var editid=0;
	var qstr2 = "";
	$(document).ready(function() {
	var popsrt = Math.random();
	$("#freetime").hide();
 });
function changeteacher(cid)
{
	editid = cid;
	if(cid==0)
	$("#freetime").hide();
	else
	{
		var popsrt = Math.random();
		var  qstr ="teacher/teacherfreetimelist.php?pop="+popsrt;
		qstr += "&&id="+encodeURIComponent(editid);
		$("#freetime").load(qstr);
		$("#freetime").show();
	}
		qstr2 = "";
}
function save(year,m)
{
	//alert(year.substring(0,1));
	//alert(year.substring(1));
	//alert(m);

	var str = Math.random();
	var freeday;
	if(year.substring(0,1)=="M")
	freeday = 1;
	else if(year.substring(0,1)=="T")
	freeday = 2;
	else if(year.substring(0,1)=="W")
	freeday = 3;
	else if(year.substring(0,1)=="H")
	freeday = 4;
	else
	freeday = 5;
	
	//$sql = "insert into teacherfreetime values('$day','$time','$id')";
	//$sql = "delete from teacherfreetime where id_teacher = '$id' AND day_freetime='$day' AND time_freetime='$time' ";
	if(m==true)
	{
		qstr2 +="insert into teacherfreetime values("+encodeURIComponent(freeday)+","+encodeURIComponent(year.substring(1))+","+encodeURIComponent(editid)+");";
	}
	else
	{
		qstr2 +="delete from teacherfreetime where id_teacher = "+encodeURIComponent(editid)+" AND day_freetime="+encodeURIComponent(freeday)+" AND time_freetime="+encodeURIComponent(year.substring(1))+";";
	}
		//qstr += "&&id="+encodeURIComponent(editid);
		//qstr += "&&day="+encodeURIComponent(freeday);
		//qstr += "&&time="+encodeURIComponent(year.substring(1));
		
}
function managefreetime()
{
		var popsrt = Math.random();
	var  qstr ="teacher/mfreetime.php?pop="+popsrt;
	qstr += "&&id="+encodeURIComponent(qstr2);
	//alert(qstr);
	$("#result").load(qstr);
	alert("บันทึกข้อมูลเวลาว่างอาจารย์เสร็จเรีบร้อย");
}
</script>
<title></title>
</head>

<body>
  <center>
    <p>
      <label for="select"></label>
      <h2>จัดการเวลาว่างอาจารย์</h2>
    * หมายเหตุเลือกเฉพาะเวลาที่มีการสอนหรือเวลาที่ไม่ว่าง 
    </p>
    <p>
      <select name="select" id="select" onchange="changeteacher(this.value)">
        <option value="0">
        ---เลือกอาจารย์---
        </option>
        <? include('../connectdatabase.php'); 
			  $sql = "select * from teacher order by initials_teacher";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
        <option value="<?=$rs[0]?>">
          <? echo $rs[5]." ".$rs[3]." ".$rs[4]; ?>
        </option>
        <?
			  }
			  mysqli_close($connect);
			  ?>
      </select>
    </p>
</center>
  <div id="freetime">โชว์ตารางเวลาว่าง
</div>
  <div id="result">
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br/>
</p>
</body>
</html>