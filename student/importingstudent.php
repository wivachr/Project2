<? include('../change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?
include('../xlsxreader.php');

$ext = strtolower(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));
if($ext!="xlsx")
{
	?>
	<script language="javascript">
	window.parent.importfalse();
	</script>
	<?
}
else
{
	include('../connectdatabase.php');
	$rows = readXlsxRows($_FILES['fileField']['tmp_name']);

	$success = 0;
	$duplicates = array();
	$errors = array();

	for($i=1;$i<count($rows);$i++)
	{
		$r = $rows[$i];
		$id_student  = trim($r['A'] ?? '');
		$title_text  = trim($r['B'] ?? '');
		$name        = trim($r['C'] ?? '');
		$sname       = trim($r['D'] ?? '');
		$faculty_init= trim($r['E'] ?? '');
		$dept_init   = trim($r['F'] ?? '');
		$div_init    = trim($r['G'] ?? '');
		$curr_text   = trim($r['H'] ?? '');

		if($id_student === '') continue;

		$rownum = $i+1;
		$id_esc = mysqli_real_escape_string($connect, $id_student);

		$chk = mysqli_query($connect, "select id_student from student where id_student='$id_esc'");
		if($chk && mysqli_num_rows($chk)>0)
		{
			$duplicates[] = "แถว $rownum: รหัส $id_student มีอยู่แล้ว";
			continue;
		}

		$title_esc = mysqli_real_escape_string($connect, $title_text);
		$q = mysqli_query($connect, "select id_title from title where name_title='$title_esc'");
		$idtitle = ($q && mysqli_num_rows($q)>0) ? mysqli_fetch_array($q)['id_title'] : null;

		$fac_esc = mysqli_real_escape_string($connect, $faculty_init);
		$q = mysqli_query($connect, "select id_faculty from faculty where initials_faculty='$fac_esc'");
		$idfaculty = ($q && mysqli_num_rows($q)>0) ? mysqli_fetch_array($q)['id_faculty'] : null;

		$dept_esc = mysqli_real_escape_string($connect, $dept_init);
		$idfaculty_sql = $idfaculty!==null ? "'".$idfaculty."'" : "NULL";
		$q = mysqli_query($connect, "select id_department from department where initials_department='$dept_esc' AND id_faculty=$idfaculty_sql");
		$iddept = ($q && mysqli_num_rows($q)>0) ? mysqli_fetch_array($q)['id_department'] : null;

		$div_esc = mysqli_real_escape_string($connect, $div_init);
		$iddept_sql = $iddept!==null ? "'".$iddept."'" : "NULL";
		$q = mysqli_query($connect, "select id_division from division where initials_division='$div_esc' AND id_department=$iddept_sql");
		$iddivision = ($q && mysqli_num_rows($q)>0) ? mysqli_fetch_array($q)['id_division'] : null;

		$curr_esc = mysqli_real_escape_string($connect, $curr_text);
		$q = mysqli_query($connect, "select id_curr from curriculum where name_curr='$curr_esc'");
		$idcurr = ($q && mysqli_num_rows($q)>0) ? mysqli_fetch_array($q)['id_curr'] : null;

		$missing = array();
		if($idtitle===null)    $missing[] = "คำนำหน้า '$title_text'";
		if($idfaculty===null)  $missing[] = "คณะ '$faculty_init'";
		if($iddept===null)     $missing[] = "ภาควิชา '$dept_init'";
		if($iddivision===null) $missing[] = "สาขาวิชา '$div_init'";
		if($idcurr===null)     $missing[] = "หลักสูตร '$curr_text'";

		if(count($missing)>0)
		{
			$errors[] = "แถว $rownum ($id_student): ไม่พบข้อมูล ".implode(', ', $missing)." ในระบบ";
			continue;
		}

		$name_esc = mysqli_real_escape_string($connect, $name);
		$sname_esc = mysqli_real_escape_string($connect, $sname);
		mysqli_query($connect, "insert into student values('$id_esc','$idtitle','$name_esc','$sname_esc','$idfaculty','$iddept','$iddivision','$idcurr')");
		$success++;
	}

	mysqli_close($connect);

	$summary = "นำเข้าสำเร็จ $success รายการ";
	if(count($duplicates)>0) $summary .= "|ข้ามรายการซ้ำ ".count($duplicates)." รายการ: ".implode("; ", $duplicates);
	if(count($errors)>0) $summary .= "|พบข้อผิดพลาด ".count($errors)." รายการ: ".implode("; ", $errors);
	?>
	<script language="javascript">
	window.parent.importok(<?=json_encode($summary)?>);
	</script>
	<?
}
?>
</body>
</html>
