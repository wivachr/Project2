<? include('../change.php'); ?>
<p>
  <input type="text" name="sexam" id="sexam" />
  <input type="button" name="searchex" id="searchex" value="ค้นหา" onclick="searchexamr();"/>
</p>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td  align="center" bgcolor="#CCCCCC">ปีการศึกษา</td>
      <td  align="center" bgcolor="#CCCCCC">ภาคเรียน</td>
      <td  align="center" bgcolor="#CCCCCC">รหัสนักศึกษา</td>
      <td  align="center" bgcolor="#CCCCCC" >ชื่อนักศึกษา</td>
		<td  align="center" bgcolor="#CCCCCC">นามสกุลนักศึกษา</td>
      <td  align="center" bgcolor="#CCCCCC">รหัสวิชา</td>
       <td  align="center" bgcolor="#CCCCCC">ชื่อวิชา</td>
      <td  align="center" bgcolor="#CCCCCC">ตอน</td>
      <td  align="center" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../connectdatabase.php');
  if(!isset($start)){ $start = 0; }
  if(!isset($key)){ $key = ''; }
$limit = '20'; // แสดงผลหน้าละกี่หัวข้อ
$sql = mysqli_query($connect, "select * from registration,student,subject where subject.id_subject=registration.id_subject AND registration.id_student=student.id_student AND(year_registration LIKE '%$key%' OR semester_registration LIKE '%$key%' OR subject.id_subject LIKE '%$key%' OR section LIKE '%$key%' OR name_subject LIKE '%$key%' OR name_student LIKE '%$key%' OR sname_student LIKE '%$key%' OR student.id_student LIKE '%$key%') ORDER BY year_registration DESC, semester_registration DESC, student.id_student DESC");
$total = mysqli_num_rows($sql);
$Query = mysqli_query($connect, "select * from registration,student,subject where subject.id_subject=registration.id_subject AND registration.id_student=student.id_student AND(year_registration LIKE '%$key%' OR semester_registration LIKE '%$key%' OR subject.id_subject LIKE '%$key%' OR section LIKE '%$key%' OR name_subject LIKE '%$key%' OR name_student LIKE '%$key%' OR sname_student LIKE '%$key%' OR student.id_student LIKE '%$key%') ORDER BY year_registration DESC, semester_registration DESC, student.id_student DESC LIMIT $start,$limit"); //คิวรี่คำสั่ง
$totalp = mysqli_num_rows($Query); // หาจำนวน record ที่เรียกออกมา
while($rs = mysqli_fetch_array($Query))
{
?>
<tr>
<td><?=$rs[0]?></td>
<td><?=$rs[1]?></td>
<td><?=$rs[2]?></td>
<td  align="left"><?=$rs[7]?></td>
<td  align="left"><?=$rs[8]?></td>
<td><?=$rs[3]?></td>
<td  align="left"><?=$rs[14]?></td>
<td><?=$rs[4]?></td>
<td><a name="<?=$rs[0]?>"></a><a href="javascript:void(0);" onClick="del('<?=htmlspecialchars($rs[0],ENT_QUOTES)?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>','<?=htmlspecialchars($rs[3],ENT_QUOTES)?>','<?=htmlspecialchars($rs[4],ENT_QUOTES)?>')">ลบ</a>/<a href="javascript:void(0);" onClick="showedit('<?=htmlspecialchars($rs[0],ENT_QUOTES)?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>','<?=htmlspecialchars($rs[3],ENT_QUOTES)?>','<?=htmlspecialchars($rs[4],ENT_QUOTES)?>')">แก้ไข</a></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="9" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>

  <?
/* ตัวแบ่งหน้า */
$page = ceil($total/$limit); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า

/* เอาผลหาร มาวน เป็นตัวเลข เรียงกัน เช่น สมมุติว่าหารได้ 3 เอามาวลก็จะได้ 1 2 3 */
if($page!=1)
{
for($i=1;$i<=$page;$i++){
if(($_GET['page'] ?? null)==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
echo "[<a onclick='cpr(".$limit*($i-1).",$i)' href='javascript:void(0);'><B>$i</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
}else{
echo "[<a onclick='cpr(".$limit*($i-1).",$i)'  href='javascript:void(0);'>$i</A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
}
}
}
?>