<? session_start(); ?>
<? include('../../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
<table width="41%" border="0" cellpadding="0" cellspacing="1">
    <tr>
    <td width="27%" align="center" bgcolor="#CCCCCC">รหัสคำนำหน้าชื่อ</td>
      <td width="55%" align="center" bgcolor="#CCCCCC">คำนำหน้าชื่อ</td>
      <td width="18%" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../../connectdatabase.php');
$sql = "select * from title ORDER BY id_title";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
 $sql = "select * from student where id_title='$rs[0]'";
$result2 = mysqli_query($connect, $sql);
 $sql = "select * from teacher where id_title='$rs[0]'";
$result3 = mysqli_query($connect, $sql);
 $sql = "select * from coadvisor where id_title='$rs[0]'";
$result4 = mysqli_query($connect, $sql);
?>
<tr>
<td align="center"><?=$rs[0]?></td>
<td align="left"><?=$rs[1]?></td>
<td><a name="<?=$rs[0]?>"></a><? if(mysqli_num_rows($result2)==0&&mysqli_num_rows($result3)==0&&mysqli_num_rows($result4)==0){?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }else{echo "ลบ";}?>/<a href="javascript:void(0);" onClick="showedit('<?=$rs[0]?>','<?=htmlspecialchars($rs[1],ENT_QUOTES)?>')">แก้ไข</a></td>
</tr>
<?
}
?>
<tr><td colspan="3" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
