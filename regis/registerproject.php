<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ลงทะเบียนโครงงานพิเศษ</title>
<style type="text/css">
body,td,th { font-family: Tahoma, Geneva, sans-serif; font-size: 12px; }
.Dang { color: #F00; font-size: 16px; font-weight: bold; }
#notice-box {
  padding: 8px 14px; border-radius: 4px; margin: 6px 0;
  text-align: center; font-size: 12px; display: none;
}
.notice-info    { background:#d0e8ff; border:1px solid #7ab4e8; color:#003; }
.notice-success { background:#d4f7d4; border:1px solid #5cb85c; color:#155724; }
.notice-danger  { background:#fce4e4; border:1px solid #e88; color:#5c0000; }
</style>
  <? include('../connectdatabase.php');
  $sql = "select * from academicyear";
  $result = mysqli_query($connect, $sql);
  while($rs = mysqli_fetch_array($result)) { $year = $rs[0]; $semester = $rs[1]; }
  mysqli_close($connect);
  ?>
<script type="text/javascript">
function getProjectType() {
  var el = document.querySelector('input[name="project_type"]:checked');
  return el ? el.value : 'term';
}

function checkid() {
  if ($('#idstu1').val() == "") return false;
  $("div#loader").show();
  resetYearProjectState();
  var formdata = { idstudent: $('#idstu1').val() };
  $.ajax({
    url: "check_ajax/canuse.php",
    type: "GET",
    data: formdata,
    success: function(msg) {
      if (msg != "") {
        document.getElementById('cresult').innerHTML = "รหัสนักศึกษานี้มีการลงทะเบียนโครงงานแล้ว";
        document.getElementById('showname').innerHTML = "";
        document.getElementById("idstu1").value = "";
        $("div#loader").hide();
      } else {
        $.ajax({
          url: "check_ajax/isregis.php",
          type: "GET",
          dataType: 'json',
          data: formdata,
          success: function(msg) {
            if (msg.check) {
              document.getElementById('cresult').innerHTML = '<img src="../image/check.jpg" width="10" height="10" />';
              document.getElementById("year").value      = msg.year;
              document.getElementById("semester").value  = msg.semester;
              document.getElementById("id_subject").value= msg.id_subject;
              document.getElementById("sec").value       = msg.sec;
              document.getElementById('showname').innerHTML = msg.showname;
              $("div#loader").hide();
              if (getProjectType() === 'year') {
                checkYearProject(formdata.idstudent);
              }
            } else {
              document.getElementById('cresult').innerHTML = "รหัสนักศึกษาไม่ถูกต้อง";
              document.getElementById('showname').innerHTML = "";
              document.getElementById("idstu1").value = "";
              $("div#loader").hide();
            }
          }
        });
      }
    }
  });
}

function checkYearProject(idstudent) {
  $.ajax({
    url: "check_ajax/checkyearproject.php",
    type: "GET",
    dataType: 'json',
    data: { idstudent: idstudent },
    success: function(res) {
      var box = document.getElementById('notice-box');
      box.className = '';
      box.style.display = 'block';
      document.getElementById('regis').disabled = false;
      if (res.status === 'can_register_2nd') {
        box.className = 'notice-success';
        box.innerHTML = '&#10004; พบโปรเจคปีเดิมที่ผ่านการสอบหัวข้อแล้ว &nbsp;|&nbsp; <b>ลงทะเบียนครั้งที่ 2</b><br/>โครงงาน: ' + res.data.name_project
          + '<br/>อาจารย์ที่ปรึกษา (ใช้คนเดิมจากครั้งที่ 1 อัตโนมัติ): <b>' + (res.data.advisor_name || '-') + '</b>';
        document.getElementById('parent_project_id').value = res.data.id_project;
        document.getElementById('nameproject').value    = res.data.name_project;
        document.getElementById('casestudy').value      = res.data.casestudy_project;
        document.getElementById('engnameproject').value = res.data.engname_project;
        document.getElementById('engcasestudy').value   = res.data.engcasestudy_project;
        document.getElementById('idteacher').disabled = true;
        document.getElementById('idteacher_note').style.display = 'inline';
      } else if (res.status === 'not_passed_yet') {
        box.className = 'notice-danger';
        box.innerHTML = '&#10006; ยังไม่สามารถลงทะเบียนครั้งที่ 2 ได้<br/>'
          + 'โครงงาน <b>' + res.id_project + '</b> สถานะ: <b>' + res.status_name + '</b><br/>'
          + '<small>ต้องผ่านการสอบหัวข้อก่อนจึงจะลงทะเบียนครั้งที่ 2 ได้</small>';
        document.getElementById('parent_project_id').value = '';
        document.getElementById('regis').disabled = true;
      } else {
        box.className = 'notice-info';
        box.innerHTML = '&#9675; โปรเจคปี <b>ลงทะเบียนครั้งที่ 1</b> &nbsp;(ครั้งที่ 2 จะลงทะเบียนได้หลังผ่านสอบหัวข้อ)';
        document.getElementById('parent_project_id').value = '';
      }
    }
  });
}

function resetYearProjectState() {
  document.getElementById('parent_project_id').value = '';
  document.getElementById('notice-box').style.display = 'none';
  document.getElementById('regis').disabled = false;
  document.getElementById('idteacher').disabled = false;
  document.getElementById('idteacher_note').style.display = 'none';
}

function onProjectTypeChange() {
  var type = getProjectType();
  resetYearProjectState();
  if (type === 'year') {
    var idstu = $('#idstu1').val();
    var hasTick = document.getElementById('cresult').innerHTML.indexOf('check') > -1;
    if (idstu != "" && hasTick) {
      checkYearProject(idstu);
    } else {
      var box = document.getElementById('notice-box');
      box.className = 'notice-info';
      box.style.display = 'block';
      box.innerHTML = '&#9675; โปรเจคปี: กรุณากรอกรหัสนักศึกษาก่อน ระบบจะตรวจสอบสิทธิ์การลงทะเบียนครั้งที่ 2';
    }
  }
}

function check() {
  var f = function(id){ return document.getElementById(id).value; };
  ['nameproject','engcasestudy','engnameproject','tel','idstu1','email','address','password','repassword']
    .forEach(function(id){ document.getElementById(id).style.borderColor = ""; });
  document.getElementById('passnotmatch').innerHTML = "";

  if (getProjectType() === 'year') {
    var box = document.getElementById('notice-box');
    if (box.className.indexOf('notice-danger') > -1) {
      alert('ไม่สามารถลงทะเบียนได้ โปรเจคปีเดิมยังไม่ผ่านการสอบหัวข้อ');
      return false;
    }
  }

  if (f('nameproject') == "")    { highlight('nameproject');   return false; }
  if (f('engnameproject') == "") { highlight('engnameproject'); return false; }
  if (f('casestudy') != "" && f('engcasestudy') == "") { highlight('engcasestudy'); return false; }
  if (f('idstu1') == "")        { highlight('idstu1');    return false; }
  if (document.getElementById('parent_project_id').value == "" && document.getElementById('idteacher').value == 0) { highlight('idteacher'); return false; }
  if (f('email') == "")         { highlight('email');    return false; }
  if (f('address') == "")       { highlight('address');  return false; }
  if (f('password') == "")      { highlight('password'); return false; }
  if (f('repassword') == "")    { highlight('repassword'); return false; }
  if (f('tel') == "")           { highlight('tel');      return false; }
  if (f('password') != f('repassword')) {
    highlight('repassword'); highlight('password');
    document.getElementById('passnotmatch').innerHTML = "<br/>รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน";
    return false;
  }
}
function highlight(id) {
  document.getElementById(id).style.borderColor = "#F00";
  document.getElementById(id).focus();
}
function clearre() {
  document.getElementById('cresult').innerHTML = "";
  document.getElementById('showname').innerHTML = "";
  resetYearProjectState();
}
</script>
</head>
<body>
<div id="loader" style="display:none; position:fixed; width:100%; height:100%; top:0; left:0; background:#999 url(check_ajax/loader.gif) no-repeat center; overflow:hidden; opacity:0.5; filter:alpha(opacity=50);">
</div>
<center>

  <?
  if (isset($_POST["regis"])) {
    ?>
    <table width="100%" height="400" border="0" align="center">
      <tr><td valign="middle" align="center">
    <?
    include('../connectdatabase.php');

    $nameproject    = mysqli_real_escape_string($connect, $nameproject);
    $casestudy      = mysqli_real_escape_string($connect, $casestudy);
    $engnameproject = mysqli_real_escape_string($connect, $engnameproject);
    $engcasestudy   = mysqli_real_escape_string($connect, $engcasestudy);
    $id_subject     = mysqli_real_escape_string($connect, $id_subject);
    $sec            = mysqli_real_escape_string($connect, $sec);
    $address        = mysqli_real_escape_string($connect, $address);
    $email          = mysqli_real_escape_string($connect, $email);
    $idstu1         = mysqli_real_escape_string($connect, $idstu1);
    $tel            = mysqli_real_escape_string($connect, $tel);
    $idteacher      = (int)$idteacher;

    $project_type      = (isset($_POST['project_type']) && $_POST['project_type'] === 'year') ? 'year' : 'term';
    $parent_project_id = (isset($_POST['parent_project_id']) && $_POST['parent_project_id'] !== '') ? (int)$_POST['parent_project_id'] : null;

    $go = true;
    // Server-side validation: year project 2nd registration must have a genuinely passed parent
    if ($project_type === 'year' && $parent_project_id !== null) {
      $passedIn  = "6,7,8,9,10,11,12,13,14,15,16,19,20,21,23,24";
      $idstu_esc = mysqli_real_escape_string($connect, $idstu1);
      $chk = mysqli_query($connect, "SELECT p.id_project FROM project p
          JOIN manipulator m ON m.id_project=p.id_project
          WHERE p.id_project='$parent_project_id' AND m.id_student='$idstu_esc'
            AND p.project_type='year' AND p.id_statusproject IN ($passedIn) LIMIT 1");
      if (mysqli_num_rows($chk) == 0) {
        echo '<b style="color:#F00">ไม่สามารถลงทะเบียนโปรเจคปีครั้งที่ 2 ได้ — โปรเจคเดิมยังไม่ผ่านการสอบหัวข้อ</b>';
        echo "<br/><input type='button' value='ย้อนกลับ' onclick='history.back();'/>";
        $go = false;
      } else {
        $pchk = mysqli_query($connect, "select year_project,semester_project from project where id_project='$parent_project_id'");
        $prow = mysqli_fetch_array($pchk);
        if ($prow && $prow['year_project']==$year && $prow['semester_project']==$semester) {
          echo '<b style="color:#F00">ยังไม่ถึงเวลาลงทะเบียนโปรเจค 2 ต้องรอภาคการศึกษาถัดไป</b>';
          echo "<br/><input type='button' value='ย้อนกลับ' onclick='history.back();'/>";
          $go = false;
        }
      }
    }

    if ($go) {
      // 2nd year-project registration reuses the parent's approved ทก.01 and skips the
      // title-exam stage entirely, starting directly at "จัดส่งทก.01หลังการสอบหัวข้อเรียบร้อยแล้ว"
      // (ready to submit for the 100% exam) -- matches project/registerproject2.php's behavior,
      // so the two ways of creating a "project 2" no longer diverge.
      $newStatus = '1';
      $torgorProject = '';
      $parentRow = null;
      if ($parent_project_id !== null) {
        $pResult = mysqli_query($connect, "select * from project where id_project='$parent_project_id'");
        $parentRow = mysqli_fetch_array($pResult);
        if ($parentRow) {
          $newStatus = '6';
          $torgorProject = mysqli_real_escape_string($connect, $parentRow['torgor_project']);
        }
      }

      $sql = "select max(id_project) from project where year_project = '$year' AND semester_project ='$semester'";
      $result = mysqli_query($connect, $sql);
      while($rs = mysqli_fetch_array($result)) {
        if($rs[0]!=NULL) $id = $rs[0]+1;
        else              $id = substr($year,2,4).$semester."001";
      }
      $sql = "select max(id_user) from user";
      $result = mysqli_query($connect, $sql);
      $mdfive = md5("$password");
      while($rs = mysqli_fetch_array($result)) { $iduser = $rs[0]+1; }

      $name1 = "ผู้จัดทำโครงงานพิเศษรหัส ".$id;
      mysqli_query($connect, "insert into user values('$iduser','$name1','','$id','$mdfive','4','1')");

      $pt      = mysqli_real_escape_string($connect, $project_type);
      $pid_sql = ($parent_project_id !== null) ? "'$parent_project_id'" : "NULL";
      $sql = "INSERT INTO project
              (id_project,name_project,casestudy_project,id_subject,year_project,semester_project,section_project,
               project_type,parent_project_id,address_project,email_project,torgor_project,id_statusproject,id_user,
               engname_project,engcasestudy_project)
              VALUES('$id','$nameproject','$casestudy','$id_subject','$year','$semester','$sec',
                     '$pt',$pid_sql,'$address','$email','$torgorProject','$newStatus','$iduser','$engnameproject','$engcasestudy')";
      mysqli_query($connect, $sql);

      $sql = "select max(id_manipulator) from manipulator";
      $result = mysqli_query($connect, $sql);
      while($rs = mysqli_fetch_array($result)) { $idmanipulator = $rs[0]+1; }
      mysqli_query($connect, "insert into manipulator values('$idmanipulator','$idstu1','$id','$tel')");

      if ($parentRow) {
        // round 2: carry the advisor + co-advisor over from the parent instead of the
        // (disabled) form dropdown, since ทก.01 approval was tied to that committee
        $cResult = mysqli_query($connect, "select * from committee where id_project='$parent_project_id' AND position='ที่ปรึกษา'");
        while ($c = mysqli_fetch_array($cResult)) {
          $r2 = mysqli_query($connect, "select max(id_committee) from committee");
          $rs2 = mysqli_fetch_array($r2);
          $idcommittee = $rs2[0]+1;
          $parentTeacher = (int)$c['id_teacher'];
          mysqli_query($connect, "insert into committee values('$idcommittee','$parentTeacher','$id','ที่ปรึกษา')");
        }
        $coResult = mysqli_query($connect, "select * from coadvisor where id_project='$parent_project_id'");
        while ($co = mysqli_fetch_array($coResult)) {
          $r2 = mysqli_query($connect, "select max(id_coadvisor) from coadvisor");
          $rs2 = mysqli_fetch_array($r2);
          $idcoadvisor = $rs2[0]+1;
          $idtitle = (int)$co['id_title'];
          $nname = mysqli_real_escape_string($connect, $co['name_coadvisor']);
          $nsname = mysqli_real_escape_string($connect, $co['sname_coadvisor']);
          mysqli_query($connect, "insert into coadvisor values('$idcoadvisor','$id','$idtitle','$nname','$nsname')");
        }
      } else {
        $sql = "select max(id_committee) from committee";
        $result = mysqli_query($connect, $sql);
        while($rs = mysqli_fetch_array($result)) { $idcommittee = $rs[0]+1; }
        mysqli_query($connect, "insert into committee values('$idcommittee','$idteacher','$id','ที่ปรึกษา')");
      }

      $type_label = ($project_type === 'year') ? 'โปรเจคปี' : 'โปรเจคเทอม';
      $reg_num    = ($parent_project_id !== null) ? ' (ลงทะเบียนครั้งที่ 2)' : '';
      echo '<b>ลงทะเบียนเสร็จเรียบร้อย ['.$type_label.$reg_num.']</b><br/>';
      echo '<b>ชื่อผู้ใช้งานสำหรับเข้าสู่ระบบของท่านคือ '.$id.'</b><br/>';
      echo "<br/><center><input type='button' value='ปิดหน้าจอ' onclick='window.close();' style='cursor:hand'></center>";
    }
    mysqli_close($connect);
    ?>
      </td></tr>
    </table>
    <?
  } else { ?>
  <h2>ลงทะเบียนประจำปีการศึกษา <?=$year?> ภาคเรียน <?=$semester?></h2>
</center>

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
  <table width="100%" border="0" align="center">
    <tr>
      <td align="right" valign="middle" nowrap="nowrap">ประเภทโครงการ :</td>
      <td>
        <label><input type="radio" name="project_type" value="term" checked="checked" onclick="onProjectTypeChange()"/> โปรเจคเทอม</label>
        &nbsp;&nbsp;
        <label><input type="radio" name="project_type" value="year" onclick="onProjectTypeChange()"/> โปรเจคปี</label>
        &nbsp;<span style="color:#888; font-size:11px;">(โปรเจคปีลงทะเบียนได้ 2 ครั้ง ครั้งที่ 2 ต้องผ่านสอบหัวข้อก่อน)</span>
        <input type="hidden" name="parent_project_id" id="parent_project_id" value="" />
      </td>
    </tr>
    <tr>
      <td></td>
      <td><div id="notice-box"></div></td>
    </tr>
    <tr>
      <td align="right" valign="middle" nowrap="nowrap">รหัสนักศึกษาผู้จัดทำ :</td>
      <td>
        <input name="idstu1" type="text" id="idstu1" size="13" maxlength="13" onblur="checkid()"/>
        *
        <span id="cresult" style="color:#F00"></span>
        <span id="showname" style="color:#030"></span>
      </td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">ชื่อโครงงาน :</td>
      <th align="left">
        <input name="nameproject" type="text" id="nameproject" size="50" maxlength="1000" />
        <input type="hidden" name="id_subject" id="id_subject" />
        <input type="hidden" name="year" id="year" />
        <input type="hidden" name="semester" id="semester" />
        <input type="hidden" name="sec" id="sec" />
        *
      </th>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">กรณีศึกษา :</td>
      <th align="left">
        <input name="casestudy" type="text" id="casestudy" size="50" maxlength="1000" />
      </th>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">ชื่อโครงงาน(ภาษาอังกฤษ) :</td>
      <th align="left">
        <input name="engnameproject" type="text" id="engnameproject" size="50" maxlength="1000" />
        *
      </th>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">กรณีศึกษา(ภาษาอังกฤษ) :</td>
      <th align="left">
        <input name="engcasestudy" type="text" id="engcasestudy" size="50" maxlength="1000" />
      </th>
    </tr>
    <tr>
      <td align="right">อาจารย์ที่ปรึกษา :</td>
      <th align="left">
        <select name="idteacher" id="idteacher">
          <option value="0">---เลือกอาจารย์---</option>
          <? include('../connectdatabase.php');
          $sql = "select * from teacher order by initials_teacher";
          $result = mysqli_query($connect, $sql);
          while($rs = mysqli_fetch_array($result)) { ?>
            <option value="<?=$rs[0]?>"><?=$rs[5]." ".$rs[3]." ".$rs[4]?></option>
          <? }
          mysqli_close($connect); ?>
        </select>
        *
        <span id="idteacher_note" style="display:none; color:#888; font-size:11px;">(ลงทะเบียนครั้งที่ 2 ใช้อาจารย์ที่ปรึกษาคนเดิมอัตโนมัติ ไม่ต้องเลือกใหม่)</span>
      </th>
    </tr>
    <tr>
      <td align="right" valign="middle" nowrap="nowrap">เบอร์โทรศัพท์ :</td>
      <td><input name="tel" type="text" id="tel" size="15" maxlength="20" /> *</td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">อีเมลล์ผู้จัดทำ :</td>
      <td><input type="text" name="email" id="email" /> *</td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap">ที่อยู่ผู้จัดทำ :</td>
      <td><textarea id="address" name="address" cols="40" rows="3"></textarea> *</td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">รหัสผ่านเข้าสู่ระบบ :</td>
      <th align="left">
        <input name="password" type="password" id="password" value="" size="10" />
        <span id="passnotmatch" style="color:#F00"></span> *
      </th>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">ยืนยันรหัสผ่าน :</td>
      <th align="left">
        <input name="repassword" type="password" id="repassword" value="" size="10" /> *
      </th>
    </tr>
    <tr>
      <th colspan="2">
        <input type="submit" name="regis" id="regis" value="ลงทะเบียน"/>
        <input type="reset" name="button2" id="button2" value="ล้าง" onclick="clearre()"/>
      </th>
    </tr>
  </table>
</form>
<p>
  <? } ?>
</p>
<span class="Dang">*หมายเหตุ เมื่อลงทะเบียนเรียบร้อยแล้วระบบจะแสดง username โปรดเก็บ usrename นี้ไว้เพื่อใช้ในการเข้าสู่ระบบ</span>
</body>
</html>
