<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
var iddivision;
	$(document).ready(function() {
	var popsrt = Math.random();
$("#listdivision").load("basicdata/show/showdivision.php?pop="+popsrt);
	$("#editdivision").hide();
	$("#canceldivision").hide();
	 });
function add()
{
	var iddiv2 = document.getElementById("iddiv2").value;
	var divisionname = document.getElementById("divisionname").value;
	var divisionsname = document.getElementById("divisionsname").value;
	var facultyid = document.getElementById("facultyid").value;
	var departmentid = document.getElementById("departmentid").value;
	document.getElementById("divisionname").style.borderColor="";
	document.getElementById("divisionsname").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	document.getElementById("iddiv2").style.borderColor="";
	if(iddiv2=="")
	{
		document.getElementById("iddiv2").style.borderColor="#F00";
		document.getElementById("iddiv2").focus();
		return false;
	}
	if(divisionname=="")
	{
		document.getElementById("divisionname").style.borderColor="#F00";
		document.getElementById("divisionname").focus();
		return false;
	}
	else if(divisionsname=="")
	{
		document.getElementById("divisionsname").style.borderColor="#F00";
		document.getElementById("divisionsname").focus();
		return false;
	}
	else if(facultyid=="0")
	{
		document.getElementById("facultyid").style.borderColor="#F00";
		document.getElementById("facultyid").focus();
		return false;
	}
	else if(departmentid=="0")
	{
		document.getElementById("departmentid").style.borderColor="#F00";
		document.getElementById("departmentid").focus();
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
	<?
	include('../connectdatabase.php');
	$sql = "select id_division from division";
	$result = mysqli_query($connect, $sql);
	$mdfive = md5($password);
	while($rs = mysqli_fetch_array($result))
	{
		?>
		if(iddiv2=="<?=$rs[0]?>")
		{
			alert("รหัสสาขานี้มีในระบบแล้ว");		
			document.getElementById("iddiv2").style.borderColor="#F00";
			document.getElementById("iddiv2").style.borderColor="#F00";
			document.getElementById("iddiv2").focus();
			return false;
		}
		<?
	}
	?>
	var str = Math.random();
	var  qstr ="basicdata/add/adddivision.php?pop="+str;
	qstr += "&&divisionname="+encodeURIComponent(divisionname);
	qstr += "&&divisionsname="+encodeURIComponent(divisionsname);
	qstr += "&&facultyid="+facultyid;
	qstr += "&&departmentid="+departmentid;
	qstr += "&&iddiv2="+iddiv2;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listdivision").load("basicdata/show/showdivision.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("iddiv2").value="";
			document.getElementById("divisionname").value="";
			document.getElementById("divisionsname").value="";
			document.getElementById("facultyid").value=0;
			document.getElementById("departmentid").value=0;
			changefaculty(0);
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

}
function cancel()
{
	document.getElementById("divisionname").style.borderColor="";
	document.getElementById("divisionsname").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	document.getElementById("iddiv2").style.borderColor="";
	document.getElementById("divisionname").value="";
	document.getElementById("divisionsname").value="";
	document.getElementById("facultyid").value=0;
	document.getElementById("iddiv2").value="";
	changefaculty(0);
	document.getElementById("iddiv2").disabled = false;
	$("#editdivision").hide();
	$("#canceldivision").hide();
	$("#adddivision").show();
}
function del(iddivision)
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
	var  qstr ="basicdata/del/deldivision.php?id="+iddivision+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listdivision").load("basicdata/show/showdivision.php?pop="+popsrt);
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
function showedit(id,name,sname,idfaculty,iddepartment)
{
	document.getElementById("divisionname").style.borderColor="";
	document.getElementById("divisionsname").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	document.getElementById("iddiv2").style.borderColor="";
	iddivision = id;
	document.getElementById("iddiv2").value = id;
	document.getElementById("divisionname").value = name;
	document.getElementById("divisionsname").value = sname;
	document.getElementById("facultyid").value = idfaculty;
	changefaculty(idfaculty);
	document.getElementById("departmentid").value = iddepartment;
	$("#editdivision").show();
	$("#canceldivision").show();
	$("#adddivision").hide();
	document.getElementById("iddiv2").disabled = true;
}
function edit()
{
	var iddiv2 = document.getElementById("iddiv2").value;
	var editname = document.getElementById("divisionname").value;
	var editsname = document.getElementById("divisionsname").value;
	var facultyid = document.getElementById("facultyid").value;
	var departmentid = document.getElementById("departmentid").value;
	document.getElementById("iddiv2").style.borderColor="";
	document.getElementById("divisionname").style.borderColor="";
	document.getElementById("divisionsname").style.borderColor="";
	document.getElementById("facultyid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	if(iddiv2=="")
	{
		document.getElementById("iddiv2").style.borderColor="#F00";
		document.getElementById("iddiv2").focus();
		return false;
	}
	if(editname=="")
	{
		document.getElementById("divisionname").style.borderColor="#F00";
		document.getElementById("divisionname").focus();
		return false;
	}
	else if(editsname=="")
	{
		document.getElementById("divisionsname").style.borderColor="#F00";
		document.getElementById("divisionsname").focus();
		return false;
	}
	else if(facultyid=="0")
	{
		document.getElementById("facultyid").style.borderColor="#F00";
		document.getElementById("facultyid").focus();
		return false;
	}
	else if(departmentid=="0")
	{
		document.getElementById("departmentid").style.borderColor="#F00";
		document.getElementById("departmentid").focus();
		return false;
	}
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
	var  qstr ="basicdata/edit/editdivision.php?id="+iddivision+"&&iddiv2="+encodeURIComponent(iddiv2)+"&&name="+encodeURIComponent(editname)+"&&facultyid="+facultyid+"&&sname="+encodeURIComponent(editsname)+"&&departmentid="+departmentid+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listdivision").load("basicdata/show/showdivision.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("divisionname").value="";
			document.getElementById("divisionsname").value="";
			document.getElementById("iddiv2").value="";
			document.getElementById("facultyid").value=0;
			document.getElementById("departmentid").value=0;
			changefaculty(0);
			document.getElementById("iddiv2").disabled = false;
			$("#editdivision").hide();
			$("#canceldivision").hide();
			$("#adddivision").show();
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
	document.getElementById("iddiv2").value="";
	document.getElementById("divisionname").value="";
	document.getElementById("divisionsname").value="";
	document.getElementById("facultyid").value=0;
	changefaculty(0);
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลสาขา</h2>
        </center>
  <table border="0" align="center">
            <tr>
              <td align="right">รหัสสาขา :</td>
              <td align="left"><label for="iddiv2"></label>
              <input name="iddiv2" type="text" id="iddiv2" size="5" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อสาขา :</td>
              <td align="left"><label for="divisionname"></label>
              <input type="text" name="divisionname" id="divisionname" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อย่อสาขา :</td>
              <td align="left"><label for="divisionsname">
                <input type="text" name="divisionsname" id="divisionsname" />
              </label></td>
    </tr>
            <tr>
              <td align="right">คณะ :</td>
              <td align="left"><select name="facultyid" id="facultyid" onchange="changefaculty(this.value)">
                <option value="0">--เลือกคณะ--</option>
              <? include('../connectdatabase.php'); 
			  $sql = "select * from faculty";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs[0]?>"><?=$rs[1] ?></option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
              </select></td>
            </tr>
            <tr>
              <td align="right"><p>ภาควิชา :</p></td>
              <td align="left"><select name="departmentid" id="departmentid">
                <option value="0">---เลือกภาควิชา---</option>
              </select></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="editdivision" id="editdivision" value="บันทึก" onclick="edit()"/>
                <input type="button" name="adddivision" id="adddivision" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="divisioncancle" id="divisioncancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="canceldivision" id="canceldivision" value="ยกเลิก"  onclick="cancel()"/></td>
            </tr>
  </table>
  <hr />
<br/>
<div id="listdivision" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>