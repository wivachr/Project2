<? session_start(); ?>
<? include('../../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
<table width="99%" border="0" cellpadding="0" cellspacing="1">
    <tr>
    <td width="10%" align="center" bgcolor="#CCCCCC">รหัสสาขา</td>
      <td width="21%" align="center" bgcolor="#CCCCCC">ชื่อสาขา</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">ชื่อย่อสาขา</td>
      <td width="24%" align="center" bgcolor="#CCCCCC">คณะ</td>
      <td width="23%" align="center" bgcolor="#CCCCCC">ภาควิชา</td>
      <td width="9%" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../../connectdatabase.php');
$sql = "select * from division,faculty,department where division.id_faculty=faculty.id_faculty AND division.id_department=department.id_department ORDER BY id_division";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
	 $sql = "select * from student where id_division='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
 $sql = "select * from teacher where id_division='$rs[0]'";
$result3 = mysqli_query($connect, $sql);
?>
<tr>
<td align="center"><?=$rs[0]?></td>
<td align="left"><?=$rs[1]?></td>
<td align="left"><?=$rs[2]?></td>
<td align="left"><?=$rs[6]?></td>
<td align="left"><?=$rs[9]?></td>
<td><a name="<?=$rs[0]?>"></a><? if(mysqli_num_rows($result2)==0&&mysqli_num_rows($result3)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=$rs[0]?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>','<?=$rs[3]?>','<?=$rs[4]?>')">แก้ไข</a></td>
</tr>
<?
}
?>
<tr><td colspan="6" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
