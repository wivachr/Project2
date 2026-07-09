<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['iduser'])) { exit; } ?>
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
$sql = "select * from exam,typeexam,project,statusproject where statusproject.id_statusproject = exam.id_statusproject AND id_user='".$_SESSION['iduser']."' AND exam.id_typeexam=typeexam.id_typeexam AND exam.id_project=project.id_project";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result)!=0)
{
	?>
    <table width="520" border="1" align="center">
      <tr>
        <td colspan="4" align="center" scope="col"><h2>ประวัติการสอบ</h2></td>
      </tr>
      <tr>
        <th width="107" scope="row">ประเภทการสอบ</th>
        <th width="74">วันที่สอบ</th>
        <th width="87">สถานะการสอบ</th>
        <th width="204">ความคิดเห็นของคณะกรรมการ</th>
      </tr>
    <?
while($rs = mysqli_fetch_array($result))
{
	?>
      <tr>
        <td align="left" scope="row"><?=$rs[9]?></td>
        <td><? if($rs[3]=="0000-00-00"){echo "ยังไม่ได้ยื่นเรื่อง";}else{echo $rs[3];}?></td>
        <td align="left"><?=$rs[25]?></td>
        <td align="left"><? if($rs[5]==""){echo "ไม่มีความคิดเห็น";}else{echo nl2br($rs[5]);}?></td>
      </tr>
    <?
}
?></table> 
<?
}

			  mysqli_close($connect);
			  ?>
</body>
</html>