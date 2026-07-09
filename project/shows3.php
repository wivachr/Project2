<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<h2>แต่งตั้งกรรมการ</h2>
<table width="100%"  border="1" bordercolor="#000000" cellpadding="0" cellspacing="1">
    <tr>
      <td width="25%"  align="center" bgcolor="#CCCCCC">รหัสโครงงานพิเศษ</td>
      <td width="75%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงานพิเศษ</td>
    </tr>
 <? include('../connectdatabase.php');
$sql = "select * from project where id_statusproject='3' order by project.id_project";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
?>
<tr>
<td><?=$rs[0]?></td>
<td  align="left"><a href="javascript:void(0);" onClick="assign(<?=$rs[0]?>)"><?=$rs[1]?></a></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="2" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
