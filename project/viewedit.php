<? session_start(); ?>
<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ดูข้อมูลโครงงานพิเศษ</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
</style>
</head>
<body>
<? include('../connectdatabase.php'); 
$sql = "select * from projecthistory,project where projecthistory.id_project=project.id_project AND id_user='".$_SESSION['iduser']."'";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result)!=0)
{
		?>
<table width="520" border="1" align="center">
      <tr>
        <td colspan="3" align="center" scope="col"><h2>ประวัติการแก้ไขโครงงานพิเศษ</h2></td>
      </tr>
      <tr>
        <th width="94" scope="row">วันที่แก้ไข</th>
        <th width="149">ประเภทการแก้ไข</th>
        <th width="255">ข้อมูลก่อนการแก้ไข</th>
      </tr>
    <?
while($rs = mysqli_fetch_array($result))
{
	?>
      <tr>
        <td align="center" scope="row"><?=$rs[4]?></td>
        <td align="left"><?=$rs[2]?></td>
        <td align="left"><? if($rs[2]=="เพิ่มขอบเขต"||$rs[2]=="ลดขอบเขต"){echo "<a href='".$rs[3]."' target='_blank'>ดู ทก.</a>";}else{echo $rs[3];}?></td>
      </tr>
    <?
}	
}
			  mysqli_close($connect);
	?>
</table>
</body>
</html>