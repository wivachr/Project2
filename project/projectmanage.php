<script type="text/javascript">
var idstudent;
var keyp="";
var start="0";
var page="1";
	$(document).ready(function() {
	$("#assign").hide();
	if ($("#showmanage").length === 0) {
		var popsrt = Math.random();
		$("#listproject").load("project/showproject.php?pop="+popsrt);
	}
	 });
 function cpp(l,i)
 {
	 start=l;
	 page=i;
	var str = Math.random();
	 if(document.getElementById("all").checked)
	 var checkch = "";
	 else
	 var checkch = 1;
	$("#listproject").load("project/showproject.php?pop="+str+"&&start="+l+"&&page="+i+"&&key="+encodeURIComponent(keyp)+"&ch="+checkch);
	$("#listproject").fadeIn();
 }
 function searchexamp()
 {
	 	 if(document.getElementById("all").checked)
	 var checkch = "";
	 else
	 var checkch = 1;
	var str = Math.random();
	keyp = document.getElementById("sexam").value;
	$("#listproject").load("project/showproject.php?pop="+str+"&&key="+encodeURIComponent(document.getElementById("sexam").value)+"&ch="+checkch);
	$("#listproject").fadeIn();
 } 
	function del(id)
	{
		var answer = confirm  ("ยืนยันการยกเลิกโครงงานพิเศษ ?")
if (answer)
{
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
	var  qstr ="project/cancelproject.php?pop="+str;
	qstr += "&&id="+encodeURIComponent(id);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var str = Math.random();
	$("#listproject").load("project/showproject.php?pop="+str+"&&start="+start+"&&page="+page+"&&key="+encodeURIComponent(keyp));
	$("#listproject").fadeIn();
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
	 function editproject(id)
	 {
		 var popsrt = Math.random();
		$("#listproject").load("project/formeditproject.php?idproject="+id+"&&pop="+popsrt);
		$("#listproject").show();
		// alert(id);
	 }
	 function canceledit()
	 {
		 var popsrt = Math.random();
		 $("#listproject").load("project/showproject.php?pop="+popsrt);
	 }
 function cchange()
 {
	 if(document.getElementById("all").checked)
	 var checkch = "";
	 else
	 var checkch = 1;
		var str = Math.random();
		$("#listproject").load("project/showproject.php?pop="+str+"&ch="+checkch);
 }
</script>
<center>
  <h2>
    <label for="select"></label>
    จัดการโครงงานพิเศษ
  </h2>
  <!--<p>
    <select name="select" id="select" onchange="manage(this.value)">
      <option value="0">--- เลือกการจัดการ ---</option>
      <option value="1">แสดงรายชื่อโครงงานพิเศษทั้งหมด</option>
      <option value="2">ยืนยันการยืนสอบหัวข้อ</option>
      <option value="3">แต่งตั้งคณะกรรมการ</option>
      <option value="4">จัดสอบหัวข้อโครงงานพิเศษ</option>
      <option value="5">พิมพ์ใบประเมิณการสอบหัวข้อ</option>
      <option value="5-1">บันทึกผลการสอบหัวข้อ</option>
      <option value="6">ยืนยันการยื่นสอบร้อย</option>
      <option value="7">จัดสอบร้อย</option>
      <option value="8">พิมพ์ใบประเมิณสอบร้อย</option>
      <option value="8-1">บันทึกผลการสอบร้อย</option>
</select>
  </p>-->
</center>
<div id="listproject" align="center">กำลังโหลดข้อมูล ....<img src="image/indicator_verybig.gif" alt="" width='20' height='20' /></div>
<br/>