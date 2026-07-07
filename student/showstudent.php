<? include('../change.php'); ?>
<p>
  <input type="text" name="sexam" id="sexam" />
  <input type="button" name="searchex" id="searchex" value="ค้นหา" onclick="searchexams();"/>
</p>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td width="11%"  align="center" bgcolor="#CCCCCC">รหัสนักศึกษา</td>
      <td width="10%"  align="center" bgcolor="#CCCCCC">คำนำหน้าชื่อ</td>
      <td width="10%"  align="center" bgcolor="#CCCCCC">ชื่อ</td>
      <td width="13%"  align="center" bgcolor="#CCCCCC">นามสกุล</td>
      <td width="9%"  align="center" bgcolor="#CCCCCC">คณะ</td>
      <td width="8%"  align="center" bgcolor="#CCCCCC">ภาควิชา</td>
      <td width="11%"  align="center" bgcolor="#CCCCCC">สาขาวิชา</td>
      <td width="20%"  align="center" bgcolor="#CCCCCC">หลักสูตร</td>
      <td width="8%"  bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../connectdatabase.php');
  if(!isset($start)){ $start = 0; }
  if(!isset($key)){ $key = ''; }
$limit = '20'; // แสดงผลหน้าละกี่หัวข้อ
$sql = mysqli_query($connect, "select * from student,title,faculty,department,division,curriculum where student.id_title=title.id_title and student.id_faculty=faculty.id_faculty and student.id_department=department.id_department and student.id_division=division.id_division and student.id_curr=curriculum.id_curr AND(student.id_student LIKE '%$key%' OR name_title LIKE '%$key%' OR name_student LIKE '%$key%' OR sname_student LIKE '%$key%' OR initials_division LIKE '%$key%' OR initials_department LIKE '%$key%' OR initials_faculty LIKE '%$key%' OR name_curr LIKE '%$key%')");
$total = mysqli_num_rows($sql);
$Query = mysqli_query($connect, "select * from student,title,faculty,department,division,curriculum where student.id_title=title.id_title and student.id_faculty=faculty.id_faculty and student.id_department=department.id_department and student.id_division=division.id_division and student.id_curr=curriculum.id_curr AND(student.id_student LIKE '%$key%' OR name_title LIKE '%$key%' OR name_student LIKE '%$key%' OR sname_student LIKE '%$key%' OR initials_division LIKE '%$key%' OR initials_department LIKE '%$key%' OR initials_faculty LIKE '%$key%' OR name_curr LIKE '%$key%') ORDER BY student.id_student desc LIMIT $start,$limit"); //คิวรี่คำสั่ง
$totalp = mysqli_num_rows($Query); // หาจำนวน record ที่เรียกออกมา
while($rs = mysqli_fetch_array($Query))
{
	 $sql = "select * from registration where id_student='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
 $sql = "select * from manipulator where id_student='$rs[0]'";
$result3 = mysqli_query($connect, $sql);
?>
<tr>
<td align="center"><?=$rs[0]?></td>
<td align="left"><?=$rs[9]?></td>
<td align="left"><?=$rs[2]?></td>
<td align="left"><?=$rs[3]?></td>
<td align="left"><?=$rs[12]?></td>
<td align="left"><?=$rs[15]?></td>
<td align="left"><?=$rs[19]?></td>
<td align="left"><?=$rs[23]?></td>
<td><? if(mysqli_num_rows($result2)==0&&mysqli_num_rows($result3)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=htmlspecialchars($rs[0],ENT_QUOTES)?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>','<?=htmlspecialchars($rs[3],ENT_QUOTES)?>','<?=htmlspecialchars($rs[4],ENT_QUOTES)?>','<?=htmlspecialchars($rs[5],ENT_QUOTES)?>','<?=htmlspecialchars($rs[6],ENT_QUOTES)?>','<?=htmlspecialchars($rs[7],ENT_QUOTES)?>')">แก้ไข</a></td>
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
echo "[<a onclick='cps(".$limit*($i-1).",$i)' href='javascript:void(0);'><B>$i</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
}else{
echo "[<a onclick='cps(".$limit*($i-1).",$i)'  href='javascript:void(0);'>$i</A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
}
}
}
?>