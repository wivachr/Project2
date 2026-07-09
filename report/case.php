<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	include('../connectdatabase.php');
	$y = mysqli_real_escape_string($connect, $y);
	$s = mysqli_real_escape_string($connect, $s);
$sql = "select casestudy_project,name_project from project where casestudy_project <>'' AND year_project ='$y'  AND semester_project ='$s'";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
		?>
        <table width="100%"  border="1" bordercolor="#000000"  cellpadding="0" cellspacing="1">
    <tr>
      <td width="8%"  align="center" bgcolor="#CCCCCC">ลำดับ</td>
      <td width="46%"  align="center" bgcolor="#CCCCCC">หน่วยงาน</td>
      <td width="46%"  align="center" bgcolor="#CCCCCC">ชื่อโครงงานพิเศษ</td>
    </tr>
        <?
		$nnumna = 1;
while($rs = mysqli_fetch_array($result))
{
	?>
<tr>
  <td><?=$nnumna?></td>
  <td align="left" valign="top"><?=$rs[0]?></td>
  <td  align="left"><?=$rs[1]?></td>
</tr>
<?
$nnumna++;
}
?>
<tr><td colspan="3" bgcolor="#CCCCCC">&nbsp;</td></tr>
  </table>
<p>
  <center><input type="button" name="button" id="button" value="ออกรายงาน" onclick="window.open('report/casepdf.php?y=<?=htmlspecialchars($y,ENT_QUOTES)?>&s=<?=htmlspecialchars($s,ENT_QUOTES)?>','_blank','')" /></center>
</p>
<?
	}
	else
	{
			  echo "<br/><center>ไม่มีข้อมูล</center>";
	}
	
mysqli_close($connect);
?>
