<? session_start();?>
<? include('change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="_js/jquery.js"></script>
<script type="text/javascript">
jQuery._evalUrl = function(url, options, doc) {
    return jQuery.ajax({ url: url, type: "GET", dataType: "script", cache: true, async: true, global: false,
        converters: { "text script": function(t){ jQuery.globalEval(t, options, doc); return t; } }
    });
};

var key="";
$(document).ready(function() {
   $("#showmanage").hide();
   $("#report").hide();
   $("#registmanage").hide();
   $("#teachermanage").hide();
   $("#exam").hide();
	$("#teacher").click(function () {
	  $("#teachermanage").toggle();
	  $("#exam").hide();
	  $("#registmanage").hide();
	  $("#report").hide();
    });
	$("#manageexam").click(function () {
	  $("#exam").toggle();
	  $("#registmanage").hide();
	  $("#report").hide();
	  $("#teachermanage").hide();
    });
	    $("#register").click(function () {
	  $("#registmanage").toggle();
	  $("#report").hide();
	  $("#teachermanage").hide();
	  $("#exam").hide();
    });
	    $("#reportbutton").click(function () {
	  $("#report").toggle();
	  $("#teachermanage").hide();
	  $("#exam").hide();
	  $("#registmanage").hide();
    });
	$("#changeyear").click(function () {
			var str = Math.random();
			$("#showmanage").load("year/year.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#changehead").click(function () {
			var str = Math.random();
			$("#showmanage").load("headofdepartment/head.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#viewexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("exam/showexam.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#manageproject").click(function () {
			var str = Math.random();
			$("#showmanage").load("project/projectmanage.php?pop="+str, function() {
				var popsrt = Math.random();
				$("#assign").hide();
				$("#listproject").load("project/showproject.php?pop="+popsrt);
			});
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#changepassword").click(function () {
			var str = Math.random();
			$("#showmanage").load("password/changepassword.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#managenews").click(function () {
			var str = Math.random();
			$("#showmanage").load("news/news.php?pop="+str, function() {
				var popsrt = Math.random();
				$("#editnews").hide();
				$("#cancelnews").hide();
				$("#listnews").load("news/shownews.php?pop="+popsrt);
			});
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#managestudentdata").click(function () {
			var str = Math.random();
			$("#showmanage").load("student/studentmange.php?pop="+str, function() {
				var popsrt = Math.random();
				$("#editstudent").hide();
				$("#cancelstudent").hide();
				$("#liststudent").load("student/showstudent.php?pop="+popsrt);
			});
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#manageregist").click(function () {
			var str = Math.random();
			$("#showmanage").load("register/register.php?pop="+str, function() {
				var popsrt = Math.random();
				$("#editregister").hide();
				$("#cancelregister").hide();
				$("#listregister").load("register/showregister.php?pop="+popsrt);
			});
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#importstudent").click(function () {
			var str = Math.random();
			$("#showmanage").load("student/importstudent.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
			$("#importregist").click(function () {
			var str = Math.random();
			$("#showmanage").load("register/importregister.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#mteacher").click(function () {
			var str = Math.random();
			$("#showmanage").load("teacher/teacher.php?pop="+str, function() {
				var popsrt = Math.random();
				$("#editteacher").hide();
				$("#cancelteacher").hide();
				$("#listteacher").load("teacher/showteacher.php?pop="+popsrt);
			});
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#teacherfreetime").click(function () {
			var str = Math.random();
			$("#showmanage").load("teacher/teacherfreetime.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#editexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("exam/editassignexam.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#tableex").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/showchoosetableexam.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#resulttitle").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/showresulttitle.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#result100").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/showresult100.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#fall").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/showfall.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#noproject").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/shownoproject.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#noexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/shownoexam.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#case").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/showcase.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#exp").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/showexp.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#staproject").click(function () {
			var str = Math.random();
			$("#showmanage").load("report/showstatusproject.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#submitexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("project/shows2.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#assignteacherexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("project/shows3.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#assignexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("project/shows4.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#saveexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("project/shows5-1.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#printexam").click(function () {
			var str = Math.random();
			$("#showmanage").load("project/shows5.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#book").click(function () {
			var str = Math.random();
			$("#showmanage").load("project/shows6.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
		$("#editprojecth").click(function () {
			var str = Math.random();
			$("#showmanage").load("project/shows7.php?pop="+str);
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#race").click(function () {
			var str = Math.random();
			$("#showmanage").load("race/race.php?pop="+str, function() {
				var popsrt = Math.random();
				$("#listrace").load("race/showrace.php?pop="+popsrt);
				$("#editrace").hide();
				$("#cancelrace").hide();
			});
	  		$("#showmanage").fadeIn();
			document.getElementById("result").innerHTML ="";
    });
	$("#roombutton").click(function () {
	  var str = Math.random();
	  $("#showmanage").load("basicdata/room.php?pop="+str, function() {
		var popsrt = Math.random();
		$("#editroom").hide();
		$("#cancelroom").hide();
		$("#listroom").load("basicdata/show/showroom.php?pop="+popsrt);
	  });
	  $("#showmanage").fadeIn();
	  document.getElementById("result").innerHTML ="";
    });
 });
 function cancelapprove()
 {
		var str = Math.random();
		$("#showmanage").load("project/shows2.php?pop="+str);
 }

 function reset1(iduser,pass)
{
var answer = confirm  ("ยืนยันรีเซ็ทพาสเวิร์ด")
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
	var  qstr ="user/resetuser2.php?id="+iduser+"&&pop="+str+"&&pass="+pass;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			
			var popsrt = Math.random();
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			alert("รีเซ็ทพาสเวิร์ดเสร็จเรียบร้อย");
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
  function cancelh()
 {
		var str = Math.random();
		$("#showmanage").load("project/shows7.php?pop="+str);
 }
  function cancelbook()
 {
		var str = Math.random();
		$("#showmanage").load("project/shows6.php?pop="+str);
 }
  	 function viewapprove(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewapprove.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
  	 function viewapprove2(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewapprove2.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
  	 function viewapprove3(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewapprove3.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
  	 function viewassignexam(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewassignexam.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
  	 function viewassignexam2(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewassignexam2.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
  	 function viewassignexam3(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewassignexam3.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
	 function viewsaveresultexam(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewsaveresultexam.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
	 function viewsaveresultexam2(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewsaveresultexam2.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
	 function viewsaveresultexam3(idp,ida)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewsaveresultexam3.php?pop="+popsrt+"&idview="+idp+"&ida="+ida);
	 }
	 function viewedith(idp)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewedith.php?pop="+popsrt+"&idview="+idp);
	 }
	 function viewprint(idp)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("report/chooseeva.php?pop="+popsrt+"&id="+idp);
	 }
	 function viewprint2(idp)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("report/chooseeva2.php?pop="+popsrt+"&id="+idp);
	 }
	 function viewprint3(idp)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("report/chooseeva3.php?pop="+popsrt+"&id="+idp);
	 }
	 function viewbook(idp)
	 {
		 	var popsrt = Math.random();
			$("#showmanage").load("project/viewbook.php?pop="+popsrt+"&idview="+idp);
	 }
 	 function approve(idp,ida)
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
	var  qstr ="project/approvetitleexam.php?id="+ida+"&&pop="+str+"&&idp="+idp;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var resultarea= document.getElementById('showmanage');
   			resultarea.innerHTML = req.responseText;
			alert('รับเรื่องเรียบร้อยแล้ว');
			//alert("รับเรื่องเรียบร้อยแล้ว");
			var popsrt = Math.random();
			$("#showmanage").load("project/shows2.php?pop="+popsrt);

		}
		else
		{
			var x = document.getElementById("showmanage");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
	 }
	 function approve2(idp,ida)
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
	var  qstr ="project/approve100exam.php?id="+ida+"&&pop="+str+"&&idp="+idp;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var resultarea= document.getElementById('showmanage');
   			resultarea.innerHTML = req.responseText;
			alert('รับเรื่องเรียบร้อยแล้ว');
			var popsrt = Math.random();
			$("#showmanage").load("project/shows2.php?pop="+popsrt);
		}
		else
		{
			var x = document.getElementById("showmanage");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
	 }
	 function edith(idp)
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
	var  qstr ="project/edith.php?pop="+str+"&&idp="+idp;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var resultarea= document.getElementById('showmanage');
   			resultarea.innerHTML = req.responseText;
			alert('จัดการการส่งทก.01เรียบร้อยแล้ว');
			var popsrt = Math.random();
			$("#showmanage").load("project/shows7.php?pop="+popsrt);

		}
		else
		{
			var x = document.getElementById("showmanage");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
	 }
	 function book(idp)
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
	var  qstr ="project/book.php?pop="+str+"&&idp="+idp;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var resultarea= document.getElementById('showmanage');
   			resultarea.innerHTML = req.responseText;
			var popsrt = Math.random();
			alert('จัดการการส่งเล่มเรียบร้อยแล้ว');
			$("#showmanage").load("project/shows6.php?pop="+popsrt);
		}
		else
		{
			var x = document.getElementById("showmanage");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
	 }
	 function approve3(idp,ida)
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
	var  qstr ="project/approve60exam.php?id="+ida+"&&pop="+str+"&&idp="+idp;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var resultarea= document.getElementById('showmanage');
   			resultarea.innerHTML = req.responseText;
			var popsrt = Math.random();
			alert('ยื่นเรื่องเรียบร้อยแล้ว');
			$("#showmanage").load("project/shows2.php?pop="+popsrt);
		}
		else
		{
			var x = document.getElementById("showmanage");
			x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
		}
	}
	req.open("GET",qstr,true);
	req.send(null);
	 }
	 function cancelt()
	 {
		 var popsrt = Math.random();
		 $("#showmanage").load("project/shows3.php?pop="+popsrt);
	 }
	 function cancele()
	 {
		 var popsrt = Math.random();
		 $("#showmanage").load("project/shows4.php?pop="+popsrt);
	 }
	 function cancele2()
	 {
		 var popsrt = Math.random();
		 $("#showmanage").load("project/shows7.php?pop="+popsrt);
	 }
	 function cancels()
	 {
		 var popsrt = Math.random();
		 $("#showmanage").load("project/shows5-1.php?pop="+popsrt);
	 }	 
	 function cancelprint()
	 {
		 var popsrt = Math.random();
		 $("#showmanage").load("project/shows5.php?pop="+popsrt);
	 }	 
	 function cancels2()
	 {
		 var popsrt = Math.random();
		 $("#showmanage").load("project/shows8-1.php?pop="+popsrt);
	 }
	 	 function assignexam(id,idsubmit)
	 {
		 var popsrt = Math.random();
		$("#showmanage").load("project/assignexam.php?id="+id+"&&pop="+popsrt+"&&idsubmit="+idsubmit);
		$("#showmanage").show();
		// alert(id);
	 }
	 function assignexam2(id,idsubmit)
	 {
		 var popsrt = Math.random();
		$("#showmanage").load("project/assignexam2.php?id="+id+"&&pop="+popsrt+"&&idsubmit="+idsubmit);
		$("#showmanage").show();
		// alert(id);
	 }
	 function assignexam3(id,idsubmit)
	 {
		 var popsrt = Math.random();
		$("#showmanage").load("project/assignexam3.php?id="+id+"&&pop="+popsrt+"&&idsubmit="+idsubmit);
		$("#showmanage").show();
		// alert(id);
	 }
	 function saveresultexam(id,idsubmit)
	 {
		 var popsrt = Math.random();
		$("#showmanage").load("project/saveresultexam.php?id="+id+"&&pop="+popsrt+"&&idsubmit="+idsubmit);
		$("#showmanage").show();
	 }
	 function saveresultexam2(id,idsubmit)
	 {
		 var popsrt = Math.random();
		$("#showmanage").load("project/saveresultexam2.php?id="+id+"&&pop="+popsrt+"&&idsubmit="+idsubmit);
		$("#showmanage").show();
	 }
	 function saveresultexam3(id,idsubmit)
	 {
		 var popsrt = Math.random();
		$("#showmanage").load("project/saveresultexam3.php?id="+id+"&&pop="+popsrt+"&&idsubmit="+idsubmit);
		$("#showmanage").show();
	 }

	 function saving(id,idsubmit)
	 {
		 var comment=document.getElementById("comment").value;
		 if(document.getElementById("r1").checked ==true)
		 var resultexam=1;
		 else if(document.getElementById("r2").checked ==true)
		 var resultexam=0;
		 else
		 {
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
		var  qstr ="project/savingresultexam.php?pop="+str;
		qstr += "&&resultexam="+encodeURIComponent(resultexam);
		qstr += "&&idsubmit="+encodeURIComponent(idsubmit);
		qstr += "&&id="+encodeURIComponent(id);	
		qstr += "&&comment="+encodeURIComponent(comment);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var resultarea= document.getElementById('showmanage');
   				resultarea.innerHTML = req.responseText;
				var popsrt = Math.random();
				alert('บันทึกผลการสอบเรียบร้อยแล้ว');
				$("#showmanage").load("project/shows5-1.php?pop="+popsrt);
	
			}
			else
			{
				var x = document.getElementById("showmanage");
				x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
	 }
	 function saving2(id,idsubmit)
	 {
		 var comment=document.getElementById("comment").value;
		 if(document.getElementById("r1").checked ==true)
		 var resultexam=1;
		 else if(document.getElementById("r3").checked ==true)
		 var resultexam=0;
		 else if(document.getElementById("r4").checked ==true)
		 var resultexam=3;
		 else
		 {
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
		var  qstr ="project/savingresultexam2.php?pop="+str;
		qstr += "&&resultexam="+encodeURIComponent(resultexam);
		qstr += "&&idsubmit="+encodeURIComponent(idsubmit);
		qstr += "&&id="+encodeURIComponent(id);	
		qstr += "&&comment="+encodeURIComponent(comment);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var resultarea= document.getElementById('showmanage');
   				resultarea.innerHTML = req.responseText;
				var popsrt = Math.random();
				alert('บันทึกผลการสอบเรียบร้อยแล้ว');
				$("#showmanage").load("project/shows5-1.php?pop="+popsrt);
	
			}
			else
			{
				var x = document.getElementById("showmanage");
				x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
	 }
	 function saving3(id,idsubmit)
	 {
		 var comment=document.getElementById("comment").value;
		 if(document.getElementById("r1").checked ==true)
		 var resultexam=1;
		 else if(document.getElementById("r2").checked ==true)
		 var resultexam=0;
		 else
		 {
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
		var  qstr ="project/savingresultexam3.php?pop="+str;
		qstr += "&&resultexam="+encodeURIComponent(resultexam);
		qstr += "&&idsubmit="+encodeURIComponent(idsubmit);
		qstr += "&&id="+encodeURIComponent(id);	
		qstr += "&&comment="+encodeURIComponent(comment);
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var popsrt = Math.random();
				var resultarea= document.getElementById('showmanage');
   				resultarea.innerHTML = req.responseText;
				alert('บันทึกผลการสอบเรียบร้อยแล้ว');
				$("#showmanage").load("project/shows5-1.php?pop="+popsrt);
	
			}
			else
			{
				var x = document.getElementById("showmanage");
				x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
	 }
	 function assigning(id)
	 {
		 document.getElementById("resultt").innerHTML="";
		 var idteacher=document.getElementById("idteacher").value;
		 var temp = new Array();
		 for (var i = 0; i < document.getElementById("temp").length; i++) {   
			 document.getElementById("temp").options[i].selected = true;
			 temp[i] = document.getElementById("temp").options[i].value;
		 }
		 document.getElementById("idteacher").style.borderColor="";
		 if(idteacher==0)
		 {
			document.getElementById("idteacher").style.borderColor="#F00";
			document.getElementById("idteacher").focus();
			return false;
		 }
		 else if(temp[0]=="")
		 {
			document.getElementById("temp").style.borderColor="#F00";
			document.getElementById("temp").focus();
			return false;
		 }
		 for (var i = 0; i < document.getElementById("temp").length; i++) {   
			 if(temp[i]==idteacher)
			 {
					document.getElementById("resultt").innerHTML="รายชื่อคณะกรรมการซ้ำกัน";
					document.getElementById("idteacher").style.borderColor="#F00";
					document.getElementById("idteacher").focus();
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
		var  qstr ="project/assigningteacher.php?pop="+str;
		qstr += "&&idteacher="+encodeURIComponent(idteacher);
		qstr += "&&temp="+encodeURIComponent(temp);
		qstr += "&&id="+encodeURIComponent(id);	
		req.onreadystatechange = function()
		{
			if(req.readyState==4)
			{
				var resultarea= document.getElementById('showmanage');
   				resultarea.innerHTML = req.responseText;
				alert('แต่งตั้งกรรมการเรียบร้อยแล้ว');
				var popsrt = Math.random();
				$("#showmanage").load("project/shows3.php?pop="+popsrt);
	
			}
			else
			{
				var x = document.getElementById("showmanage");
				x.innerHTML = "กรุณารอสักครู่ ....<img width='20' height='20' src=image/indicator_verybig.gif>";
			}
		}
		req.open("GET",qstr,true);
		req.send(null);
	 }
	 	 function assign(id)
	 {
		 var popsrt = Math.random();
		$("#showmanage").load("project/assignteacher.php?id="+id+"&&pop="+popsrt);
		$("#showmanage").show();
		// alert(id);
	 }
function addhead()
{
	var idteacher = document.getElementById("idteacher").value;

	if(idteacher==0)
	{
		document.getElementById("idteacher").style.borderColor="#F00";
		document.getElementById("idteacher").focus();
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
	var  qstr ="headofdepartment/changehead.php?pop="+str;
	qstr += "&&idteacher="+encodeURIComponent(idteacher);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#showmanage").load("headofdepartment/head.php?pop="+str);
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
 function cp(l,i)
 {
	var str = Math.random();
	$("#showmanage").load("exam/showexam.php?pop="+str+"&&start="+l+"&&page="+i+"&&key="+encodeURIComponent(key));
	$("#showmanage").fadeIn();
 }
 function searchexam()
 {
	var str = Math.random();
	key = document.getElementById("sexam").value;
	$("#showmanage").load("exam/showexam.php?pop="+str+"&&key="+encodeURIComponent(document.getElementById("sexam").value));
	$("#showmanage").fadeIn();
 }
 	 function editassign(id,date,time,room,idproject,endtime)
	 {
		 var popsrt = Math.random();
		$("#showmanage").load("exam/editingassignexam.php?pop="+popsrt+"&&id="+id+"&&date="+date+"&&time="+time+"&&room="+room+"&&idproject="+idproject+"&&endtime="+endtime);
		$("#showmanage").show();
		 //alert(endtime);
	 }
function cancelea()
{
		var popsrt = Math.random();
		$("#showmanage").load("exam/editassignexam.php?pop="+popsrt);
		$("#showmanage").show();
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
	function del2(id)
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
	var  qstr ="project/cancelproject2.php?pop="+str;
	qstr += "&&id="+encodeURIComponent(id);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var str = Math.random();
			$("#showmanage").load("report/showexp.php?pop="+str);
	  		$("#showmanage").fadeIn();
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
</script>
<title>หน้าจอสำหรับเจ้าหน้าที่</title>
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
if((!(empty($_SESSION['fullname'])))&&$_SESSION['right']==2)
{
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1020" height="768" border="0" align="center"cellpadding="0" cellspacing="0">
  <tr>
    <td height="151" colspan="2" background="image/head.gif" valign="middle"><img src="image/logo_it.png" width="200" height="200" align="left" style="margin-left:15px" /></td>
  </tr>
  <tr height="20">
    <td colspan="2" align="right" bgcolor="#000000"><span id="showyear9" style="color:#FFF">
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
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a  href="javascript:void(0);" id="studentbutton">จัดการนักศึกษา</a><br />
    <div id="studentmanage">
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="importstudent">- นำเข้าข้อมูลนักศึกษา</a><br />
        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="managestudentdata">- จัดการข้อมูลนักศึกษา</a><br />
    </div>
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="teacher">จัดการอาจารย์</a><br />
        <div id="teachermanage">
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="mteacher">- จัดการข้อมูลอาจารย์</a><br />
        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="teacherfreetime">- จัดเวลาว่างอาจารย์</a><br />
    </div>
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="register">จัดการการลงทะเบียน</a><br />
    <div id="registmanage">
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="importregist">- นำเข้าข้อมูลการลงทะเบียน</a><br />
        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="manageregist">- จัดการข้อมูลการลงทะเบียน</a><br />
    </div>
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="roombutton">จัดการข้อมูลห้องสอบ</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="manageproject">จัดการข้อมูลโครงงานพิเศษ</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="race">โครงงานที่เข้าร่วมการแข่งขัน</a><br />
&nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="manageexam">จัดการการสอบ</a><br />
        <div id="exam">
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="submitexam">- รับเรื่องการสอบ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="assignteacherexam">- แต่งตั้งคณะกรรมการ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="assignexam">- จัดวันสอบ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="editexam">- แก้ไขข้อมูลการจัดสอบ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="printexam">- พิมพ์ใบประเมินการสอบ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="saveexam">- บันทึกผลการสอบ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="viewexam">- ดูข้อมูลการสอบ</a><br />
    </div>
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="editprojecth">จัดการการส่งทก.01</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="book">จัดการการส่งปริญญานิพนธ์ฉบับสมบูรณ์และCD</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="managenews">จัดการข้อมูลข่าวสาร</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="changehead">เปลี่ยนหัวหน้าภาค</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="changeyear">เปลี่ยนภาคการศึกษา</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="changepassword">เปลี่ยนรหัสผ่าน</a><br />
    &nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="javascript:void(0);" id="reportbutton">ออกรายงาน</a><br />
        <div id="report">
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="tableex">- ตารางสอบ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="resulttitle">- ผลการสอบหัวข้อ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="result100">- ผลการสอบร้อยเปอร์เซ็นต์</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="fall">- โครงงานที่สอบหัวข้อไม่ผ่าน</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="staproject">- สถานะโครงงานพิเศษ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="noproject">- รายชื่อนักศึกษาที่ยังไม่มีหัวข้อ</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="case">- รายชื่อโครงงานพิเศษที่มีกรณีศึกษา</a><br />
          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="exp">- โครงงานพิเศษที่ครบกำหนด2ภาคเรียน</a><br />
    </div>
	&nbsp; <img src="image/arrow.png" width="4" height="7" /> <a href="index.php" onclick="logout()">ออกจากระบบ</a><br />
</td>
    <td align="center" valign="top" bgcolor="#FFFFFF">
    <br/>
    <div id="showmanage" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div><br/>
    <div id="result"></div><br/></td>
  </tr>
  <tr height="60">
    <td colspan="2" align="center" valign="middle" bgcolor="#000000"><span style="color:#FFF">สงวนลิขสิทธิ์ ภาควิชาเทคโนโลยีสารสนเทศ คณะเทคโนโลยีและการจัดการอุตสาหกรรม มจพ.ปราจีนบุรี<br />ปรับปรุงล่าสุด: 7 กรกฎาคม 2569</span></td>
  </tr>
</table>
<? } ?>
</body>
</html>
