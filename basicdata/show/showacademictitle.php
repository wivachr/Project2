<? include('../../change.php'); ?>
<table width="55%" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td width="53%" align="center" bgcolor="#CCCCCC">คำนำหน้าชื่อทางวิชาการ</td>
      <td width="34%" align="center" bgcolor="#CCCCCC">ชื่อย่อคำนำหน้าชื่อทางวิชาการ</td>
      <td width="13%" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../../connectdatabase.php');
$sql = "select * from academictitle ORDER BY id_academictitle";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
 $sql = "select * from teacher where id_academictitle='$rs[0]'";
$result2 = mysqli_query($connect, $sql);

?>
<tr>
<td align="left"><?=$rs[1]?></td>
<td align="left"><?=$rs[2]?></td>
<td><? if(mysqli_num_rows($result2)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=$rs[0]?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>')">แก้ไข</a></td>
</tr>
<?
}
?>
<tr><td colspan="3" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
