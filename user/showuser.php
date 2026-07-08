<? session_start();?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='1') { exit; } ?>
<table width="76%" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td width="15%" align="center" bgcolor="#CCCCCC">ชื่อ</td>
      <td width="22%" align="center" bgcolor="#CCCCCC">นามสกุล</td>
      <td width="21%" align="center" bgcolor="#CCCCCC">ชื่อผู้ใช้งานระบบ</td>
      <td width="19%" align="center" bgcolor="#CCCCCC">สิทธิ์</td>
      <td width="23%" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../connectdatabase.php');
$sql = "select * from user,`right` where user.id_right=`right`.id_right AND(user.id_right = '1' OR user.id_right='2') ORDER BY user.id_user";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
	 $sql = "select * from news where id_user='$rs[0]'";
	$result2 = mysqli_query($connect, $sql);
?>
<tr>
<td><?=$rs[1]?></td>
<td><?=$rs[2]?></td>
<td><?=$rs[3]?></td>
<td><?=$rs[8]?></td>
<td><a name="<?=$rs[0]?>"></a><? if($rs[0]==1||$rs[0]==($_SESSION["iduser"] ?? null)||mysqli_num_rows($result2)!=0){echo "ลบ";}else{?><a href="javascript:void(0);" onClick="del(<?=$rs[0]?>)">ลบ</a><? }?>/<a href="javascript:void(0);" onClick="showedit(<?=json_encode((int)$rs[0]);?>,<?=htmlspecialchars(json_encode((string)$rs[1]),ENT_COMPAT);?>,<?=htmlspecialchars(json_encode((string)$rs[2]),ENT_COMPAT);?>,<?=htmlspecialchars(json_encode((string)$rs[3]),ENT_COMPAT);?>,<?=json_encode((int)$rs[5]);?>)">แก้ไข</a>/<a href="javascript:void(0);" onClick="reset1(<?=$rs[0]?>)">รีเซ็ทรหัสผ่าน</a></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="5" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
