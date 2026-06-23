<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
 function cct(t)
{
	var s = Math.random();
	$("#examstatus").load("report/tablestatusproject.php?pop="+s+"&teacher="+t);
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<h2>สถานะโครงงานพิเศษ</h2>
<p><select name="idteacher" id="idteacher" onchange="cct(this.value)">
          <option value="0">---เลือกอาจารย์---</option>
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
        </select></p>
<hr />
<div id="examstatus"></div>
<p>&nbsp;</p>
</body>
</html>
