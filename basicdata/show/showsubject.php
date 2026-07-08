<? session_start(); ?>
<? include('../../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
<table width="43%" border="0" cellpadding="0" cellspacing="1">
    <tr>
    <td width="" align="center" bgcolor="#CCCCCC">รหัสวิชา</td>
      <td width="" align="center" bgcolor="#CCCCCC">ชื่อวิชา</td>
      <td width="" align="center" bgcolor="#CCCCCC">หน่วยกิต</td>
      <td width="" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../../connectdatabase.php');
$sql = "select * from subject ORDER BY id_subject";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
	 $sql = "select * from registration where id_subject='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
 $sql = "select * from project where id_subject='$rs[0]'";
$result3 = mysqli_query($connect, $sql);
?>
<tr>
<td><?=$rs[0]?></td>
<td align="left"><?=$rs[1]?></td>
<td><?=$rs[2]?></td>
<td><? if(mysqli_num_rows($result2)==0&&mysqli_num_rows($result3)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=$rs[0]?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>','<?=htmlspecialchars($rs[2],ENT_QUOTES)?>')">แก้ไข</a></td>
</tr>
<?
}
?>
<tr><td colspan="4" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
