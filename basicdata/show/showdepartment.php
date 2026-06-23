<? include('../../change.php'); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
    <tr>
    <td width="10%" align="center" bgcolor="#CCCCCC">รหัสภาควิชา</td>
      <td width="40%" align="center" bgcolor="#CCCCCC">ชื่อภาควิชา</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">ชื่อย่อภาควิชา</td>
      <td width="27%" align="center" bgcolor="#CCCCCC">คณะ</td>
      <td width="10%" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../../connectdatabase.php');
$sql = "select * from department,faculty where department.id_faculty=faculty.id_faculty ORDER BY id_department";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
		 $sql = "select * from student where id_department='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
 $sql = "select * from teacher where id_department='$rs[0]'";
$result3 = mysqli_query($connect, $sql);
?>
<tr>
<td align="center"><?=$rs[0]?></td>
<td align="left"><?=$rs[1]?></td>
<td align="left"><?=$rs[2]?></td>
<td align="left"><?=$rs[5]?></td>
<td><a name="<?=$rs[0]?>"></a><? if(mysqli_num_rows($result2)==0&&mysqli_num_rows($result3)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=$rs[0]?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>','<?=$rs[3]?>')">แก้ไข</a></td>
</tr>
<?
}
?>
<tr align="left"><td colspan="5" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
