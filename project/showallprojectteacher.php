<? session_start(); ?>
<? include('../change.php'); ?>
<h2>โครงงานพิเศษทั้งหมด</h2>
<p>
  <input type="text" name="sexam" id="sexam" />
  <input type="button" name="searchex" id="searchex" value="ค้นหา" onclick="searchexamp2();"/>
</p>
<table width="74%"  border="1" bordercolor="#000000" cellpadding="0" cellspacing="1">
    <tr>
      <td width="25%"  align="center" bgcolor="#CCCCCC">รหัสโครงงานพิเศษ</td>
      <td width="50%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงานพิเศษ</td>
      <td width="25%"  align="center" bgcolor="#CCCCCC">สถานะโปรเจค</td>
    </tr>
 <? include('../connectdatabase.php');
  if(!isset($start)){
$start = 0;
}
$limit = '10'; // แสดงผลหน้าละกี่หัวข้อ
if(!isset($key)){ $key = ''; }
$sql = mysqli_query($connect, "select * from project,statusproject,committee,teacher where committee.position='ที่ปรึกษา' AND committee.id_project=project.id_project AND committee.id_teacher=teacher.id_teacher  AND project.id_statusproject = statusproject.id_statusproject AND(project.id_project LIKE '%$key%' OR project.name_project LIKE '%$key%' OR statusproject.name_statusproject LIKE '%$key%')  order by project.id_project desc");
$total = mysqli_num_rows($sql);
$Query = mysqli_query($connect, "select * from project,statusproject,committee,teacher where committee.position='ที่ปรึกษา' AND committee.id_project=project.id_project AND committee.id_teacher=teacher.id_teacher AND project.id_statusproject = statusproject.id_statusproject  AND (project.id_project LIKE '%$key%' OR project.name_project LIKE '%$key%' OR statusproject.name_statusproject LIKE '%$key%')   order by project.id_project desc LIMIT $start,$limit"); //คิวรี่คำสั่ง
$totalp = mysqli_num_rows($Query); // หาจำนวน record ที่เรียกออกมา
while($rs = mysqli_fetch_array($Query))
{
?>
<tr>
<td><?=$rs[0]?></td>
<td  align="left"><a href="project/viewproject.php?idview=<?=$rs[0]?>" target="_blank"><?=$rs[1]?></a></td>
<td  align="left"><?=$rs[15]?></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="3" bgcolor="#CCCCCC">&nbsp;</td></tr>
</table>
  <?
/* ตัวแบ่งหน้า */
$page = ceil($total/$limit); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า

/* เอาผลหาร มาวน เป็นตัวเลข เรียงกัน เช่น สมมุติว่าหารได้ 3 เอามาวลก็จะได้ 1 2 3 */
if($page!=1)
{
for($i=1;$i<=$page;$i++){
if(($_GET['page'] ?? null)==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
echo "[<a onclick='cpp2(".$limit*($i-1).",$i)' href='javascript:void(0);'><B>$i</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
}else{
echo "[<a onclick='cpp2(".$limit*($i-1).",$i)'  href='javascript:void(0);'>$i</A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
}
}
}
?>