<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<p>
  <input type="text" name="sexam" id="sexam" />
  <input type="button" name="searchex" id="searchex" value="ค้นหา" onclick="searchexamt();"/>
</p>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td width="10%"  align="center" bgcolor="#CCCCCC">คำนำหน้าชื่อ</td>
      <td width="12%"  align="center" bgcolor="#CCCCCC">คำนำหน้าชื่อ<br />
ทางวิชาการ</td>
      <td width="11%"  align="center" bgcolor="#CCCCCC">ชื่อ</td>
      <td width="12%"  align="center" bgcolor="#CCCCCC">นามสกุล</td>
      <td width="8%"  align="center" bgcolor="#CCCCCC">ชื่อย่อ</td>
      <td width="7%"  align="center" bgcolor="#CCCCCC">คณะ</td>
      <td width="7%"  align="center" bgcolor="#CCCCCC">ภาควิชา</td>
      <td width="7%"  align="center" bgcolor="#CCCCCC">สาขาวิชา</td>
      <td width="10%"  align="center" bgcolor="#CCCCCC">เบอร์โทรศัพท์</td>
      <td width="9%"  align="center" bgcolor="#CCCCCC">อีเมลล์</td>
      <td width="7%"  align="center" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../connectdatabase.php');
  if(!isset($start)){ $start = 0; }
  $start = (int)$start;
  if(!isset($key)){ $key = ''; }
$key = mysqli_real_escape_string($connect, $key);
$limit = '10'; // แสดงผลหน้าละกี่หัวข้อ
$joinsql = "from teacher
left join title on teacher.id_title=title.id_title
left join academictitle on teacher.id_academictitle=academictitle.id_academictitle
left join faculty on teacher.id_faculty=faculty.id_faculty
left join department on teacher.id_department=department.id_department
left join division on teacher.id_division=division.id_division
where (name_title LIKE '%$key%' OR name_teacher LIKE '%$key%' OR sname_teacher LIKE '%$key%' OR initials_teacher LIKE '%$key%' OR initials_division LIKE '%$key%' OR initials_department LIKE '%$key%' OR initials_faculty LIKE '%$key%' OR tel_teacher LIKE '%$key%')";
$sql = mysqli_query($connect, "select * $joinsql");
$total = mysqli_num_rows($sql);
$Query = mysqli_query($connect, "select * $joinsql ORDER BY teacher.id_teacher desc LIMIT $start,$limit"); //คิวรี่คำสั่ง
$totalp = mysqli_num_rows($Query); // หาจำนวน record ที่เรียกออกมา
while($rs = mysqli_fetch_array($Query))
{
	 $sql = "select * from committee where id_teacher='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
 $sql = "select * from teacherfreetime where id_teacher='$rs[0]'";
$result3 = mysqli_query($connect, $sql);
 $sql = "select * from headofdepartment where id_teacher='$rs[0]'";
$result4 = mysqli_query($connect, $sql);

?>
<tr>
<td align="left"><?=$rs[13]?></td>
<td align="left"><?=$rs[15]?></td>
<td align="left"><?=$rs[3]?></td>
<td align="left"><?=$rs[4]?></td>
<td align="left"><?=$rs[5]?></td>
<td align="left"><?=$rs[19]?></td>
<td align="left"><?=$rs[22]?></td>
<td align="left"><?=$rs[26]?></td>
<td align="center"><?=$rs[9]?></td>
<td align="left"><?=$rs[10]?></td>
<td><? if(mysqli_num_rows($result2)==0&&mysqli_num_rows($result3)==0&&mysqli_num_rows($result4)==0){?><a href="javascript:void(0);" onClick="del(<?=json_encode((int)$rs[0]);?>,<?=htmlspecialchars(json_encode((string)$rs[5]),ENT_COMPAT);?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=htmlspecialchars($rs[0],ENT_QUOTES)?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>','<?=htmlspecialchars($rs[3],ENT_QUOTES)?>','<?=htmlspecialchars($rs[4],ENT_QUOTES)?>','<?=htmlspecialchars($rs[5],ENT_QUOTES)?>','<?=htmlspecialchars($rs[6],ENT_QUOTES)?>','<?=htmlspecialchars($rs[7],ENT_QUOTES)?>','<?=htmlspecialchars($rs[8],ENT_QUOTES)?>','<?=htmlspecialchars($rs[9],ENT_QUOTES)?>','<?=htmlspecialchars($rs[10],ENT_QUOTES)?>')">แก้ไข</a></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="11" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
  <?
/* ตัวแบ่งหน้า */
$page = ceil($total/$limit); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า

/* เอาผลหาร มาวน เป็นตัวเลข เรียงกัน เช่น สมมุติว่าหารได้ 3 เอามาวลก็จะได้ 1 2 3 */
if($page!=1)
{
for($i=1;$i<=$page;$i++){
if(($_GET['page'] ?? null)==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
echo "[<a onclick='cpt(".$limit*($i-1).",$i)' href='javascript:void(0);'><B>$i</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
}else{
echo "[<a onclick='cpt(".$limit*($i-1).",$i)'  href='javascript:void(0);'>$i</A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
}
}
}
?>