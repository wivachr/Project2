<? session_start(); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<?php
$key   = isset($_GET['key'])   ? $_GET['key']   : '';
$ch    = isset($_GET['ch'])    ? $_GET['ch']    : '';
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
?>
<p>
  <input type="text" name="sexam" id="sexam" />
  <input type="button" name="searchex" id="searchex" value="ค้นหา" onclick="searchexamp();"/><p align="center"><input name="all" type="checkbox" id="all" <? if($ch=="")echo 'checked="checked"'?> onclick="cchange()"/>  เลือกเฉพาะโครงงานพิเศษที่กำลังดำเนินการเท่านั้น</p>
</p>
<table width="100%" border="1" bordercolor="#000000" cellpadding="0" cellspacing="1">
    <tr>
      <td width="12%"  align="center" bgcolor="#CCCCCC">รหัสโครงงาน</td>
      <td width="42%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงาน</td>
      <td width="24%"  align="center" bgcolor="#CCCCCC">สถานะโครงงาน</td>
      <td width="8%"  align="center" bgcolor="#CCCCCC"></td>
      <td width="5%"  align="center" bgcolor="#CCCCCC"></td>
      <td width="9%"  align="center" bgcolor="#CCCCCC"></td>
      <td width="5%"  align="center" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../connectdatabase.php');
$limit = '20'; // แสดงผลหน้าละกี่หัวข้อ
$key = mysqli_real_escape_string($connect, $key);
$subWhere = "(p2.id_project LIKE '%$key%' OR p2.name_project LIKE '%$key%' OR m.id_student LIKE '%$key%' OR s.name_student LIKE '%$key%' OR s.sname_student LIKE '%$key%' OR CONCAT(ti.name_title,s.name_student,' ',s.sname_student) LIKE '%$key%' OR CONCAT(s.name_student,' ',s.sname_student) LIKE '%$key%')";
$sub = "SELECT DISTINCT p2.id_project FROM project p2 LEFT JOIN manipulator m ON m.id_project=p2.id_project LEFT JOIN student s ON m.id_student=s.id_student LEFT JOIN title ti ON s.id_title=ti.id_title WHERE $subWhere";
if($ch=="")
{
$statusFilter = "AND (project.id_statusproject<>'0' AND project.id_statusproject<>'16' AND project.id_statusproject<>'17' AND project.id_statusproject<>'18')";
$sql = mysqli_query($connect, "SELECT project.*,statusproject.* FROM project JOIN statusproject ON project.id_statusproject=statusproject.id_statusproject WHERE project.id_project IN ($sub) $statusFilter ORDER BY project.id_project DESC");
$total = mysqli_num_rows($sql);
$Query = mysqli_query($connect, "SELECT project.*,statusproject.* FROM project JOIN statusproject ON project.id_statusproject=statusproject.id_statusproject WHERE project.id_project IN ($sub) $statusFilter ORDER BY project.id_project DESC LIMIT $start,$limit");
}
else
{
$sql = mysqli_query($connect, "SELECT project.*,statusproject.* FROM project JOIN statusproject ON project.id_statusproject=statusproject.id_statusproject WHERE project.id_project IN ($sub) ORDER BY project.id_project DESC");
$total = mysqli_num_rows($sql);
$Query = mysqli_query($connect, "SELECT project.*,statusproject.* FROM project JOIN statusproject ON project.id_statusproject=statusproject.id_statusproject WHERE project.id_project IN ($sub) ORDER BY project.id_project DESC LIMIT $start,$limit");
}
if(!$Query){ echo "<p style='color:red'>SQL Error: ".mysqli_error($connect)."</p>"; }
$totalp = mysqli_num_rows($Query); // หาจำนวน record ที่เรียกออกมา
while($rs = mysqli_fetch_array($Query))
{
?>
<tr>
<td align="center"><?=$rs[0]?></td>
<td  align="left"><?=$rs[1]?></td>
<td  align="left"><?=$rs[17]?></td>
<td><a name="<?=$rs[0]?>"></a><a href="project/viewproject.php?idview=<?=$rs[0]?>" target="_blank">ดูรายละเอียด</a></td>
<td align="center"><a name="d<?=$rs[0]?>"></a><a href="javascript:void(0);" onClick="editproject(<?=$rs[0]?>)">แก้ไข</a></td><td><a href="javascript:void(0);" onClick="reset1(<?=$rs[11]?>,<?=$rs[0]?>)">รีเซ็ทรหัสผ่าน</a></td>
<td><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ยกเลิก</a></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="7" bgcolor="#CCCCCC">&nbsp;</td></tr>
</table>
  <?
/* ตัวแบ่งหน้า */
$page = ceil($total/$limit); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า

/* เอาผลหาร มาวน เป็นตัวเลข เรียงกัน เช่น สมมุติว่าหารได้ 3 เอามาวลก็จะได้ 1 2 3 */
if($page!=1)
{
for($i=1;$i<=$page;$i++){
if(($_GET['page'] ?? null)==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
echo "[<a onclick='cpp(".$limit*($i-1).",$i)' href='javascript:void(0);'><B>$i</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
}else{
echo "[<a onclick='cpp(".$limit*($i-1).",$i)'  href='javascript:void(0);'>$i</A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
}
}
}
?>