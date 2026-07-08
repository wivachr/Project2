<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } $t = (int)$t; ?>
<h2>รายชื่อโครงงานที่ยังไม่ยื่นสอบร้อยเปอร์เซ็นต์เมื่อใก้ลครบกำหนด</h2>
 <? 	include('../connectdatabase.php');
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}

	 $sql = "select * from project,committee where position = 'ที่ปรึกษา' AND id_teacher='$t' AND committee.id_project=project.id_project AND (year_project<>'$year' OR semester_project<>'$semester') AND (id_statusproject <> '0' AND id_statusproject <> '16' AND id_statusproject <> '18' AND id_statusproject <> '17')";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
		?>
        <table width="60%"  border="1" bordercolor="#000000" cellpadding="0" cellspacing="1">
    <tr>
      <td width="30%"  align="center" bgcolor="#CCCCCC">รหัสนักศึกษา</td>
      <td width="70%"  align="center" bgcolor="#CCCCCC">ชื่อ-สกุลนักศึกษา</td>
    </tr>
		<?
	while($rs = mysqli_fetch_array($result))
	{
?>
<tr>
<td ><?=$rs[0]?></td>
<td  align="left" valign="top"><?=$rs[1]?></td>
</tr>
<?
}
?>
<tr><td colspan="2" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
  <p>
  <input type="button" name="button" id="button" value="ออกรายงาน" onclick="window.open('report/noexam2.php?t=<?=$t?>','_blank','')" />
</p>
  <? 	}
  else
  {
	  echo "<br/>ไม่มีรายชื่อนักศึกษาที่ยังไม่ยื่นสอบร้อยเปอร์เซ็นต์เมื่อใก้ลครบกำหนด";
  }
mysqli_close($connect);
?>

