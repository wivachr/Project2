<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var keyt="";
var idteacher;
	$(document).ready(function() {
	$("#editteacher").hide();
	$("#cancelteacher").hide();
	if ($("#showmanage").length === 0) {
		var popsrt = Math.random();
		$("#listteacher").load("teacher/showteacher.php?pop="+popsrt);
	}
	 });
  function cpt(l,i)
 {
	var str = Math.random();
	$("#listteacher").load("teacher/showteacher.php?pop="+str+"&&start="+l+"&&page="+i+"&&key="+encodeURIComponent(keyt));
	$("#listteacher").fadeIn();
 }
 function searchexamt()
 {
	var str = Math.random();
	keyt = document.getElementById("sexam").value;
	$("#listteacher").load("teacher/showteacher.php?pop="+str+"&&key="+encodeURIComponent(document.getElementById("sexam").value));
	$("#listteacher").fadeIn();
 } 
function add()
{
	var idtitle = document.getElementById("idtitle").value;
	var idititle = document.getElementById("idititle").value;
	var nameteacher = document.getElementById("nameteacher").value;
	var snameteacher = document.getElementById("snameteacher").value;
	var initialsteacher = document.getElementById("initialsteacher").value;
	var facultyid = document.getElementById("facultyid").value;
	var departmentid = document.getElementById("departmentid").value;
	var divisionid = document.getElementById("divisionid").value;
	var telteacher = document.getElementById("telteacher").value;
	var emailteacher = document.getElementById("emailteacher").value;
	document.getElementById("idtitle").style.borderColor="";
	document.getElementById("nameteacher").style.borderColor="";
	document.getElementById("snameteacher").style.borderColor="";
	document.getElementById("initialsteacher").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	document.getElementById("divisionid").style.borderColor="";
	document.getElementById("telteacher").style.borderColor="";
	document.getElementById("emailteacher").style.borderColor="";

	if(idtitle==0)
	{
		document.getElementById("idtitle").style.borderColor="#F00";
		document.getElementById("idtitle").focus();
		return false;
	}
	else if(idititle==0)
	{
		document.getElementById("idititle").style.borderColor="#F00";
		document.getElementById("idititle").focus();
		return false;
	}
	else if(nameteacher=="")
	{
		document.getElementById("nameteacher").style.borderColor="#F00";
		document.getElementById("nameteacher").focus();
		return false;
	}
	else if(snameteacher=="")
	{
		document.getElementById("snameteacher").style.borderColor="#F00";
		document.getElementById("snameteacher").focus();
		return false;
	}
	else if(initialsteacher=="")
	{
		document.getElementById("initialsteacher").style.borderColor="#F00";
		document.getElementById("initialsteacher").focus();
		return false;
	}
	else if(facultyid==0)
	{
		document.getElementById("facultyid").style.borderColor="#F00";
		document.getElementById("facultyid").focus();
		return false;
	}
	else if(departmentid==0)
	{
		document.getElementById("departmentid").style.borderColor="#F00";
		document.getElementById("departmentid").focus();
		return false;
	}
	else if(divisionid==0)
	{
		document.getElementById("divisionid").style.borderColor="#F00";
		document.getElementById("divisionid").focus();
		return false;
	}
	else if(telteacher=="")
	{
		document.getElementById("telteacher").style.borderColor="#F00";
		document.getElementById("telteacher").focus();
		return false;
	}
	else if(emailteacher=="")
	{
		document.getElementById("emailteacher").style.borderColor="#F00";
		document.getElementById("emailteacher").focus();
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
	var  qstr ="teacher/addteacher.php?pop="+str;
	qstr += "&&idtitle="+encodeURIComponent(idtitle);
	qstr += "&&idititle="+encodeURIComponent(idititle);
	qstr += "&&nameteacher="+encodeURIComponent(nameteacher);
	qstr += "&&snameteacher="+encodeURIComponent(snameteacher);
	qstr += "&&initialsteacher="+encodeURIComponent(initialsteacher);
	qstr += "&&facultyid="+encodeURIComponent(facultyid);
	qstr += "&&departmentid="+encodeURIComponent(departmentid);
	qstr += "&&divisionid="+encodeURIComponent(divisionid);
	qstr += "&&telteacher="+encodeURIComponent(telteacher);
	qstr += "&&emailteacher="+encodeURIComponent(emailteacher);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listteacher").load("teacher/showteacher.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
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

function cancel()
{
	cleardata();
	$("#editteacher").hide();
	$("#cancelteacher").hide();
	$("#addteacher").show();
}
function del(idteacher,u)
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
	var  qstr ="teacher/delteacher.php?u="+u+"&id="+idteacher+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listteacher").load("teacher/showteacher.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editteacher").hide();
			$("#cancelteacher").hide();
			$("#addteacher").show();
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
function showedit(id,title,ititle,name,sname,iname,fid,did,dvid,tel,email)
{
	changefaculty(fid);
	changedepartment(did);
	idteacher=id;
	document.getElementById("idtitle").value=title;
	document.getElementById("idititle").value=ititle;
	document.getElementById("nameteacher").value=name;
	document.getElementById("snameteacher").value=sname;
	document.getElementById("initialsteacher").value=iname;
	document.getElementById("facultyid").value=fid;
	document.getElementById("departmentid").value=did;
	document.getElementById("divisionid").value=dvid;
	document.getElementById("telteacher").value=tel;
	document.getElementById("emailteacher").value=email;
	$("#editteacher").show();
	$("#cancelteacher").show();
	$("#addteacher").hide();
}
function edit()
{
	var idteachere = idteacher;
	var idtitle = document.getElementById("idtitle").value;
	var idititle = document.getElementById("idititle").value;
	var nameteacher = document.getElementById("nameteacher").value;
	var snameteacher = document.getElementById("snameteacher").value;
	var inameteacher = document.getElementById("initialsteacher").value;
	var facultyid = document.getElementById("facultyid").value;
	var departmentid = document.getElementById("departmentid").value;
	var divisionid = document.getElementById("divisionid").value;
	var telteacher = document.getElementById("telteacher").value;
	var emailteacher = document.getElementById("emailteacher").value;
	document.getElementById("idtitle").style.borderColor="";
	document.getElementById("nameteacher").style.borderColor="";
	document.getElementById("snameteacher").style.borderColor="";
	document.getElementById("initialsteacher").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	document.getElementById("divisionid").style.borderColor="";
	document.getElementById("telteacher").style.borderColor="";
	document.getElementById("emailteacher").style.borderColor="";

	if(idtitle==0)
	{
		document.getElementById("idtitle").style.borderColor="#F00";
		document.getElementById("idtitle").focus();
		return false;
	}
	else if(idititle==0)
	{
		document.getElementById("idititle").style.borderColor="#F00";
		document.getElementById("idititle").focus();
		return false;
	}
	else if(nameteacher=="")
	{
		document.getElementById("nameteacher").style.borderColor="#F00";
		document.getElementById("nameteacher").focus();
		return false;
	}
	else if(snameteacher=="")
	{
		document.getElementById("snameteacher").style.borderColor="#F00";
		document.getElementById("snameteacher").focus();
		return false;
	}
	else if(inameteacher=="")
	{
		document.getElementById("initialsteacher").style.borderColor="#F00";
		document.getElementById("initialsteacher").focus();
		return false;
	}
	else if(facultyid==0)
	{
		document.getElementById("facultyid").style.borderColor="#F00";
		document.getElementById("facultyid").focus();
		return false;
	}
	else if(departmentid==0)
	{
		document.getElementById("departmentid").style.borderColor="#F00";
		document.getElementById("departmentid").focus();
		return false;
	}
	else if(divisionid==0)
	{
		document.getElementById("divisionid").style.borderColor="#F00";
		document.getElementById("divisionid").focus();
		return false;
	}
	else if(telteacher=="")
	{
		document.getElementById("telteacher").style.borderColor="#F00";
		document.getElementById("telteacher").focus();
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
	var  qstr ="teacher/editteacher.php?pop="+str;
	qstr += "&&id="+encodeURIComponent(idteachere);
	qstr += "&&idtitle="+encodeURIComponent(idtitle);
	qstr += "&&idititle="+encodeURIComponent(idititle);
	qstr += "&&nameteacher="+encodeURIComponent(nameteacher);
	qstr += "&&snameteacher="+encodeURIComponent(snameteacher);
	qstr += "&&initialsteacher="+encodeURIComponent(inameteacher);
	qstr += "&&facultyid="+encodeURIComponent(facultyid);
	qstr += "&&departmentid="+encodeURIComponent(departmentid);
	qstr += "&&divisionid="+encodeURIComponent(divisionid);
	qstr += "&&telteacher="+encodeURIComponent(telteacher);
	qstr += "&&emailteacher="+encodeURIComponent(emailteacher);	
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#listteacher").load("teacher/showteacher.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editteacher").hide();
			$("#cancelteacher").hide();
			$("#addteacher").show();
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
	document.getElementById("idtitle").value=0;
	document.getElementById("idititle").value=0;
	document.getElementById("nameteacher").value="";
	document.getElementById("snameteacher").value="";
	document.getElementById("initialsteacher").value="";
	document.getElementById("facultyid").value=0;
	document.getElementById("departmentid").value=0;
	document.getElementById("divisionid").value=0;
	document.getElementById("telteacher").value="";
	document.getElementById("emailteacher").value="";
	changefaculty(0);
	changedepartment(0)
}
function changefaculty(cid)
{
	var id;
	var name;
	var fk;
	var myOption = new Option('','')  
	document.getElementById("departmentid").length = 0;
		myOption = new Option("---เลือกภาควิชา---",0)  
	document.getElementById("departmentid").options[0]= myOption
                <? include('../connectdatabase.php'); 
				$intRows = 0;
			  $sql = "select * from department";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
					x = <?=$intRows;?>;
					mySubList = new Array();
					id = <?=$rs[0];?>;
					name = "<?=$rs[1];?>";
					fk = "<?=$rs[3];?>";
					mySubList[x,0] = id;
					mySubList[x,1] = name;
					mySubList[x,2] = fk;
				if (mySubList[x,2] == cid){
					myOption = new Option(mySubList[x,1], mySubList[x,0])  
					document.getElementById("departmentid").options[document.getElementById("departmentid").length]= myOption	
				}
				  <?
			  }
			  mysqli_close($connect);
			  ?>
			 changedepartment(0)
}
function changedepartment(cid)
{
	var id;
	var name;
	var fk;
	var myOption = new Option('','')  
	document.getElementById("divisionid").length = 0;
		myOption = new Option("---เลือกสาขาวิชา---",0)  
	document.getElementById("divisionid").options[0]= myOption
                <? include('../connectdatabase.php'); 
				$intRows = 0;
			  $sql = "select * from division";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
					x = <?=$intRows;?>;
					mySubList = new Array();
					id = <?=$rs[0];?>;
					name = "<?=$rs[2]." ".$rs[1];?>";
					fk = "<?=$rs[4];?>";
					mySubList[x,0] = id;
					mySubList[x,1] = name;
					mySubList[x,2] = fk;
				if (mySubList[x,2] == cid){
					myOption = new Option(mySubList[x,1], mySubList[x,0])  
					document.getElementById("divisionid").options[document.getElementById("divisionid").length]= myOption	
				}
				  <?
			  }
			  mysqli_close($connect);
			  ?>

}
</script>
<title></title>
</head>

<body>
  <center><h2>    จัดการข้อมูลอาจารย์</h2>
  </center>
  <table border="0" align="center">
            <tr>
              <td align="right">คำนำหน้าชื่อ :</td>
              <td align="left">
                <select name="idtitle" id="idtitle">
                <option value="0">
                    ---เลือกคำนำหน้าชื่อ---
                  </option>
                  <? include('../connectdatabase.php'); 
			  $sql = "select * from title order by id_title";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs[0]?>">
                    <?=$rs[1]?>
                  </option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td align="right">คำนำหน้าชื่อทางวิชาการ :</td>
              <td align="left">
                <select name="idititle" id="idititle">
                <option value="0">
                    ---เลือกคำนำหน้าชื่อ---
                  </option>
                  <? include('../connectdatabase.php'); 
			  $sql = "select * from academictitle order by id_academictitle";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs[0]?>">
                    <?=$rs[1]?>
                  </option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
                </select>
              </td>
            </tr>
<tr>
              <td align="right">ชื่อ :</td>
              <td align="left">
              <input type="text" name="nameteacher" id="nameteacher" /></td>
            </tr>
            <tr>
              <td align="right">นามสกุล :</td>
              <td align="left">
                <input type="text" name="snameteacher" id="snameteacher" />
              </td>
            </tr>
            <tr>
              <td align="right">ชื่อย่อ :</td>
              <td align="left">
                <input type="text" name="initialsteacher" id="initialsteacher" />
              </td>
            </tr>
            <tr>
              <td align="right">คณะ :</td>
              <td align="left">
                <select name="facultyid" id="facultyid" onchange="changefaculty(this.value)">
                  <option value="0">
                  ---เลือกคณะ---
                  </option>
                  <? include('../connectdatabase.php'); 
			  $sql = "select * from faculty  order by id_faculty";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs[0]?>">
                    <?=$rs[1]?>
                  </option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
                </select>
              </td>
            </tr>
                <td align="right">ภาควิชา :</td>
              <td align="left">
                <select name="departmentid" id="departmentid" onchange="changedepartment(this.value)">
                                  <option value="0">
                  ---เลือกภาควิชา---
                  </option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="right">สาขาวิชา :</td>
              <td align="left">
                <select name="divisionid" id="divisionid">
                                                  <option value="0">
                  ---เลือกสาขาวิชา---
                  </option>
              </select></td>
            </tr>
            <tr>
              <td align="right">เบอร์โทรศัพท์ :</td>
              <td align="left"><label for="telteacher"></label>
              <input type="text" name="telteacher" id="telteacher" /></td>
    </tr>
            <tr>
              <td align="right">อีเมลล์อาจารย์ :</td>
              <td align="left"><input type="text" name="emailteacher" id="emailteacher" /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editteacher" id="editteacher" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addteacher" id="addteacher" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="clearteacher" id="clearteacher" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelteacher" id="cancelteacher" value="ยกเลิก" onclick="cancel()"/></td>
            </tr>
</table>
  <hr />
<br/>
<div id="listteacher" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
<a name="down" id="down"></a>
</body>
</html>