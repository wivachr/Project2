<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
$(document).ready(function() {
		for(var i =1; i<13 ;i++){
		document.getElementById('M'+i).checked=false;
		document.getElementById('T'+i).checked=false;
		document.getElementById('W'+i).checked=false;
		document.getElementById('H'+i).checked=false;
		document.getElementById('F'+i).checked=false;
		}
	<? include('../connectdatabase.php'); 
	$sql = "select * from teacherfreetime where id_teacher = $id";
	$result = mysqli_query($connect, $sql);
	while($result && $rs = mysqli_fetch_array($result))
	{

		if($rs[0]=="1")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('M'+i).checked = true;
				<?
			}
			}
		}
		if($rs[0]=="2")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('T'+i).checked = true;
				<?
			}
			}
		}
		if($rs[0]=="3")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('W'+i).checked = true;
				<?
			}
			}
		}
		if($rs[0]=="4")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('H'+i).checked = true;
				<?
			}
			}
		}
		if($rs[0]=="5")
		{
			for($r=1;$r<14;$r++)
			{
			if($rs[1]==$r)
			{
				?>
				var i = <?=$r ?> ;
				document.getElementById('F'+i).checked = true;
				<?
			}
			}
		}
	}
	mysqli_close($connect);
	?>
	 });
</script>
<title></title>
</head>

<body>
<table width="100%" border="1">
  <tr>
    <td width="10%" align="center">Day</td>
    <td width="6%" align="center">8:00 </td>
    <td width="6%" align="center">9:00 </td>
    <td width="6%" align="center">10:00</td>
    <td width="6%" align="center">11:00</td>
    <td width="6%" align="center">12:00</td>
    <td width="6%" align="center">13:00</td>
    <td width="6%" align="center">14:00</td>
    <td width="6%" align="center">15:00</td>
    <td width="6%" align="center">16:00</td>
    <td width="6%" align="center">17:00</td>
    <td width="6%" align="center">18:00</td>
    <td width="6%" align="center">19:00</td>
    <td width="6%" align="center">20:00</td>
  </tr>
  <tr>
    <td align="center">M</td>
    <td align="center"><input type="checkbox" name="M1" id="M1" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M2" id="M2" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M3" id="M3" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M4" id="M4" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M5" id="M5" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M6" id="M6" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M7" id="M7" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M8" id="M8" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M9" id="M9" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M10" id="M10" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M11" id="M11" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M12" id="M12" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="M13" id="M13" onclick="save(this.name,this.checked)"/></td>
  </tr>
  <tr>
    <td align="center">T</td>
    <td align="center"><input type="checkbox" name="T1" id="T1" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T2" id="T2" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T3" id="T3" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T4" id="T4" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T5" id="T5" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T6" id="T6" onclick="save(this.name,this.checked)" /></td>
    <td align="center"><input type="checkbox" name="T7" id="T7" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T8" id="T8" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T9" id="T9" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T10" id="T10" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T11" id="T11" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T12" id="T12" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="T13" id="T13" onclick="save(this.name,this.checked)"/></td>
  </tr>
  <tr>
    <td align="center">W</td>
    <td align="center"><input type="checkbox" name="W1" id="W1" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W2" id="W2" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W3" id="W3" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W4" id="W4" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W5" id="W5" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W6" id="W6" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W7" id="W7" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W8" id="W8" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W9" id="W9" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W10" id="W10" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W11" id="W11" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W12" id="W12" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="W13" id="W13" onclick="save(this.name,this.checked)"/></td>
  </tr>
  <tr>
    <td align="center">H</td>
    <td align="center"><input type="checkbox" name="H1" id="H1" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H2" id="H2" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H3" id="H3" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H4" id="H4" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H5" id="H5" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H6" id="H6" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H7" id="H7" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H8" id="H8" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H9" id="H9" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H10" id="H10" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H11" id="H11" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H12" id="H12" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="H13" id="H13" onclick="save(this.name,this.checked)"/></td>
  </tr>
  <tr>
    <td align="center">F</td>
    <td align="center"><input type="checkbox" name="F1" id="F1" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F2" id="F2" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F3" id="F3" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F4" id="F4" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F5" id="F5" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F6" id="F6" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F7" id="F7" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F8" id="F8" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F9" id="F9" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F10" id="F10" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F11" id="F11" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F12" id="F12" onclick="save(this.name,this.checked)"/></td>
    <td align="center"><input type="checkbox" name="F13" id="F13" onclick="save(this.name,this.checked)"/></td>
  </tr>
</table>
<p>
  <input type="submit" name="button" id="button" value="บันทึกเวลาว่าง" onclick="managefreetime();" />
  <br />
</p>
</body>
</html>