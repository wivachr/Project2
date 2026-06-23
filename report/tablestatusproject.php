 <? include('../change.php'); ?>
 <? 	include('../connectdatabase.php'); 
	 $sql = "select project.id_project,name_project,name_statusproject from project,statusproject,committee where project.id_statusproject=statusproject.id_statusproject AND committee.id_project = project.id_project AND position='ที่ปรึกษา' AND id_teacher='$teacher' AND (statusproject.id_statusproject<>'0' AND statusproject.id_statusproject<>'16' AND statusproject.id_statusproject<>'18' AND statusproject.id_statusproject<>'17')";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
		?>
        <table width="77%"  border="1" bordercolor="#000000"  cellpadding="0" cellspacing="1">
    <tr>
      <td width="22%"  align="center" bgcolor="#CCCCCC">รหัสโครงงานพิเศษ</td>
      <td width="43%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงานพิเศษ</td>
      <td width="35%"  align="center" bgcolor="#CCCCCC">สถานะโครงงานพิเศษ</td>
    </tr>
        <?
while($rs = mysqli_fetch_array($result))
{	
?>
<tr>
<td ><?=$rs[0]?></td>
<td  align="left" valign="top"><?=$rs[1]?></td>
<td  align="left" valign="top"><?=$rs[2]?></td>
</tr>
<?
}
?>
<tr><td colspan="3" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
<p>
  <input type="button" name="button" id="button" value="ออกรายงาน" onclick="window.open('report/statusproject.php?teacher=<?=$teacher;?>','_blank','')" />
</p>
<?
	}
	else
	{
	  echo "<br/>ไม่มีรายชื่อโครงงานพิเศษ";
	}
mysqli_close($connect);
?>
