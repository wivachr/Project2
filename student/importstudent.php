<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function subc()
{
	document.getElementById("showup").innerHTML = "กำลังนำเข้าข้อมูลกรุณารอสักครู่";
	var form1 = document.forms['form1'];
	form1.submit();
}
function importok(summary)
{
	document.getElementById("showup").innerHTML = summary.split("|").join("<br/>");
	document.getElementById("fileField").value = "";
}
function importfalse()
{
	document.getElementById("showup").innerHTML = "กรุณาเลือกไฟล์ประเภท Excel (.xlsx)";
	document.getElementById("fileField").value = "";
}
</script>
<title></title>
</head>

<body>
  <center>
    <h2>นำเข้าข้อมูลนักศึกษา</h2>
  </center>
 <iframe id="uploadtarget" name="uploadtarget" src="" style="width:100px;height:0px;border:0px"></iframe>
<form action="student/importingstudent.php" method="post" enctype="multipart/form-data" name="form1" target="uploadtarget">
  <table border="0" align="center">
  <tr>
    <td align="right">ข้อมูลนักศึกษา(.xlsx) :</td>
    <td align="right"><label for="fileField"></label>
    <input type="file" name="fileField" id="fileField" accept=".xlsx"/>

    </td>
  </tr>
      </table>
  <input type="submit" name="button" id="button" value="นำเข้าข้อมูลนักศึกษา" onclick="subc(); return false;" />
</form>
<span id="showup"></span>
<p style="color:#888; font-size:11px;">
คอลัมน์ที่ต้องมีในไฟล์ (แถวแรกเป็นหัวตาราง): เลขประจำตัวนักศึกษา, คำนำหน้า, ชื่อ, นามสกุล, คณะ, ภาควิชา, สาขาวิชา, หลักสูตร<br/>
ระบบจะจับคู่คำนำหน้า/คณะ/ภาควิชา/สาขาวิชา/หลักสูตร กับข้อมูลที่มีอยู่แล้วในระบบ และข้ามรายการที่มีเลขประจำตัวซ้ำหรือจับคู่ข้อมูลไม่ได้ พร้อมแจ้งสรุปผล
</p>
</body>
</html>
