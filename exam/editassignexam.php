<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<h2>แก้ไขการจัดสอบ</h2>
<table width="100%" border="1" bordercolor="#000000" cellpadding="0" cellspacing="1">
    <tr>
    <td width="14%"  align="center" bgcolor="#CCCCCC">รหัสโครงงานพิเศษ</td>
      <td width="37%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงานพิเศษ</td>
      <td width="9%"  align="center" bgcolor="#CCCCCC">วันที่สอบ</td>
      <td width="10%"  align="center" bgcolor="#CCCCCC">เวลาเริ่มสอบ</td>
      <td width="10%"  align="center" bgcolor="#CCCCCC">เวลาจบ</td>
      <td width="8%"  align="center" bgcolor="#CCCCCC">ห้องสอบ</td>
       <td width="12%"  align="center" bgcolor="#CCCCCC"></td>
    </tr>
 <? include('../connectdatabase.php');
$sql = "select project.name_project,date_assignexam,time_assignexam,name_room,project.id_project,assignexam.id_assignexam,room.id_room,endtime_assignexam  from assignexam,exam,project,room where room.id_room=assignexam.id_room AND project.id_project= exam.id_project AND exam.id_exam=assignexam.id_exam AND exam.id_statusproject='21'";
$result = mysqli_query($connect, $sql);
while($rs = mysqli_fetch_array($result))
{
	$date2 = explode("-", $rs[1]);
?>
<tr>
<td align="center"><?=$rs[4]?></td>
<td align="left"><?=$rs[0]?></td>
<td align="center"><?=$date2[2]."/".$date2[1]."/".$date2[0]?></td>
<td align="center"><?=$rs[2]?></td>
<td align="center"><?=$rs[7]?></td>
<td align="center"><?=$rs[3]?></td>
<td><a name="d<?=$rs[0]?>"></a><a href="javascript:void(0)" onClick="editassign('<?=$rs[5]?>','<?=$rs[1]?>','<?=$rs[2]?>','<?=$rs[6]?>','<?=$rs[4]?>','<?=$rs[7]?>')">แก้ไข้การจัดสอบ</a></td>
</tr>
<?
}
mysqli_close($connect);
?>
<tr><td colspan="7" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
