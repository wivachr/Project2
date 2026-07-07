<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var a = true;
var b = true;
var c = true;
var detail;
var idmaniedit;
	$(document).ready(function() {
	var popsrt = Math.random();
	$("#adding").hide();
	$("#ctg").hide();
	$("#adding").hide();
	$("#namecoadvisor").hide();
	$("#snamecoadvisor").hide();
	$("#changetorgor").hide();
	$("#nco").hide();
	$("#tableeditc").hide();
	$("#sco").hide();
	$("#cob").hide();
	$("#ecob").hide();
	$("#idtitle").hide();
	$("#edtting").hide();
	$("#titleco").hide();
	$("#cancelco").hide();
		  $("#ctg").click(function () {
			  if(a)
			  document.getElementById('ctg').innerHTML = "ยกเลิก";
			  else
			  document.getElementById('ctg').innerHTML = "เปลี่ยน ทก.";
			  a = !a;
			  $("#changetorgor").toggle();
		  });
	  $("#addma").click(function () {
		  if(b)
		  {
		  document.getElementById('addma').innerHTML = "ยกเลิก";
		  $("#edtting").hide();
		  }
		  else
		  {
		  	document.getElementById('addma').innerHTML = "เพิ่มผู้จัดทำ";
	document.getElementById('cresult').innerHTML = "";
	document.getElementById('showname').innerHTML = "";
	document.getElementById("idstu1").value = "";
	document.getElementById("idstu2").value = "";
	document.getElementById("tel2").value="";
	document.getElementById("tel1").value="";
		  }
		  b = !b;
	  $("#adding").toggle();
   		 });
	  $("#addco").click(function () {
		  if(c)
		  document.getElementById('addco').innerHTML = "ยกเลิก";
		  else
		  document.getElementById('addco').innerHTML = "เพิ่มอาจารย์ที่ปรึกษาร่วม";
		  c = !c;
		  $("#namecoadvisor").toggle();
		  $("#snamecoadvisor").toggle();
		  $("#nco").toggle();
		  $("#sco").toggle();
		  $("#cob").toggle();
		  $("#idtitle").toggle();
		  $("#titleco").toggle();
   		 });
	      <? include('../connectdatabase.php'); 
		  	$sql = "select * from academicyear";
			 $result = mysqli_query($connect, $sql);
			 while($rs = mysqli_fetch_array($result))
			{
				$year = $rs[0];
				$semester = $rs[1];
			}
	?>
	 });
	 function cocancel()
	 {
		  $("#namecoadvisor").hide();
		  $("#snamecoadvisor").hide();
		  $("#nco").hide();
		  $("#sco").hide();
		  $("#ecob").hide();
		  $("#idtitle").hide();
		  $("#titleco").hide();
		  $("#cancelco").hide();
		  document.getElementById("idtitle").value=0;
		  document.getElementById("namecoadvisor").value="";
		  document.getElementById("snamecoadvisor").value="";
	 }
