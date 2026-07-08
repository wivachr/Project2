<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td width="13%"  align="center" bgcolor="#CCCCCC">รหัสโครงงานพิเศษ</td>
      <td width="30%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงานพิเศษ</td>
       <td width="27%"  align="center" bgcolor="#CCCCCC">โครงการที่เข้าร่วม</td>
       <td width="20%"  align="center" bgcolor="#CCCCCC">สถานะการเข้าร่วม</td>
      <td width="10%"  align="center" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../connectdatabase.php');
$sql = "select * from race,project where race.id_project = project.id_project order by id_race DESC";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
?>
<tr>
<td align="center"><?=$rs[1]?></td>
<td align="left"><?=$rs[5]?></td>
<td align="left"><?=$rs[2]?></td>
<td align="left"><?=$rs[3]?></td>
<td><a name="<?=$rs[0]?>"></a><a href="javascript:void(0);" onClick="del('<?=$rs[0]?>')">ลบ</a>/<a href="javascript:void(0);" onClick="showedit(<?=json_encode((string)$rs[0]);?>,<?=json_encode((string)$rs[1]);?>,<?=htmlspecialchars(json_encode((string)$rs[2]),ENT_COMPAT);?>,<?=htmlspecialchars(json_encode((string)$rs[3]),ENT_COMPAT);?>)">แก้ไข</a></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="6" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
