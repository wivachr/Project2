<? include('../../change.php'); ?>
<table width="76%" border="0" cellpadding="0" cellspacing="1">
    <tr>
     <td width="16%" align="center" bgcolor="#CCCCCC">รหัสคณะ</td>
      <td width="43%" align="center" bgcolor="#CCCCCC">ชื่อคณะ</td>
      <td width="22%" align="center" bgcolor="#CCCCCC">ชื่อย่อคณะ</td>
      <td width="19%" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../../connectdatabase.php');
$sql = "select * from faculty ORDER BY id_faculty";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
		 $sql = "select * from student where id_faculty='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
 $sql = "select * from teacher where id_faculty='$rs[0]'";
$result3 = mysqli_query($connect, $sql);
?>
<tr>
<td align="center"><?=$rs[0]?></td>
<td align="left"><?=$rs[1]?></td>
<td align="left"><?=$rs[2]?></td>
<td><a name="<?=$rs[0]?>"></a><? if(mysqli_num_rows($result2)==0&&mysqli_num_rows($result3)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=$rs[0]?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>')">แก้ไข</a></td>
</tr>
<?
}
?>
<tr><td colspan="4" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
