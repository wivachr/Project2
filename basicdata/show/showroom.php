<? include('../../change.php'); ?>
<table width="41%" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td width="79%" align="center" bgcolor="#CCCCCC">ห้องเรียน</td>
      <td width="21%" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../../connectdatabase.php');
$sql = "select * from room ORDER BY id_room";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
	 $sql = "select * from assignexam where id_room='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
?>
<tr>
<td align="left"><?=$rs[1]?></td>
<td><a name="<?=$rs[0]?>"></a><? if(mysqli_num_rows($result2)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=$rs[0]?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>')">แก้ไข</a></td>
</tr>
<?
}
?>
<tr><td colspan="2" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
