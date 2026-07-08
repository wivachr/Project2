<?
include('../change.php');
include('../connectdatabase.php');
$id = (int)$id;
$sql = "select * from news,user where id_news='$id' AND news.id_user=user.id_user";
$result = mysqli_query($connect, $sql);
 while($rs = mysqli_fetch_array($result))
{
	$date2 = explode("-", $rs[4]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=htmlspecialchars($rs[1],ENT_QUOTES)?></title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
</style>
</head>
<body>
<table width="735" height="169" border="1">
  <tr>
    <th height="32" colspan="2" bgcolor="#CCCCCC" scope="col"><?=htmlspecialchars($rs[1],ENT_QUOTES)?></th>
  </tr>
  <? if(!empty($rs[6])){ ?>
  <tr>
    <td colspan="2" valign="top" align="center" scope="row"><img src="<?=htmlspecialchars($rs[6],ENT_QUOTES)?>" style="max-width:700px" /></td>
  </tr>
  <? } ?>
  <tr>
    <td height="109" colspan="2" valign="top" scope="row"><?=nl2br(htmlspecialchars($rs[2],ENT_QUOTES))?></td>
  </tr>
  <tr>
    <td width="141" valign="top" scope="row">วันที่เขียน : <?=$date2[2]."/".$date2[1]."/".$date2[0]?></td>
    <td width="578" valign="top" scope="row">ผู้เขียน : <?=htmlspecialchars($rs[7],ENT_QUOTES)?> <?=htmlspecialchars($rs[8],ENT_QUOTES)?></td>
  </tr>
  <? if(!empty($rs[5])){ ?>
  <tr>
    <td colspan="2" valign="top" scope="row"><a href="<?=htmlspecialchars($rs[5],ENT_QUOTES)?>" target="_blank">ดาวน์โหลดไฟล์ PDF ประกอบข่าวสาร</a></td>
  </tr>
  <? } ?>
</table>

</body>
</html>
<? }
 mysqli_close($connect);
 ?>