<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../_js/jquery.js"></script>
<script type="text/javascript">
</script><title></title>
</head>

<body>
  <center>
    <h2>    เปลี่ยนหัวหน้าภาค</h2>
  </center>
  <? include('../connectdatabase.php'); ?>
  <table id="tableadd" border="0" align="center">
  <tr>
    <td align="right">หัวหน้าภาคปัจจุบัน :</td>
    <td align="left">
      <span id="head">
        <?
        $result_head = mysqli_query($connect, "select name_academictitle,name_teacher,sname_teacher from headofdepartment,teacher,academictitle where headofdepartment.id_teacher=teacher.id_teacher AND academictitle.id_academictitle=teacher.id_academictitle");
        if($rs_head = mysqli_fetch_array($result_head)) {
            echo trim($rs_head[0])." ".trim($rs_head[1])." ".trim($rs_head[2]);
        } else {
            echo "ยังไม่มีหัวหน้าภาค";
        }
        ?>
      </span>
    </td>
  </tr>
  <tr>
    <td align="right">อาจารย์ :</td>
    <td align="left">
      <select name="idteacher" id="idteacher">
        <option value="0">---เลือกอาจารย์---</option>
        <?
        $result_teacher = mysqli_query($connect, "select * from teacher where name_teacher != '' AND name_teacher IS NOT NULL order by initials_teacher");
        while($rs_teacher = mysqli_fetch_array($result_teacher)) {
            echo "<option value=\"".$rs_teacher[0]."\">".$rs_teacher[5]." ".$rs_teacher[3]." ".$rs_teacher[4]."</option>";
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="button" name="addstudent" id="addstudent" value="เปลี่ยนหัวหน้าภาค" onclick="addhead()"/>
    </td>
  </tr>
  </table>
  <? mysqli_close($connect); ?>
<br/>
</body>
</html>
