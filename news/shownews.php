<? include('../change.php'); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td  align="center" bgcolor="#CCCCCC">หัวข้อข่าวสาร</td>
      <td  align="center" bgcolor="#CCCCCC">วันที่เขียน</td>
      <td  align="center" bgcolor="#CCCCCC">ผู้เขียน</td>
      <td  align="center" bgcolor="#CCCCCC">PDF</td>
      <td  align="center" bgcolor="#CCCCCC">รูปภาพ</td>
      <td  align="center" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../connectdatabase.php');
$sql = "select * from news,user where news.id_user = user.id_user";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
	$date2 = explode("-", $rs[4]);
?>
<tr>
<td  align="left"><?=$rs[1]?></td>
<td><?=$date2[2]."/".$date2[1]."/".$date2[0]?></td>
<td  align="left"><? echo "$rs[7] $rs[8]";?></td>
<td align="center"><? if(!empty($rs[5])){?><a href="<?=htmlspecialchars('news/'.$rs[5],ENT_QUOTES)?>" target="_blank">PDF</a><? }?></td>
<td align="center"><? if(!empty($rs[6])){?><a href="<?=htmlspecialchars('news/'.$rs[6],ENT_QUOTES)?>" target="_blank"><img src="<?=htmlspecialchars('news/'.$rs[6],ENT_QUOTES)?>" width="40" height="40" style="object-fit:cover" /></a><? }?></td>
<td><a name="<?=$rs[0]?>"></a><a href="javascript:void(0);" onClick="del('<?=$rs[0]?>')">ลบ</a>/<a href="javascript:void(0);" onClick="showedit(<?=json_encode((string)$rs[0]);?>,<?=htmlspecialchars(json_encode((string)$rs[1]),ENT_COMPAT);?>,<?=htmlspecialchars(json_encode(preg_replace('/\r|\n/','',(string)$rs[2])),ENT_COMPAT);?>)">แก้ไข</a></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="6" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
