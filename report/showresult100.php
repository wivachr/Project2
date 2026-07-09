<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
 function cct(t)
{
	var t = document.getElementById("t").value;
	var y = document.getElementById("y").value;
	var s = document.getElementById("s").value;
	var ss = Math.random();
	if(t==-1)
	$("#examstatus").load("report/result100all.php?.php?pop="+ss+"&y="+y+"&s="+s);
	else
	$("#examstatus").load("report/result100.php?.php?pop="+ss+"&teacher="+t+"&y="+y+"&s="+s);
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<h2>ผลการสอบร้อยเปอร์เซ็นต์</h2>
<p>&nbsp;</p>
<p>อาจารย์ที่ปรึกษา : 
  <select name="t" id="t">
          <option value="0">---เลือกอาจารย์---</option>
          <option value="-1">อาจารย์ทั้งหมด</option>
                            <? include('../connectdatabase.php'); 
			  $sql = "select * from teacher order by initials_teacher";
			  $result = mysqli_query($connect, $sql);
			  while($rs = mysqli_fetch_array($result))
			  {
				  ?>
                  <option value="<?=$rs[0]?>">
                    <? echo $rs[5]." ".$rs[3]." ".$rs[4]; ?>
                  </option>
                  <?
			  }
			  mysqli_close($connect);
			  ?>
  </select> 
  ภาคเรียน :
  <select name="s" id="s">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>
<label for="y"></label>
   
  ปีการศึกษา :
  <input name="y" type="text" id="y" size="4" maxlength="4" />
<label for="s"></label>
<input type="button" name="button" id="button" value="ค้นหา" onclick="cct()" />
</p>
<hr />
<div id="examstatus"></div>
<p>&nbsp;</p>
</body>
</html>