function MoveOption(objSourceElement, objTargetElement, flag)    {  

	var aryTempSourceOptions = new Array();        var x = 0;      
	
	//looping through source element to find selected options        
	for (var i = 0; i < objSourceElement.length; i++) {            
		if (objSourceElement.options[i].selected) {                //need to move this option to target element    
			if(objSourceElement.options[i].value==0)
			{
				return false;
			}
			var intTargetLen = objTargetElement.length++;    
			if(flag == '1'){  //นี้คือส่วนที่ ดัดแปลง ครับ ทั้งหมด ครับ คือแค่เอามาต่อ สติงกันแค่นั้นครับ
			objTargetElement.options[intTargetLen].text = objSourceElement.options[i].text;  
			}
			else if(flag == '0'){
				objTargetElement.options[intTargetLen].text = objSourceElement.options[i].text;
				objTargetElement.options[intTargetLen].value = objSourceElement.options[i].value;
			}
			else{
			objTargetElement.options[intTargetLen].text = objSourceElement.options[i].text;  	
			}
			objTargetElement.options[intTargetLen].value = objSourceElement.options[i].value;     //นี้คือส่วนที่ ดัดแปลง ครับ 
		}            
		else {                //storing options that stay to recreate select element                
			var objTempValues = new Object();
			objTempValues.text = objSourceElement.options[i].text;                
			objTempValues.value = objSourceElement.options[i].value;                
			aryTempSourceOptions[x] = objTempValues;                
			x++;           
		 }        
	}                //resetting length of source        
	objSourceElement.length = aryTempSourceOptions.length;       
	//looping through temp array to recreate source select element        
	for (var i = 0; i < aryTempSourceOptions.length; i++) {     
			objSourceElement.options[i].text = aryTempSourceOptions[i].text;            
			objSourceElement.options[i].value = aryTempSourceOptions[i].value;            
			objSourceElement.options[i].selected = false;        
	}    
}  
function delmani(idmani,idp)
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
	var  qstr ="project/delmanipulator.php?id="+idmani+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
		 	var popsrt = Math.random();
			savemani();
			$("#listproject").load("project/formeditproject.php?idproject="+<?=$idproject?>+"&&pop="+popsrt);
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
	 function addmani(id)
	{
	var idstu1 = document.getElementById("idstu1").value;
	var tel1 = document.getElementById("tel1").value;
	document.getElementById("idstu1").style.borderColor="";
	document.getElementById("tel1").style.borderColor="";
	if(idstu1=="")
	{
		document.getElementById("idstu1").style.borderColor="#F00";
		document.getElementById("idstu1").focus();
		return false;
	}
	else if(tel1=="")
	{
		document.getElementById("tel1").style.borderColor="#F00";
		document.getElementById("tel1").focus();
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
	var  qstr ="project/addmanipulator2.php?pop="+str;
	qstr += "&&idstu1="+encodeURIComponent(idstu1);
	qstr += "&&tel1="+encodeURIComponent(tel1);
	qstr += "&&idproject="+encodeURIComponent(id);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
		 var popsrt = Math.random();
		 savemani();
		$("#listproject").load("project/formeditproject.php?idproject="+id+"&&pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("idstu1").value="";
			document.getElementById("tel1").value="";
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
function editma(id,idstu,tel)
{
	$("#edtting").show();
	document.getElementById('addma').innerHTML = "เพิ่มผู้จัดทำ";
	document.getElementById('showename').innerHTML = "แก้ไขผู้จัดทำรหัส "+idstu;
	b = true;
	idmaniedit = id;
	document.getElementById('cresult').innerHTML = "";
	document.getElementById('showname').innerHTML = "";
	document.getElementById("idstu1").value = "";
	document.getElementById("tel1").value="";
	document.getElementById("idstu2").value = idstu;
	document.getElementById("tel2").value = tel;
	$("#adding").hide();
}
function savemani2()
{
	var idstu2 = document.getElementById("idstu2").value;
	var tel2 = document.getElementById("tel2").value;
	document.getElementById("idstu2").style.borderColor="";
	document.getElementById("tel2").style.borderColor="";
	if(idstu2=="")
	{
		document.getElementById("idstu2").style.borderColor="#F00";
		document.getElementById("idstu2").focus();
		return false;
	}
	else if(tel2=="")
	{
		document.getElementById("tel2").style.borderColor="#F00";
		document.getElementById("tel2").focus();
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
	var  qstr ="project/editmanipulator2.php?pop="+str;
	qstr += "&&idstu="+encodeURIComponent(idstu2);
	qstr += "&&idmani="+encodeURIComponent(idmaniedit);
	qstr += "&&tel2="+encodeURIComponent(tel2);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
		savemani();
		 var popsrt = Math.random();
		$("#listproject").load("project/formeditproject.php?idproject="+<?=$idproject?>+"&&pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("idstu2").value="";
			document.getElementById("tel2").value="";
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
function delco(idco)
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
	var  qstr ="project/delcoadvisor.php?id="+idco+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			saveco();
			var popsrt = Math.random();
			$("#listproject").load("project/formeditproject.php?idproject="+<?=$idproject?>+"&&pop="+popsrt);
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
	 function checkid2()
{
		<?
		include('../connectdatabase.php');
		$result = mysqli_query($connect, "select manipulator.id_student from project,manipulator where project.id_project=manipulator.id_project AND 			project.year_project='$year' AND project.semester_project='$semester' AND (project.id_statusproject<>'0' AND project.id_statusproject<>'18')");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[0]?>==document.getElementById("idstu2").value)
			{
			document.getElementById('cresult2').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
			document.getElementById('showname2').innerHTML = "";
					document.getElementById("idstu2").value = "";
					document.getElementById("tel2").value = "";
					return false;
			}
			<?
			}
		}
		$result = mysqli_query($connect, "select * from registration,student where student.id_student=registration.id_student AND year_registration='$year' and semester_registration='$semester'");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[2]?>==document.getElementById("idstu2").value)
			{
				document.getElementById('cresult2').innerHTML = "";
					document.getElementById('showname2').innerHTML = "<? echo $rs[7]." ".$rs[8] ?>";
					return true;
			}
			<?
			}
		}
		mysqli_close($connect);
	?>
			document.getElementById('cresult2').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
			document.getElementById('showname2').innerHTML = "";
	document.getElementById("idstu2").value = "";
	document.getElementById("tel2").value = "";
}
function checkid()
{
		<?
		include('../connectdatabase.php');
		$result = mysqli_query($connect, "select manipulator.id_student from project,manipulator where project.id_project=manipulator.id_project AND 			project.year_project='$year' AND project.semester_project='$semester' AND (project.id_statusproject<>'0' AND project.id_statusproject<>'18')");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[0]?>==document.getElementById("idstu1").value)
			{
					document.getElementById('cresult').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
					document.getElementById('showname').innerHTML = "";
					document.getElementById("idstu1").value = "";
					document.getElementById("tel1").value = "";
					return false;
			}
			<?
			}
		}
		$result = mysqli_query($connect, "select * from registration,student where student.id_student=registration.id_student AND year_registration='$year' and semester_registration='$semester'");
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{	
			?>
			if(<?=$rs[2]?>==document.getElementById("idstu1").value)
			{
				document.getElementById('cresult').innerHTML = "";
					document.getElementById('showname').innerHTML = "<? echo $rs[7]." ".$rs[8] ?>";
					return true;
			}
			<?
			}
		}
		mysqli_close($connect);
	?>
					document.getElementById('cresult').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
					document.getElementById('showname').innerHTML = "";
					document.getElementById("idstu1").value = "";
					document.getElementById("tel1").value = "";
}
function clickupload()
{

if ( document.getElementById('fileupload').value.length == 0 )
{
alert( 'ระบุ File ที่จะ Upload' ) ;
return false ;
}
document.getElementById('upmsg').style.color="";
document.getElementById('upmsg').innerHTML = 'กำลัง Upload อยู่ รอซักครู่...' ;
document.getElementById('btnUpload').disabled = true ;

return true ;
}
function cancele2()
{
	document.getElementById('cresult').innerHTML = "";
	document.getElementById('showname').innerHTML = "";
	document.getElementById("idstu1").value = "";
	document.getElementById("idstu2").value = "";
	document.getElementById("tel2").value="";
	document.getElementById("tel1").value="";
	$("#edtting").hide();
}
	 function funcaddco()
	 {
		var idtitle= document.getElementById("idtitle").value;
		var namecoadvisor = document.getElementById("namecoadvisor").value;
		var snamecoadvisor = document.getElementById("snamecoadvisor").value;
		document.getElementById("idtitle").style.borderColor="";
		document.getElementById("namecoadvisor").style.borderColor="";
		document.getElementById("snamecoadvisor").style.borderColor="";
		if(idtitle==0)
		{
			document.getElementById("idtitle").style.borderColor="#F00";
			document.getElementById("idtitle").focus();
			return false;
		}
		else if(namecoadvisor=="")
		{
			document.getElementById("namecoadvisor").style.borderColor="#F00";
			document.getElementById("namecoadvisor").focus();
			return false;
		}
		else if(snamecoadvisor=="")
		{
			document.getElementById("snamecoadvisor").style.borderColor="#F00";
			document.getElementById("snamecoadvisor").focus();
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
	var  qstr ="project/addcoadvisor.php?pop="+str;
	qstr += "&&idtitle="+encodeURIComponent(idtitle);
	qstr += "&&namecoadvisor="+encodeURIComponent(namecoadvisor);
	qstr += "&&snamecoadvisor="+encodeURIComponent(snamecoadvisor);
	qstr += "&&idproject="+encodeURIComponent(document.getElementById("idproject").value);		
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			saveco();
			var popsrt = Math.random();
			$("#listproject").load("project/formeditproject.php?idproject="+<?=$idproject?>+"&&pop="+popsrt);
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
	function uploadfalse()
{
document.getElementById('fileupload').value ="";
document.getElementById('upmsg').style.color="#FF6666";
document.getElementById('upmsg').innerHTML = 'กรุณาอัพโหลดไฟล์ประเภท pdf' ;
document.getElementById('btnUpload').disabled = false;
document.getElementById('frmUpload').reset() ;
return true ;
}
function uploadok(pathfile)
{
		document.getElementById('fileupload').value ="";
		document.getElementById('upmsg').style.color="";
		document.getElementById('btnUpload').disabled = false;
		document.getElementById('frmUpload').reset() ;
		var popsrt = Math.random();
		$("#listproject").load("project/formeditproject.php?idproject="+<?=$idproject?>+"&&pop="+popsrt);
		return true ;
}
function editco(id,t,n,s)
{
		  $("#namecoadvisor").show();
		  $("#snamecoadvisor").show();
		  $("#nco").show();
		  $("#sco").show();
		  $("#ecob").show();
		  $("#idtitle").show();
		  $("#titleco").show();
		  $("#cancelco").show();
		  document.getElementById("idtitle").value=t;
		  document.getElementById("namecoadvisor").value=n;
		  document.getElementById("snamecoadvisor").value=s;
}
	 function funcaddco()
	 {
		var idtitle= document.getElementById("idtitle").value;
		var namecoadvisor = document.getElementById("namecoadvisor").value;
		var snamecoadvisor = document.getElementById("snamecoadvisor").value;
		document.getElementById("idtitle").style.borderColor="";
		document.getElementById("namecoadvisor").style.borderColor="";
		document.getElementById("snamecoadvisor").style.borderColor="";
		if(idtitle==0)
		{
			document.getElementById("idtitle").style.borderColor="#F00";
			document.getElementById("idtitle").focus();
			return false;
		}
		else if(namecoadvisor=="")
		{
			document.getElementById("namecoadvisor").style.borderColor="#F00";
			document.getElementById("namecoadvisor").focus();
			return false;
		}
		else if(snamecoadvisor=="")
		{
			document.getElementById("snamecoadvisor").style.borderColor="#F00";
			document.getElementById("snamecoadvisor").focus();
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
	var  qstr ="project/addcoadvisor.php?pop="+str;
	qstr += "&&idtitle="+encodeURIComponent(idtitle);
	qstr += "&&namecoadvisor="+encodeURIComponent(namecoadvisor);
	qstr += "&&snamecoadvisor="+encodeURIComponent(snamecoadvisor);
	qstr += "&&idproject="+encodeURIComponent(document.getElementById("idproject").value);		
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listproject").load("project/formeditproject.php?idproject="+<?=$idproject?>+"&&pop="+popsrt);
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
	 function funceditco(id)
	 {
		var idtitle= document.getElementById("idtitle").value;
		var namecoadvisor = document.getElementById("namecoadvisor").value;
		var snamecoadvisor = document.getElementById("snamecoadvisor").value;
		document.getElementById("idtitle").style.borderColor="";
		document.getElementById("namecoadvisor").style.borderColor="";
		document.getElementById("snamecoadvisor").style.borderColor="";
		if(idtitle==0)
		{
			document.getElementById("idtitle").style.borderColor="#F00";
			document.getElementById("idtitle").focus();
			return false;
		}
		else if(namecoadvisor=="")
		{
			document.getElementById("namecoadvisor").style.borderColor="#F00";
			document.getElementById("namecoadvisor").focus();
			return false;
		}
		else if(snamecoadvisor=="")
		{
			document.getElementById("snamecoadvisor").style.borderColor="#F00";
			document.getElementById("snamecoadvisor").focus();
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
	var  qstr ="project/editcoadvisor.php?pop="+str;
	qstr += "&&id="+encodeURIComponent(id);
	qstr += "&&idtitle="+encodeURIComponent(idtitle);
	qstr += "&&namecoadvisor="+encodeURIComponent(namecoadvisor);
	qstr += "&&snamecoadvisor="+encodeURIComponent(snamecoadvisor);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			saveco();
			$("#listproject").load("project/formeditproject.php?idproject="+<?=$idproject?>+"&&pop="+popsrt);
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
	 function chooseedit(a)
	 {
		 var resultarea= document.getElementById('result');
		resultarea.innerHTML = "";
		 $("#edittable").show();
		 document.getElementById("nameproject").disabled = true;
		 document.getElementById("engnameproject").disabled = true;
		 document.getElementById("save").disabled = true;
		 document.getElementById("casestudy").disabled = true;
		 document.getElementById("engcasestudy").disabled = true;
		 document.getElementById("engnameproject").disabled = true;
		 document.getElementById("idteacher").disabled = true;
		 document.getElementById("email").disabled = true;
		 document.getElementById("address").disabled = true;
		 $("#tableeditc").hide();
		 $("#ctg").hide();
		 if(a=="เปลี่ยนชื่อโครงงานพิเศษ")
		 {
			 
			 document.getElementById("nameproject").disabled = false;
			 document.getElementById("engnameproject").disabled = false;
			 detail = document.getElementById("oldnameproject").value+" "+document.getElementById("oldengnameproject").value;
			 document.getElementById("save").disabled = false;
		 }
		 else if(a=="เปลี่ยนกรณีศึกษา")
		 {
			 document.getElementById("casestudy").disabled = false;
			 document.getElementById("engcasestudy").disabled = false;
			 detail = document.getElementById("oldcasestudy").value+" "+document.getElementById("oldengcasestudy").value;
			 document.getElementById("save").disabled = false;
		 }
		 else if(a=="เปลี่ยนที่ปรึกษา")
		 {
			 document.getElementById("idteacher").disabled = false;
			 document.getElementById("save").disabled = false;
			 detail = document.getElementById("oldidteacher").value;
		 }
		 else if(a=="เปลี่ยนคณะกรรมการ")
		 {
			 $("#edittable").hide();
			 $("#tableeditc").show();
			 document.getElementById("save").disabled = false;
			 detail = document.getElementById("oldgum").value;
		 }
		 else if(a=="เปลี่ยนที่อยู่")
		 {
			 document.getElementById("address").disabled = false;
			 document.getElementById("save").disabled = false;
			 detail = document.getElementById("oldaddress").value;
		 }
		 else if(a=="เปลี่ยนอีเมลล์")
		 {
			 document.getElementById("email").disabled = false;
			 document.getElementById("save").disabled = false;
			 detail = document.getElementById("oldemail").value;
		 }
		 else if(a=="เพิ่มขอบเขต")
		 {
			 $("#ctg").show();
			 detail = document.getElementById("oldbup").value;
		 }
		 else if(a=="ลดขอบเขต")
		 {
			 $("#ctg").show();
			 detail = document.getElementById("oldbup").value;
		 }
	 }
function save()
{
	var nameproject = document.getElementById("nameproject").value;
	var typeedit = document.getElementById("typeedit").value;
	var casestudy = document.getElementById("casestudy").value;
	var idteacher = document.getElementById("idteacher").value;
	var email = document.getElementById("email").value;
	var address = document.getElementById("address").value;
	var idproject = document.getElementById("idproject").value;
	var engnameproject = document.getElementById("engnameproject").value;
	var engcasestudy = document.getElementById("engcasestudy").value;
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
	var  qstr ="project/editproject2.php?id="+idproject+"&&address="+encodeURIComponent(address)+"&&email="+encodeURIComponent(email)+"&&idteacher="+encodeURIComponent(idteacher)+"&&nameproject="+encodeURIComponent(nameproject)+"&&casestudy="+encodeURIComponent(casestudy)+"&&engnameproject="+encodeURIComponent(engnameproject)+"&&engcasestudy="+encodeURIComponent(engcasestudy)+"&&type="+encodeURIComponent(typeedit)+"&&pop="+str+"&&detail="+encodeURIComponent(detail);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			chooseedit("0");
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			
			//canceledit();
			
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
function savecom()
{
		 document.getElementById("resultt").innerHTML="";
		 var typeedit = document.getElementById("typeedit").value;
		 var idteacherm=document.getElementById("idteacherm").value;
		 var temp = new Array();
		 for (var i = 0; i < document.getElementById("temp").length; i++) {   
			 document.getElementById("temp").options[i].selected = true;
			 temp[i] = document.getElementById("temp").options[i].value;
		 }
		 document.getElementById("idteacherm").style.borderColor="";
		 if(idteacherm==0)
		 {
			document.getElementById("idteacherm").style.borderColor="#F00";
			document.getElementById("idteacherm").focus();
			return false;
		 }
		 else if(temp[0]=="")
		 {
			document.getElementById("temp").style.borderColor="#F00";
			document.getElementById("temp").focus();
			return false;
		 }
		 for (var i = 0; i < document.getElementById("temp").length; i++) {   
			 if(temp[i]==idteacherm)
			 {
					document.getElementById("resultt").innerHTML="รายคณะกรรมการซ้ำกัน";
					document.getElementById("idteacherm").style.borderColor="#F00";
					document.getElementById("idteacherm").focus();
					return false;
			 }
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
		var  qstr ="project/savecom.php?pop="+str;
		qstr += "&&idteacher="+encodeURIComponent(idteacherm);
		qstr += "&&temp="+encodeURIComponent(temp);
		qstr += "&&id="+encodeURIComponent(<?=$idproject?>);
		qstr += "&&type="+encodeURIComponent(typeedit);
		qstr += "&&detail="+encodeURIComponent(detail);
		if(document.getElementById("statusp").value==4)
		{
			qstr += "&&no=true";
		}
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var resultarea= document.getElementById('result');
				resultarea.innerHTML = req.responseText;
				//chooseedit("0");
				var popsrt = Math.random();
				$("#listproject").load("project/formeditproject.php?idproject="+<?=$idproject?>+"&&pop="+popsrt);
				document.getElementById('typeedit').value="0";
				//canceledit();
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
function savehisup(oldup)
{
		var typeedit = document.getElementById("typeedit").value;
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
		var  qstr ="project/savehistorytorgor.php?pop="+str;
		qstr += "&&id="+encodeURIComponent(<?=$idproject?>);
		qstr += "&&type="+encodeURIComponent(typeedit);
		qstr += "&&detail="+encodeURIComponent(oldup);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var resultarea= document.getElementById('result');
				resultarea.innerHTML = req.responseText;
				//canceledit();
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
function savemani()
{
		var typeedit = document.getElementById("typeedit").value;
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
		var  qstr ="project/savehistorytorgor.php?pop="+str;
		qstr += "&&id="+encodeURIComponent(<?=$idproject?>);
		qstr += "&&type="+encodeURIComponent("แก้ไขผู้จัดทำ");
		qstr += "&&detail="+encodeURIComponent(document.getElementById("oldmani").value);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var resultarea= document.getElementById('result');
				resultarea.innerHTML = req.responseText;
				//canceledit();
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
function saveco()
{
		var typeedit = document.getElementById("typeedit").value;
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
		var  qstr ="project/savehistorytorgor.php?pop="+str;
		qstr += "&&id="+encodeURIComponent(<?=$idproject?>);
		qstr += "&&type="+encodeURIComponent("แก้ไขที่ปรึกษาร่วม");
		qstr += "&&detail="+encodeURIComponent(document.getElementById("oldco").value);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var resultarea= document.getElementById('result');
				resultarea.innerHTML = req.responseText;
				
				//canceledit();
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
</script><title>Untitled Document</title>
</head>
<body>
<table width="341" border="0">
  <tr>
    <td align="center"><h3>แก้ไขโครงงานพิเศษ รหัส <?=$idproject?></h3></td>
  </tr>
  <tr>
    <td align="center"><select name="typeedit" id="typeedit" onchange="chooseedit(this.value)">
          <option value="0">---เลือกประเภทการแก้ไข---</option>
          <option value="เปลี่ยนชื่อโครงงานพิเศษ">เปลี่ยนชื่อโครงงานพิเศษ</option>
          <option value="เปลี่ยนกรณีศึกษา">เปลี่ยนกรณีศึกษา</option>
          <option value="เปลี่ยนที่ปรึกษา">เปลี่ยนที่ปรึกษา</option>
          <option value="เปลี่ยนคณะกรรมการ">เปลี่ยนคณะกรรมการ</option>
          <option value="เปลี่ยนที่อยู่">เปลี่ยนที่อยู่</option>
          <option value="เปลี่ยนอีเมลล์">เปลี่ยนอีเมลล์</option>
          <option value="เพิ่มขอบเขต">เพิ่มขอบเขต</option>
          <option value="ลดขอบเขต">ลดขอบเขต</option>
</select></td>
  </tr>
</table>
<? include('../connectdatabase.php'); 
	  $num = 0;
	  $nnum = 0;
	  		  $sql = "select * from project,statusproject where project.id_statusproject=statusproject.id_statusproject AND id_project='".$idproject."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {

			  $sql = "select * from manipulator,student,title where title.id_title = student.id_title AND manipulator.id_student=student.id_student AND id_project='".$rs[0]."' order by id_manipulator";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  $student[$num] = $rs2[1]." ".$rs2[13].$rs2[6]." ".$rs2[7]."&nbsp;";
				  $showtel[$num] = "<strong>เบอร์โทรศัพท์ :</strong> ".$rs2[3];
				  $idstuedit[$num] = $rs2[1];
				  $idmani[$num] = $rs2[0];
				  $etel[$num] = $rs2[3];
				  $num += 1;
			  }
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='ที่ปรึกษา'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $teacher = $rs3[1];
				  $teachername = $rs3[18]." ".$rs3[7]." ".$rs3[8];
			  }
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='ประธาน'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $master = $rs3[18]." ".$rs3[7]." ".$rs3[8];
				  $idmaster = $rs3[4];
			  }
			   $sql = "select * from committee,teacher,academictitle where teacher.id_academictitle = academictitle.id_academictitle AND  committee.id_teacher=teacher.id_teacher AND id_project='".$rs[0]."' AND position='กรรมการ'";
			  $result = mysqli_query($connect, $sql);
			  while($rs3 = mysqli_fetch_array($result))
			  {
				  $gum[$nnum] = $rs3[18]." ".$rs3[7]." ".$rs3[8];
				  $idgum[$nnum] = $rs3[4];
				  $nnum += 1;
			  }
			  $sql = "select * from coadvisor,title where title.id_title = coadvisor.id_title AND id_project='".$rs[0]."'";
			  $result = mysqli_query($connect, $sql);
			  while($rs4 = mysqli_fetch_array($result))
			  {
				  $idco = $rs4[0];
				  $coad = $rs4[6].$rs4[3]." ".$rs4[4];
				  $cotitle = $rs4[2];
				  $coname = $rs4[3];
				  $cosname = $rs4[4];
			  }
	  ?>
<input name="statusp" id="statusp" type="hidden" value="<?=$rs[10]?>" />
  <table width="743" border="0" align="center" id="edittable">
    <tr>
      <th width="262" align="right" nowrap="nowrap" scope="col">ชื่อโครงงาน :</th>
      <th width="471" align="left">
      <input id="idproject" name="idproject" type="hidden" value="<?=$rs[0]?>" />
      <input name="nameproject" type="text" disabled="disabled" id="nameproject" value="<?=$rs[1]?>" size="50" maxlength="1000"/>
      <input id="oldnameproject" name="oldnameproject" type="hidden" value="<?=$rs[1]?>" />
      </th>
    </tr>
    <tr>
      <th align="right" nowrap="nowrap" scope="col">กรณีศึกษา :</th>
      <th align="left">
      <input name="casestudy" type="text" disabled="disabled" id="casestudy" value="<?=$rs[2]?>" size="50" maxlength="1000"/>
       <input id="oldcasestudy" name="oldcasestudy" type="hidden" value="<?=$rs[2]?>" />
      </th>
    </tr>
    <tr>
      <th align="right" nowrap="nowrap" scope="col">ชื่อโครงงาน(ภาษาอังกฤษ) :</th>
      <th align="left">
      <input name="engnameproject" type="text" disabled="disabled" id="engnameproject" value="<?=$rs[12]?>" size="50" maxlength="1000"/>
      <input id="oldengnameproject" name="oldengnameproject" type="hidden" value="<?=$rs[12]?>" />
      </th>
    </tr>
    <tr>
      <th align="right" nowrap="nowrap" scope="col">กรณีศึกษา(ภาษาอังกฤษ) :</th>
      <th align="left">
      <input name="engcasestudy" type="text" disabled="disabled" id="engcasestudy" value="<?=$rs[13]?>" size="50" maxlength="1000"/>
      <input id="oldengcasestudy" name="oldengcasestudy" type="hidden" value="<?=$rs[12]?>" />
      </th>
    </tr>
    <tr>
      <th align="right" valign="top" nowrap="nowrap" scope="row">ผู้จัดทำ :</th>
      <td align="left">
      <input id="oldmani" name="oldmani" type="hidden" value="<? $nostu=0;foreach($student as $s){$nostu++;if($num!=$nostu)echo $s.",";else echo $s;}?>" />
      <table border="0">
      <? 
	  $count = 0;
	  foreach($student as $s){
		  echo "<tr>";
		  if($num > 1)
		  {
				  echo '<td>'.$s.'&nbsp;</td><td>'.$showtel[$count].'&nbsp;</td><td><a href="javascript:void(0);" id="editma" onclick="editma('.$idmani[$count].','.$idstuedit[$count].',\''.$etel[$count].'\')">แก้ไข</a>'.' <a href="javascript:void(0);" id="delma" onclick="delmani('.$idmani[$count].')">ลบ</a></td>';
		  }
		  else
		  {
		  echo '<td>'.$s.'&nbsp;</td><td>'.$showtel[$count].'&nbsp;</td><td><a href="javascript:void(0);" id="editma" onclick="editma('.$idmani[$count].','.$idstuedit[$count].',\''.$etel[$count].'\')">แก้ไข</a></td>';
		  }
		  $count += 1;
		  echo "</tr>";
	  }
	  ?>
      </table>
</td>
    </tr>
		<tr><td align="right"></td>
        <td align="left" valign="top" nowrap="nowrap"><div id="adding">
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td align="right">รหัสนักศึกษา : </td>
              <td><input name="idstu1" type="text" id="idstu1" size="13" maxlength="13" onblur="checkid()"/>
                <span id="cresult" style="color:#F00"></span><span id="showname" style="color:#030"></span></td>
            </tr>
            <tr>
              <td align="right">เบอร์โทรศัพท์ : </td>
              <td><input name="tel1" type="text" id="tel1" size="14" maxlength="25"/></td>
            </tr>
            <tr>
              <td colspan="2"><input type="button" name="addm" id="addm" value="เพิ่มผู้จัดทำ" onclick="addmani(<?=$idproject;?>)"/></td>
            </tr>
          </table>
        </div>          <div id="edtting">
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td colspan="2" align="left"><span id="showename"></span></td>
            </tr>
            <tr>
              <td align="right">รหัสนักศึกษา : </td>
              <td><input name="idstu2" type="text" id="idstu2" size="13" maxlength="13" onblur="checkid2()"/>
                <span id="cresult2" style="color:#F00"></span><span id="showname2" style="color:#030"></span></td>
            </tr>
            <tr>
              <td align="right">เบอร์โทรศัพท์ : </td>
              <td><input name="tel2" type="text" id="tel2" size="14" maxlength="25"/></td>
            </tr>
            <tr>
              <td colspan="2"><input type="button" value="บันทึก" onclick="savemani2()" />
                <input type="button" value="ยกเลิก" onclick="cancele2()" /></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" scope="row">&nbsp;</td>
      <td align="left"><a href="javascript:void(0);" id="addma">เพิ่มผู้จัดทำ</a></td>
    </tr>
    <tr>
      <th align="right" nowrap="nowrap" scope="row">อาจารย์ที่ปรึกษาร่วม :</th>
      <td align="left">
      <input id="oldco" name="oldco" type="hidden" value="<?=$coad?>" />
	  <? if($coad==""){?><span id="tg01">ไม่มีอาจาร์ยที่ปรึกษาร่วม </span><a href="javascript:void(0);" id="addco">เพิ่มอาจารย์ที่ปรึกษาร่วม</a><? }else{echo $coad.' <a id="delco" href="javascript:void(0);" onclick="editco('.$idco.',\''.$cotitle.'\',\''.$coname.'\',\''.$cosname.'\')">แก้ไข</a> <a id="delco" href="javascript:void(0);" onclick="delco('.$idco.')">ลบ</a>';}?></td>
    </tr>
                <tr>
              <th align="right"><span id="titleco">คำนำหน้าชื่อที่ปรึกษาร่วม :</span></th>
              <td align="left">
                <select name="idtitle" id="idtitle">
                <option value="0">
                    ---เลือกคำนำหน้าชื่อ---
                  </option>
                  <?
			  $sql = "select * from title order by id_title";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs2[0]?>">
                    <?=$rs2[1]?>
                  </option>
                  <?
			  }
			  ?>
                </select>
              </td>
            </tr>
    <tr>
    <th align="right" nowrap="nowrap" scope="row"><span id="nco">ชื่ออาจารย์ที่ปรึกษาร่วม :</span>
    </th>
    <td align="left"><input type="text" name="namecoadvisor" id="namecoadvisor" />
    </td>
    </tr>
    <tr>
    <th align="right" nowrap="nowrap" scope="row"><span id="sco">นามสกุลอาจารย์ที่ปรึกษาร่วม :</span>
    </th>
    <td align="left">
      <input type="text" name="snamecoadvisor" id="snamecoadvisor" /></td>
    </tr>
    <tr>
    <td align="center" nowrap="nowrap" scope="row" colspan="2"><input name="cob" type="button" id="cob" value="เพิ่มอาจารย์ที่ปรึกษาร่วม" onclick="funcaddco();"/>
      <input type="button" name="ecob" id="ecob" onclick="funceditco(<?=$idco?>)" value="แก้ไขอาจารย์ที่ปรึกษาร่วม" />
      <input type="button" name="cancelco" id="cancelco" onclick="cocancel()" value="ยกเลิก" /></td>
    </tr>
    <tr>
      <th align="right" scope="row">อาจารย์ที่ปรึกษา :</th>
      <th align="left"><label for="typeedit"></label>
      <input id="oldidteacher" name="oldidteacher" type="hidden" value="<?=$teachername?>" />
        <select name="idteacher" id="idteacher" disabled="disabled">
          <option value="0">---เลือกอาจารย์---</option>
              <? 
			  $sql = "select * from teacher order by initials_teacher";
			  $result = mysqli_query($connect, $sql);
			  while($rs2 = mysqli_fetch_array($result))
			  {
				  if($teacher==$rs2[0])
				  {
				  ?>
                  <option value="<?=$rs2[0]?>" selected="selected">
                    <? echo $rs2[5]." ".$rs2[3]." ".$rs2[4]; ?>
                  </option>
                  <?
				  }
				  else
				  {
				  ?>
                  <option value="<?=$rs2[0]?>">
                    <? echo $rs2[5]." ".$rs2[3]." ".$rs2[4]; ?>
                  </option>
                  <?  
				  }
			  }
			  ?>
        </select>
      </th>
    </tr>
    <? if($master!="")
	{
		?>
        <tr>
      <th align="right" nowrap="nowrap" scope="row">ประธาน :</th>
      <td align="left">
       <input id="oldmaster" name="oldmaster" type="hidden" value="<?=$master?>" />
        <?=$master?>
      </td>
      </tr>
      <? }
	  if($gum!="")
	  {
	  ?>
         <tr>
      <th align="right" valign="top" scope="row">กรรมการ :</th>
      <td align="left">
<input id="oldgum" name="oldgum" type="hidden" value="<?
echo "ประธาน :".$master."<br/>";
echo "กรรมการ :";
$nogum=0;
		foreach($gum as $gums)
		{
			$nogum++;
			if($nnum!=$nogum)
			{
				echo $gums.","; 
			}
			else
			echo $gums; 
		}
		?>" />
        <?
		foreach($gum as $gums)
		{
		echo $gums."<br/>"; 
		}
		?>
      </td>
      </tr>
      <? } ?>
    <tr>
      <th align="right" nowrap="nowrap" scope="row">อีเมลล์ผู้จัดทำ :</th>
      <td align="left">
      <input id="oldemail" name="oldemail" type="hidden" value="<?=$rs[8]?>" />
      <input name="email" type="text"  disabled="disabled" id="email"  value="<?=$rs[8]?>" size="50"/>
      </td>
    </tr>
    <tr>
      <th align="right" nowrap="nowrap" scope="row">ที่อยู่ผู้จัดทำ :</th>
      <td align="left">
      <input id="oldaddress" name="oldaddress" type="hidden" value="<?=$rs[7]?>" />
      <textarea id="address" name="address" cols="50" rows=""  disabled="disabled"><?=$rs[7]?></textarea>
      </td>
    </tr>
    <tr>
      <th align="right" nowrap="nowrap" scope="row">ทก.01(.pdf) :</th>
      <td align="left">
      <input id="oldbup" name="oldbup" type="hidden" value="<?=$rs[9]?>" />
      <input name="bup" id="bup" type="hidden" value="<?=$rs[9]?>" />
      <a href="<?=$rs[9]?>" target="_blank">ดู ทก.</a> <a href="javascript:void(0);" id="ctg">เปลี่ยน ทก.</a>
  <div id="changetorgor">
        <iframe id="uploadtarget" name="uploadtarget" src="" style="width:0px;height:0px;border:0"></iframe>
      <form id="frmUpload" action="project/upload2.php?idproject=<?=$rs[0]?>&old=<?=$rs[9]?>" method="post" enctype="multipart/form-data" onsubmit="return clickupload();" target="uploadtarget">
        <span id="upmsg"></span><br>
  <input id="fileupload" name="fileupload" type="file" />
          <input id="btnUpload" type="submit" value="อัพโหลด">
      </form>
      </div>
      </td>
    </tr>
    <tr>
      <th colspan="2" scope="row">
<input type="button" name="save" id="save" value="บันทึก" onclick="save()" disabled="disabled" />
          <input type="button" name="cancel" id="cancel" value="กลับ" onclick="canceledit()"  />
      </th>
    </tr>
  </table>

<? 			 
   			}
			  mysqli_close($connect);
	?>
<form id="form" name="form" method="post" action="">
  <table width="417" border="0" id="tableeditc">
    <tr>
      <td colspan="2" align="center">&nbsp;<span id="resultt" style="color:#F00"></span></td>
    </tr>
    <tr>
      <td width="93" align="right">ประธาน :</td>
      <td width="171" align="left"><select name="idteacherm" id="idteacherm">
        <option value="0">---เลือกอาจารย์---</option>
        <?
			include('../connectdatabase.php'); 
			  $sql = "select * from teacher order by initials_teacher";
			  
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
        <option value="<?=$rs[0]?>" <? if($idmaster==$rs[0]){ ?>selected="selected"<? } ?>> <? echo $rs[5]." ".$rs[3]." ".$rs[4]; ?> </option>
        <?
			  }
			  mysqli_close($connect);
			  ?>
      </select></td>
    </tr>
    <tr>
      <td height="25" align="right" class="c1">กรรมการ :</td>
      <td align="left" class="c1"><select name="matid" id="matid" style="width:150px" >
        <option value="0">---เลือกอาจารย์---</option>
        <? include('../connectdatabase.php'); 
			  $sql = "select * from teacher order by initials_teacher";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  $aa = true;
				  foreach($idgum as $gums)
				  {
				  if($rs[0]==$gums)
				  	{
						$aa=false;
				  	}
				  }
				  if($aa)
				  {
				  ?>
        <option value="<?=$rs[0]?>"> <? echo $rs[5]." ".$rs[3]." ".$rs[4]; ?> </option>
        <? }
			  }
			  mysqli_close($connect);
			  ?>
      </select>
        <input type="button" name="add" value="เพิ่ม" onclick="MoveOption(this.form.matid, this.form.temp,'1')" /></td>
    </tr>
    <tr>
      <td height="25" class="c1">&nbsp;</td>
      <td align="left" class="c1"><select name="temp" id="temp" size="3" multiple="multiple" style="width: 150px;">
         <?
		 $cnum = 0;
		foreach($gum as $gums)
		{
		echo "<option value='".$idgum[$cnum]."'>".$gums."</option>";
		$cnum++;
		}
		?>
      </select>
        <input type="button" name="remove" value="ลบ" onclick="MoveOption(this.form.temp, this.form.matid,'0')" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="button" name="assignb" id="assignb" value="บันทึก" onclick="savecom()" />
        <input type="button" name="cancel2" id="cancel2" value="ยกเลิก" onclick="canceledit()"  /></td>
    </tr>
  </table>
</form>
<a name="endname" id="endname"></a>
</body>
</html>