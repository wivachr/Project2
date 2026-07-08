<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idnews;
	$(document).ready(function() {
	$("#editnews").hide();
	$("#cancelnews").hide();
	if ($("#showmanage").length === 0) {
		var popsrt = Math.random();
		$("#listnews").load("news/shownews.php?pop="+popsrt);
	}
	 });
function add()
{
	var topicnews = document.getElementById("topicnews").value;
	var detailnews = document.getElementById("detailnews").value;
	document.getElementById("topicnews").style.borderColor="";
	document.getElementById("detailnews").style.borderColor="";

	if(topicnews=="")
	{
		document.getElementById("topicnews").style.borderColor="#F00";
		document.getElementById("topicnews").focus();
		return false;
	}
	else if(detailnews=="")
	{
		document.getElementById("detailnews").style.borderColor="#F00";
		document.getElementById("detailnews").focus();
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
	var  qstr ="news/addnews.php?pop="+str;
	qstr += "&&topicnews="+encodeURIComponent(topicnews);
	qstr += "&&detailnews="+detailnews;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			idnews = req.responseText;
			var resultarea= document.getElementById('result');
			resultarea.innerHTML = "";
			cleardata();
			if ( document.getElementById('fileupload').value.length > 0 )
			{
				startUpload();
			}
			if ( document.getElementById('fileuploadimage').value.length > 0 )
			{
				startUploadImage();
			}
			$("#listnews").load("news/shownews.php?pop="+popsrt);
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

function startUpload()
{
	document.getElementById('frmUpload').action = "news/uploadnews.php?idnews="+idnews;
	document.getElementById('upmsg').style.color="";
	document.getElementById('upmsg').innerHTML = "";
	document.getElementById('btnUpload').disabled = true ;
	document.getElementById('frmUpload').submit();
}
function startUploadImage()
{
	document.getElementById('frmUploadImage').action = "news/uploadnewsimage.php?idnews="+idnews;
	document.getElementById('upmsgimg').style.color="";
	document.getElementById('upmsgimg').innerHTML = "";
	document.getElementById('btnUploadImage').disabled = true ;
	document.getElementById('frmUploadImage').submit();
}
function clickupload()
{
	if ( document.getElementById('fileupload').value.length == 0 )
	{
		alert( 'ระบุ File ที่จะ Upload' ) ;
		return false ;
	}
	if(!idnews)
	{
		alert( 'กรุณาเพิ่มหรือเลือกข่าวสารก่อนอัพโหลดไฟล์' ) ;
		return false ;
	}
	document.getElementById('frmUpload').action = "news/uploadnews.php?idnews="+idnews;
	document.getElementById('upmsg').style.color="";
	document.getElementById('upmsg').innerHTML = "";
	document.getElementById('btnUpload').disabled = true ;
	return true ;
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
function uploadok()
{
	document.getElementById('fileupload').value ="";
	document.getElementById('upmsg').style.color="green";
	document.getElementById('upmsg').innerHTML = 'อัพโหลดไฟล์สำเร็จ' ;
	document.getElementById('btnUpload').disabled = false;
	document.getElementById('frmUpload').reset() ;
	var popsrt = Math.random();
	$("#listnews").load("news/shownews.php?pop="+popsrt);
	return true ;
}
function clickuploadimage()
{
	if ( document.getElementById('fileuploadimage').value.length == 0 )
	{
		alert( 'ระบุ File ที่จะ Upload' ) ;
		return false ;
	}
	if(!idnews)
	{
		alert( 'กรุณาเพิ่มหรือเลือกข่าวสารก่อนอัพโหลดไฟล์' ) ;
		return false ;
	}
	document.getElementById('frmUploadImage').action = "news/uploadnewsimage.php?idnews="+idnews;
	document.getElementById('upmsgimg').style.color="";
	document.getElementById('upmsgimg').innerHTML = "";
	document.getElementById('btnUploadImage').disabled = true ;
	return true ;
}
function uploadfalseimg()
{
	document.getElementById('fileuploadimage').value ="";
	document.getElementById('upmsgimg').style.color="#FF6666";
	document.getElementById('upmsgimg').innerHTML = 'กรุณาอัพโหลดไฟล์รูปภาพ (jpg, png, gif)' ;
	document.getElementById('btnUploadImage').disabled = false;
	document.getElementById('frmUploadImage').reset() ;
	return true ;
}
function uploadokimg()
{
	document.getElementById('fileuploadimage').value ="";
	document.getElementById('upmsgimg').style.color="green";
	document.getElementById('upmsgimg').innerHTML = 'อัพโหลดรูปภาพสำเร็จ' ;
	document.getElementById('btnUploadImage').disabled = false;
	document.getElementById('frmUploadImage').reset() ;
	var popsrt = Math.random();
	$("#listnews").load("news/shownews.php?pop="+popsrt);
	return true ;
}

function cancel()
{
	cleardata();
	$("#editnews").hide();
	$("#cancelnews").hide();
	$("#addnews").show();
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
	var  qstr ="news/delnews.php?&&pop="+str;
	qstr += "&&id="+encodeURIComponent(id);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listnews").load("news/shownews.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editnews").hide();
			$("#cancelnews").hide();
			$("#addnews").show();
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
function showedit(id,topic,detail)
{
	idnews = id;
	document.getElementById("topicnews").value=topic;
	document.getElementById("detailnews").value=detail;
	$("#editnews").show();
	$("#cancelnews").show();
	$("#addnews").hide();
}
function edit()
{
	var topicnews = document.getElementById("topicnews").value;
	var detailnews = document.getElementById("detailnews").value;
	document.getElementById("topicnews").style.borderColor="";
	document.getElementById("detailnews").style.borderColor="";
	if(topicnews=="")
	{
		document.getElementById("topicnews").style.borderColor="#F00";
		document.getElementById("topicnews").focus();
		return false;
	}
	else if(detailnews=="")
	{
		document.getElementById("detailnews").style.borderColor="#F00";
		document.getElementById("detailnews").focus();
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
	var  qstr ="news/editnews.php?pop="+str;
	qstr += "&&id="+encodeURIComponent(idnews);
	qstr += "&&topicnews="+encodeURIComponent(topicnews);
	qstr += "&&detailnews="+encodeURIComponent(detailnews);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			var resultarea= document.getElementById('result');
			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editnews").hide();
			$("#cancelnews").hide();
			$("#addnews").show();
			if ( document.getElementById('fileupload').value.length > 0 )
			{
				startUpload();
			}
			if ( document.getElementById('fileuploadimage').value.length > 0 )
			{
				startUploadImage();
			}
			$("#listnews").load("news/shownews.php?pop="+popsrt);
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
	document.getElementById("topicnews").value="";
	document.getElementById("detailnews").value="";
}
</script><title></title>
</head>

<body>
  <center><h2>    จัดการข้อมูลข่าวสาร</h2>
  </center>
  <table border="0" align="center">
  <tr>
  <td align="right">หัวข้อข่าวสาร :</td>
  <td align="left"><input name="topicnews" type="text" id="topicnews" size="20" maxlength="100" /></td>
  </tr>
            <tr>
              <td align="right" valign="top">รายละเอียดข่าวสาร :</td>
              <td align="left"><label for="detailnews"></label>
              <textarea name="detailnews" id="detailnews" cols="45" rows="5"></textarea></td>
            </tr>
            <tr>
              <td align="right" valign="top">ไฟล์ PDF ประกอบข่าวสาร :</td>
              <td align="left">
                <iframe id="uploadtarget" name="uploadtarget" src="" style="width:0px;height:0px;border:0"></iframe>
                <form id="frmUpload" action="" method="post" enctype="multipart/form-data" onsubmit="return clickupload();" target="uploadtarget">
                <input id="fileupload" name="fileupload" type="file" accept="application/pdf">
                <input type="submit" id="btnUpload" name="btnUpload" value="อัพโหลด PDF" style="display:none"/>
                </form>
                <span id="upmsg"></span>
              </td>
            </tr>
            <tr>
              <td align="right" valign="top">รูปภาพประกอบข่าวสาร :</td>
              <td align="left">
                <iframe id="uploadtargetimg" name="uploadtargetimg" src="" style="width:0px;height:0px;border:0"></iframe>
                <form id="frmUploadImage" action="" method="post" enctype="multipart/form-data" onsubmit="return clickuploadimage();" target="uploadtargetimg">
                <input id="fileuploadimage" name="fileuploadimage" type="file" accept="image/*">
                <input type="submit" id="btnUploadImage" name="btnUploadImage" value="อัพโหลดรูปภาพ" style="display:none"/>
                </form>
                <span id="upmsgimg"></span>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editnews" id="editnews" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addnews" id="addnews" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="clearnews" id="clearnews" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelnews" id="cancelnews" value="ยกเลิก" onclick="cancel()"/></td>
            </tr>
      </table>
  <hr />
<br/>
      <div id="listnews" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>