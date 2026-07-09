<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
              <? include('../connectdatabase.php');
			  $sql = "select MIN(id_board) from board";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  $first = $rs[0];
			  }
			  mysqli_close($connect);
			  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var idbranch;
	$(document).ready(function() {
	var popsrt = Math.random();
$("#listbranch").load("basicdata/show/showbranch.php?pop="+popsrt);
	$("#editbranch").hide();
	$("#cancelbranch").hide();
	 });
function add()
{
	var branchname = document.getElementById("branchname").value;
	var branchsname = document.getElementById("branchsname").value;
	var boardid = document.getElementById("boardid").value;
	var departmentid = document.getElementById("departmentid").value;
	document.getElementById("branchname").style.borderColor="";
	document.getElementById("branchsname").style.borderColor="";
	document.getElementById("boardid").style.borderColor="";
	document.getElementById("departmentid").style.borderColor="";
	if(branchname=="")
	{
		document.getElementById("branchname").style.borderColor="#F00";
		document.getElementById("branchname").focus();
		return false;
	}
	else if(boardid=="")
	{
		document.getElementById("boardid").style.borderColor="#F00";
		document.getElementById("boardid").focus();
		return false;
	}
	else if(departmentid=="")
	{
		document.getElementById("departmentid").style.borderColor="#F00";
		document.getElementById("departmentid").focus();
		return false;
	}
	else if(branchsname=="")
	{
		document.getElementById("branchsname").style.borderColor="#F00";
		document.getElementById("branchsname").focus();
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
	var  qstr ="basicdata/add/addbranch.php?pop="+str;
	qstr += "&&branchname="+encodeURIComponent(branchname);
	qstr += "&&branchsname="+encodeURIComponent(branchsname);
	qstr += "&&boardid="+boardid;
	qstr += "&&departmentid="+departmentid;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listbranch").load("basicdata/show/showbranch.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("branchname").value="";
			document.getElementById("branchsname").value="";
			document.getElementById("boardid").value=1;
			document.getElementById("departmentid").value=1;
			changeboard(<?= $first ?>);
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
function changeboard(cid)
{
	var id;
	var name;
	var fk;
	var myOption = new Option('','')  
	document.getElementById("departmentid").length = 0;
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
					var myOption = new Option(mySubList[x,1], mySubList[x,0])  
					document.getElementById("departmentid").options[document.getElementById("departmentid").length]= myOption	
				}
				  <?
			  }
			  mysqli_close($connect);
			  ?>

}
function cancel()
{
	document.getElementById("branchname").value="";
	document.getElementById("branchsname").value="";
	document.getElementById("boardid").value=<?= $first ?>;
	changeboard(<?= $first ?>);
	$("#editbranch").hide();
	$("#cancelbranch").hide();
	$("#addbranch").show();
}
function del(idbranch)
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
	var  qstr ="basicdata/del/delbranch.php?id="+idbranch+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listbranch").load("basicdata/show/showbranch.php?pop="+popsrt);
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
function showedit(id,name,sname,idboard,iddepartment)
{
	idbranch = id;
	document.getElementById("branchname").value = name;
	document.getElementById("branchsname").value = sname;
	document.getElementById("boardid").value = idboard;
	changeboard(idboard);
	document.getElementById("departmentid").value = iddepartment;
	$("#editbranch").show();
	$("#cancelbranch").show();
	$("#addbranch").hide();
}
function edit()
{
	var editname = document.getElementById("branchname").value;
	var editsname = document.getElementById("branchsname").value;
	var boardid = document.getElementById("boardid").value;
	var departmentid = document.getElementById("departmentid").value;
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
	var  qstr ="basicdata/edit/editbranch.php?id="+idbranch+"&&name="+encodeURIComponent(editname)+"&&boardid="+boardid+"&&sname="+encodeURIComponent(editsname)+"&&departmentid="+departmentid+"&&pop="+str;
	req.onreadystatechange = function()
	{
		if(req.readyState==4)
		{
			var popsrt = Math.random();
$("#listbranch").load("basicdata/show/showbranch.php?pop="+popsrt);
   			var resultarea= document.getElementById('result');
   			resultarea.innerHTML = req.responseText;
			document.getElementById("branchname").value="";
			document.getElementById("branchsname").value="";
			document.getElementById("boardid").value=1;
			document.getElementById("departmentid").value=1;
			changeboard(<?= $first ?>);
			$("#editbranch").hide();
			$("#cancelbranch").hide();
			$("#addbranch").show();
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
	document.getElementById("branchname").value="";
	document.getElementById("branchsname").value="";
	document.getElementById("boardid").value=<?= $first ?>;
	changeboard(<?= $first ?>);
}
</script>
</head>

<body>
        <center><h2><br />
          จัดการข้อมูลสาขาวิชา</h2>
        </center>
  <table border="0" align="center">
            <tr>
              <td align="right">ชื่อสาขา :</td>
              <td align="left"><label for="branchname"></label>
              <input type="text" name="branchname" id="branchname" /></td>
            </tr>
            <tr>
              <td align="right">ชื่อย่อสาขา :</td>
              <td align="left"><label for="branchsname">
                <input type="text" name="branchsname" id="branchsname" />
              </label></td>
    </tr>
            <tr>
              <td align="right">คณะ :</td>
              <td align="left"><select name="boardid" id="boardid" onchange="changeboard(this.value)">
              <? include('../connectdatabase.php'); 
			  $sql = "select * from board";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                    <option value="<?=$rs[0]?>"><?=$rs[1]?></option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
              </select></td>
            </tr>
            <tr>
              <td align="right"><p>ภาควิชา :</p></td>
              <td align="left"><select name="departmentid" id="departmentid">
                <? include('../connectdatabase.php'); 
			  $sql = "select * from department where id_board=$first";
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
              <td colspan="2" align="center"><input type="button" name="editbranch" id="editbranch" value="บันทึก" onclick="edit()"/>
                <input type="button" name="addbranch" id="addbranch" value="เพิ่ม" onclick="add()"/>
                <input type="button" name="branchcancle" id="branchcancle" value="ล้าง" onclick="cleardata()" />
              <input type="button" name="cancelbranch" id="cancelbranch" value="ยกเลิก"  onclick="cancel()"/></td>
            </tr>
  </table>
  <hr />
<br/>
<div id="listbranch" align="center">กำลังโหลดข้อมูล ....<img width='20' height='20' src=image/indicator_verybig.gif></div>
</body>
</html>