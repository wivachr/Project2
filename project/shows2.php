<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<h2>รับการเรื่องสอบ</h2>
<table width="100%" border="1" bordercolor="#000000"cellpadding="0" cellspacing="1">
    <tr>
      <td width="20%"  align="center" bgcolor="#CCCCCC">รหัสโครงงานพิเศษ</td>
      <td width="60%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงานพิเศษ</td>
      <td width="20%"  align="center" bgcolor="#CCCCCC">ประเภทการสอบ</td>
    </tr>
 <? include('../connectdatabase.php');
$sql = "select project.id_project,project.name_project,name_typeexam,id_exam,exam.id_typeexam from project,exam,typeexam where exam.id_typeexam=typeexam.id_typeexam AND (project.id_statusproject='2' OR project.id_statusproject='7' OR project.id_statusproject='11')AND exam.id_project=project.id_project AND exam.id_statusproject='20'  order by project.id_project";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
?>
<tr>
<td><?=$rs[0]?></td>
<? if($rs[4]=='1'){ ?>
<td align="left"><a href="javascript:void(0);" onClick="viewapprove(<?=$rs[0]?>,<?=$rs[3]?>)"><?=$rs[1]?></a></td>
<? }
else if($rs[4]=='2'){
 ?>
 <td align="left"><a href="javascript:void(0);" onClick="viewapprove2(<?=$rs[0]?>,<?=$rs[3]?>)"><?=$rs[1]?></a></td>
 <? }
else if($rs[4]=='3'){
 ?>
 <td width="3%" align="left"><a href="javascript:void(0);" onClick="viewapprove3(<?=$rs[0]?>,<?=$rs[3]?>)"><?=$rs[1]?></a></td>
 <? } ?>
<td width="3%" align="left"><?=$rs[2]?></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="3" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
