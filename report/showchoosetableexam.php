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

	var ss = Math.random();
	if(t==-1)
	$("#examstatus").load("report/showtableexam.php?.php?pop="+ss);
	else
	$("#examstatus").load("report/showtableexamfix.php?.php?pop="+ss+"&t="+t);
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<h2>ตารางสอบ</h2>
<p>&nbsp;</p>
<p>อาจารย์ : 
  <select name="t" id="t" onchange="cct(this.value)">
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
</p>
<hr />
<div id="examstatus"></div>
<p>&nbsp;</p>
</body>
</html>
