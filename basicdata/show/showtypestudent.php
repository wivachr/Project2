<? session_start(); ?>
<? include('../../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
<table width="48%" border="0" cellpadding="0" cellspacing="1">
    <tr>
    <td width="31%" align="center" bgcolor="#CCCCCC">รหัสหลักสูตร</td>
      <td width="50%" align="center" bgcolor="#CCCCCC">ชื่อหลักสูตร</td>
      <td width="19%" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../../connectdatabase.php');
$sql = "select * from curriculum ORDER BY id_curr";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
 $sql = "select * from student where id_curr='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
?>
<tr>
<td><?=$rs[0]?></td>
<td align="left"><?=$rs[1]?></td>
<td><? if(mysqli_num_rows($result2)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=$rs[0]?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>')">แก้ไข</a></td>
</tr>
<?
}
?>
<tr><td colspan="3" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
