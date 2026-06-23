<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
 function cct()
{
	var y = document.getElementById("y").value;
	var s = document.getElementById("s").value;
	var ss = Math.random();
	$("#examstatus").load("report/case.php?.php?pop="+ss+"&y="+y+"&s="+s);
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<h2>รายชื่อโครงงานพิเศษที่มีกรณีศึกษา</h2>
<p>&nbsp;</p>
<p> 
  ภาคเรียน : 
    <label for="s"></label>
    <select name="s" id="s">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select>
  ปีการศึกษา :
<label for="y"></label>
  <input name="y" type="text" id="y" size="4" maxlength="4" />
  <input type="button" name="button" id="button" value="ค้นหา" onclick="cct()" />
</p>
<hr />
<div id="examstatus"></div>
<p>&nbsp;</p>
</body>
</html>
