<? include('../change.php'); ?>
<h2>ดูข้อมูลการสอบ</h2>
<p>
  <label for="sexam"></label>
  <input type="text" name="sexam" id="sexam" />
  <input type="button" name="searchex" id="searchex" value="ค้นหา" onclick="searchexam();"/>
</p>
<table width="100%" border="1" bordercolor="#000000" cellpadding="0" cellspacing="1">
    <tr>
    <td width="7%"  align="center" bgcolor="#CCCCCC">รหัสโครงงาน</td>
      <td width="33%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงาน</td>
      <td width="6%"  align="center" bgcolor="#CCCCCC">วันที่ยื่นสอบ</td>
      <td width="9%"  align="center" bgcolor="#CCCCCC">ประเภทการสอบ</td>
      <td width="10%"  align="center" bgcolor="#CCCCCC">สถานะการยื่นสอบ</td>
       <td width="35%"  align="center" bgcolor="#CCCCCC">ความคิดเห็นของคณะกรรมการ</td>
    </tr>
 <? include('../connectdatabase.php');
 if(!isset($start)){ $start = 0; }
 if(!isset($key)){ $key = ''; }
$limit = '20'; // แสดงผลหน้าละกี่หัวข้อ
$sql = mysqli_query($connect, "select project.id_project,project.name_project,exam.date_submitexam,typeexam.name_typeexam,statusproject.name_statusproject,comment_exam from exam,typeexam,project,statusproject where statusproject.id_statusproject=exam.id_statusproject AND exam.id_typeexam=typeexam.id_typeexam AND exam.id_project = project.id_project AND(project.name_project LIKE '%$key%' OR exam.date_submitexam LIKE '%$key%' OR typeexam.name_typeexam LIKE '%$key%' OR exam.id_statusproject LIKE '%$key%' OR project.id_project LIKE '%$key%')");
$total = mysqli_num_rows($sql);
$Query = mysqli_query($connect, "select project.id_project,project.name_project,exam.date_submitexam,typeexam.name_typeexam,statusproject.name_statusproject,comment_exam from exam,typeexam,project,statusproject where statusproject.id_statusproject=exam.id_statusproject AND exam.id_typeexam=typeexam.id_typeexam AND exam.id_project = project.id_project AND(project.name_project LIKE '%$key%' OR exam.date_submitexam LIKE '%$key%' OR typeexam.name_typeexam LIKE '%$key%' OR exam.id_statusproject LIKE '%$key%' OR project.id_project LIKE '%$key%') LIMIT $start,$limit"); //คิวรี่คำสั่ง
$totalp = mysqli_num_rows($Query); // หาจำนวน record ที่เรียกออกมา
while($rs = mysqli_fetch_array($Query))
{
	$date2 = explode("-", $rs[2]);
?>
<tr>
<td align="center"><?=$rs[0]?></td>
<td align="left"><?=$rs[1]?></td>
<td align="center"><? if($rs[2]=="0000-00-00"){echo "ยังไม่ได้ยื่นเรื่อง";}else{echo $date2[2]."/".$date2[1]."/".$date2[0];}?></td>
<td align="left"><?=$rs[3]?></td>
<td align="left"><?=$rs[4]?></td>
<td align="left" valign="top"><? if($rs[5]==""){echo "ไม่มีความคิดเห็น";}else{echo nl2br($rs[5]);}?></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="6" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
  <?
/* ตัวแบ่งหน้า */
$page = ceil($total/$limit); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า

/* เอาผลหาร มาวน เป็นตัวเลข เรียงกัน เช่น สมมุติว่าหารได้ 3 เอามาวลก็จะได้ 1 2 3 */
if($page!=1)
{
for($i=1;$i<=$page;$i++){
if(($_GET['page'] ?? null)==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
echo "[<a onclick='cp(".$limit*($i-1).",$i)' href='javascript:void(0);'><B>$i</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
}else{
echo "[<a onclick='cp(".$limit*($i-1).",$i)'  href='javascript:void(0);'>$i</A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
}
}
}
?>