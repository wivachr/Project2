<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>
<body>
<?
if($_FILES['fileField']['type']!="text/plain")
{
	?>
    <script language="javascript">
		window.parent.importfalse();
	</script>
    <?
}
else
{
include('../connectdatabase.php');
$data=file($_FILES['fileField']['tmp_name']);  // ข้อมูลที่ได้จากการใช้ Function file() จะได้ออกมาเป็น Array แต่ละบัีนทัดข้อมูลที่เก็บใน File คือ 1 ค่า index ของ Array
for($i=1;$i<count($data);$i++){  // วนรอบเพื่อแสดงผลขอ้มูล
$regis = explode(",", $data[$i]);
//echo $regis[0]." ".$regis[1]." ".$regis[2]." ".$regis[3]." ".$regis[4]."<br/>";
	
	$sql = "insert into student values('".$regis[0]."','".$regis[1]."','".$regis[2]."','".$regis[3]."','".$regis[9]."','".$regis[10]."','".$regis[11]."','".$regis[8]."')";
	mysqli_query($connect, $sql);
}
mysqli_close($connect);
?>
<script language="javascript">
window.parent.importok();
</script>
<? } ?>
</body>
</html>