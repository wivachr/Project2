<? include('../change.php'); ?>
<h2>พิมพ์ใบประเมิน</h2>
<table width="100%"  border="1" bordercolor="#000000" cellpadding="0" cellspacing="1">
    <tr>
      <td width="20%"  align="center" bgcolor="#CCCCCC">รหัสโครงงานพิเศษ</td>
      <td width="60%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงานพิเศษ</td>
      <td width="20%"  align="center" bgcolor="#CCCCCC">ประเภทการสอบ</td>
    </tr>
 <? include('../connectdatabase.php');
$sql = "select project.id_project,project.name_project,name_typeexam,exam.id_exam,typeexam.id_typeexam from project,exam,typeexam where exam.id_typeexam=typeexam.id_typeexam AND (project.id_statusproject='5' OR project.id_statusproject='9' OR project.id_statusproject='13') AND exam.id_project=project.id_project AND 
exam.id_statusproject='21'  order by project.id_project";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
?>
<tr>
<td align="center"><?=$rs[0]?></td>
<? if($rs[4]=='1'){ ?>
<td align="left"><a href="javascript:void(0);" onClick="viewprint(<?=$rs[0]?>,<?=$rs[3]?>)"><?=$rs[1]?></a></td>
<? }
else if($rs[4]=='2'){
 ?>
<td align="left"><a href="javascript:void(0);" onClick="viewprint2(<?=$rs[0]?>,<?=$rs[3]?>)"><?=$rs[1]?></a></td>
<? }
else if($rs[4]=='3'){
 ?>
 <td width="5%" align="left"><a href="javascript:void(0);" onClick="viewprint3(<?=$rs[0]?>,<?=$rs[3]?>)"><?=$rs[1]?></a></td>
 <? } ?>
<td width="3%" align="left"><?=$rs[2]?></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="3" bgcolor="#CCCCCC">&nbsp;</td></tr>
</table>
