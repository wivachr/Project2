<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<script type="text/javascript">
var idstudent;
var keys="";
	$(document).ready(function() {
	$("#editstudent").hide();
	$("#cancelstudent").hide();
	if ($("#showmanage").length === 0) {
		var popsrt = Math.random();
		$("#liststudent").load("student/showstudent.php?pop="+popsrt);
	}
	 });
  function cps(l,i)
 {
	var str = Math.random();
	$("#liststudent").load("student/showstudent.php?pop="+str+"&&start="+l+"&&page="+i+"&&key="+encodeURIComponent(keys));
	$("#liststudent").fadeIn();
 }
 function searchexams()
 {
	var str = Math.random();
	keys = document.getElementById("sexam").value;
	$("#liststudent").load("student/showstudent.php?pop="+str+"&&key="+encodeURIComponent(document.getElementById("sexam").value));
	$("#liststudent").fadeIn();
 } 
function add()
{
	var idstudent = document.getElementById("idstudent").value;
	var idtitle = document.getElementById("idtitle").value;
	var namestudent = document.getElementById("namestudent").value;
	var snamestudent = document.getElementById("snamestudent").value;
	var facultyid = document.getElementById("facultyid").value;
	var departmentid = document.getElementById("departmentid").value;
	var divisionid = document.getElementById("divisionid").value;
	var typestudentid = document.getElementById("typestudentid").value;
	document.getElementById("idstudent").style.borderColor="";
	document.getElementById("idtitle").style.borderColor="";
	document.getElementById("namestudent").style.borderColor="";
	document.getElementById("snamestudent").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	document.getElementById("divisionid").style.borderColor="";
	document.getElementById("typestudentid").style.borderColor="";
	if(idstudent=="")
	{
		document.getElementById("idstudent").style.borderColor="#F00";
		document.getElementById("idstudent").focus();
		return false;
	}
	else if(idtitle==0)
	{
		document.getElementById("idtitle").style.borderColor="#F00";
		document.getElementById("idtitle").focus();
		return false;
	}
	else if(namestudent=="")
	{
		document.getElementById("namestudent").style.borderColor="#F00";
		document.getElementById("namestudent").focus();
		return false;
	}
	else if(snamestudent=="")
	{
		document.getElementById("snamestudent").style.borderColor="#F00";
		document.getElementById("snamestudent").focus();
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
	else if(typestudentid==0)
	{
		document.getElementById("typestudentid").style.borderColor="#F00";
		document.getElementById("typestudentid").focus();
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
	var  qstr ="student/addstudent.php?pop="+str;
	qstr += "&&idstudent="+encodeURIComponent(idstudent);
	qstr += "&&idtitle="+encodeURIComponent(idtitle);
	qstr += "&&namestudent="+encodeURIComponent(namestudent);
	qstr += "&&snamestudent="+encodeURIComponent(snamestudent);
	qstr += "&&facultyid="+encodeURIComponent(facultyid);
	qstr += "&&departmentid="+encodeURIComponent(departmentid);
	qstr += "&&divisionid="+encodeURIComponent(divisionid);
	qstr += "&&typestudentid="+encodeURIComponent(typestudentid);
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#liststudent").load("student/showstudent.php?pop="+popsrt);
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
	$("#editstudent").hide();
	$("#cancelstudent").hide();
	$("#addstudent").show();
}
function del(idstudent)
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
	var  qstr ="student/delstudent.php?id="+idstudent+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#liststudent").load("student/showstudent.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editstudent").hide();
			$("#cancelstudent").hide();
			$("#addstudent").show();
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
function showedit(id,title,name,sname,fid,did,dvid,tid)
{
	changefaculty(fid);
	changedepartment(did);
	document.getElementById("idstudent").value=id;
	document.getElementById("idtitle").value=title;
	document.getElementById("namestudent").value=name;
	document.getElementById("snamestudent").value=sname;
	document.getElementById("facultyid").value=fid;
	document.getElementById("departmentid").value=did;
	document.getElementById("divisionid").value=dvid;
	document.getElementById("typestudentid").value=tid;
	$("#editstudent").show();
	$("#cancelstudent").show();
	$("#addstudent").hide();
}
function edit()
{
	var idstudent = document.getElementById("idstudent").value;
	var idtitle = document.getElementById("idtitle").value;
	var namestudent = document.getElementById("namestudent").value;
	var snamestudent = document.getElementById("snamestudent").value;
	var facultyid = document.getElementById("facultyid").value;
	var departmentid = document.getElementById("departmentid").value;
	var divisionid = document.getElementById("divisionid").value;
	var typestudentid = document.getElementById("typestudentid").value;
	document.getElementById("idstudent").style.borderColor="";
	document.getElementById("idtitle").style.borderColor="";
	document.getElementById("namestudent").style.borderColor="";
	document.getElementById("snamestudent").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	document.getElementById("divisionid").style.borderColor="";
	document.getElementById("typestudentid").style.borderColor="";
	if(idstudent=="")
	{
		document.getElementById("idstudent").style.borderColor="#F00";
		document.getElementById("idstudent").focus();
		return false;
	}
	else if(idtitle==0)
	{
		document.getElementById("idtitle").style.borderColor="#F00";
		document.getElementById("idtitle").focus();
		return false;
	}
	else if(namestudent=="")
	{
		document.getElementById("namestudent").style.borderColor="#F00";
		document.getElementById("namestudent").focus();
		return false;
	}
	else if(snamestudent=="")
	{
		document.getElementById("snamestudent").style.borderColor="#F00";
		document.getElementById("snamestudent").focus();
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
	else if(typestudentid==0)
	{
		document.getElementById("typestudentid").style.borderColor="#F00";
		document.getElementById("typestudentid").focus();
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
	var  qstr ="student/editstudent.php?pop="+str;
	qstr += "&&idstudent="+encodeURIComponent(idstudent);
	qstr += "&&idtitle="+encodeURIComponent(idtitle);
	qstr += "&&namestudent="+encodeURIComponent(namestudent);
	qstr += "&&snamestudent="+encodeURIComponent(snamestudent);
	qstr += "&&facultyid="+encodeURIComponent(facultyid);
	qstr += "&&departmentid="+encodeURIComponent(departmentid);
	qstr += "&&divisionid="+encodeURIComponent(divisionid);
	qstr += "&&typestudentid="+encodeURIComponent(typestudentid);	
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
			$("#liststudent").load("student/showstudent.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			cleardata();
			$("#editstudent").hide();
			$("#cancelstudent").hide();
			$("#addstudent").show();
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
	document.getElementById("idstudent").value="";
	document.getElementById("idtitle").value=0;
	document.getElementById("namestudent").value="";
	document.getElementById("snamestudent").value="";
	document.getElementById("facultyid").value=0;
	document.getElementById("departmentid").value=0;
	document.getElementById("divisionid").value=0;
	document.getElementById("typestudentid").value=0;
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
					name = <?=json_encode((string)$rs[1]);?>;
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
	changedepartment(0);
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
					name = <?=json_encode($rs[2]." ".$rs[1]);?>;
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
<center><h2>    จัดการข้อมูลนักศึกษา</h2>
</center>
<table id="tableadd" border="0" align="center">
  <tr>
  <td align="right">รหัสนักศึกษา :</td>
  <td align="left"><input name="idstudent" type="text" id="idstudent" size="13" maxlength="13" /></td>
  </tr>
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
              <td align="right">ชื่อ :</td>
              <td align="left">
              <input name="namestudent" type="text" id="namestudent" size="20" /></td>
            </tr>
            <tr>
              <td align="right">นามสกุล :</td>
              <td align="left">
                <input type="text" name="snamestudent" id="snamestudent" />
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
              <td align="right">หลักสูตร :</td>
              <td align="left"><select name="typestudentid" id="typestudentid">
                                                <option value="0">
                  ---เลือกหลักสูตร---
                  </option>
                <? include('../connectdatabase.php'); 
			  $sql = "select * from curriculum order by id_curr";
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
              </select></td>
    </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editstudent" id="editstudent" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addstudent" id="addstudent" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="clearstudent" id="clearstudent" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelstudent" id="cancelstudent" value="ยกเลิก" onclick="cancel()"/></td>
            </tr>
      </table>
  <hr />
<br/>
      <div id="liststudent" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
      <a name="down" id="down"></a>

