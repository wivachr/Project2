<? session_start(); ?>
<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ดูข้อมูลโครงงานพิเศษ</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
</style>
</head>
<body>
<? include('../connectdatabase.php');
/*
 * ดึงคอลัมน์ตามชื่อแทน select * + เลข index เพื่อเลี่ยงบั๊ก offset ที่ขึ้นกับลำดับตารางใน FROM
 * (เดิมใช้ $rs[25] ซึ่งคือ project.parent_project_id ทำให้ช่องสถานะว่างเปล่าทุกแถว)
 *
 * วันที่จัดสอบดึงด้วย subquery ไม่ใช่ join เพราะ 1 exam อาจมี assignexam ได้หลายแถว
 * (เช่น id_exam=2209 มี 3 แถว) ซึ่ง join ตรง ๆ จะทำให้ประวัติการสอบแสดงซ้ำ
 */
$iduser = $_SESSION['iduser'] ?? '';
$sql = "select typeexam.name_typeexam,
               exam.date_submitexam,
               statusproject.name_statusproject,
               exam.comment_exam,
               (select assignexam.date_assignexam from assignexam
                 where assignexam.id_exam = exam.id_exam
                 order by assignexam.id_assignexam desc limit 1) as date_assignexam
          from exam,typeexam,project,statusproject
         where statusproject.id_statusproject = exam.id_statusproject
           AND project.id_user='".$iduser."'
           AND exam.id_typeexam=typeexam.id_typeexam
           AND exam.id_project=project.id_project
         order by exam.id_exam";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result)!=0)
{
	?>
    <table width="620" border="1" align="center">
      <tr>
        <td colspan="5" align="center" scope="col"><h2>ประวัติการสอบ</h2></td>
      </tr>
      <tr>
        <th width="107" scope="row">ประเภทการสอบ</th>
        <th width="80">วันที่รับเรื่อง</th>
        <th width="80">วันที่จัดสอบ</th>
        <th width="87">สถานะการสอบ</th>
        <th width="204">ความคิดเห็นของคณะกรรมการ</th>
      </tr>
    <?
while($rs = mysqli_fetch_array($result))
{
	?>
      <tr>
        <td align="left" scope="row"><?=$rs['name_typeexam']?></td>
        <td><? if($rs['date_submitexam']=="0000-00-00"){echo "ยังไม่ได้รับเรื่อง";}else{echo $rs['date_submitexam'];}?></td>
        <td><? if(empty($rs['date_assignexam'])||$rs['date_assignexam']=="0000-00-00"){echo "ยังไม่ได้จัดสอบ";}else{echo $rs['date_assignexam'];}?></td>
        <td align="left"><?=$rs['name_statusproject']?></td>
        <td align="left"><? if($rs['comment_exam']==""){echo "ไม่มีความคิดเห็น";}else{echo nl2br($rs['comment_exam']);}?></td>
      </tr>
    <?
}
?></table>
<?
}

			  mysqli_close($connect);
			  ?>
</body>
</html>
