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
		$id_student = trim($r['A'] ?? '');
		$year       = trim($r['B'] ?? '');
		$semester   = trim($r['C'] ?? '');
		$id_subject = trim($r['D'] ?? '');
		$section    = trim($r['F'] ?? '');

		if($id_student === '') continue;

		$rownum = $i+1;

		$id_esc = mysqli_real_escape_string($connect, $id_student);
		$q = mysqli_query($connect, "select id_student from student where id_student='$id_esc'");
		$studentfound = ($q && mysqli_num_rows($q)>0);

		$subj_esc = mysqli_real_escape_string($connect, $id_subject);
		$q = mysqli_query($connect, "select id_subject from subject where id_subject='$subj_esc'");
		$subjectfound = ($q && mysqli_num_rows($q)>0);

		$missing = array();
		if(!$studentfound) $missing[] = "รหัสนักศึกษา '$id_student'";
		if(!$subjectfound) $missing[] = "รหัสวิชา '$id_subject'";

		if(count($missing)>0)
		{
			$errors[] = "แถว $rownum: ไม่พบข้อมูล ".implode(', ', $missing)." ในระบบ";
			continue;
		}

		$year_esc = mysqli_real_escape_string($connect, $year);
		$sem_esc = mysqli_real_escape_string($connect, $semester);
		$sec_esc = mysqli_real_escape_string($connect, $section);

		$chk = mysqli_query($connect, "select 1 from registration where year_registration='$year_esc' AND semester_registration='$sem_esc' AND id_student='$id_esc' AND id_subject='$subj_esc' AND section='$sec_esc'");
		if($chk && mysqli_num_rows($chk)>0)
		{
			$duplicates[] = "แถว $rownum: รหัส $id_student ลงทะเบียนวิชานี้ไว้แล้ว";
			continue;
		}

		mysqli_query($connect, "insert into registration values('$year_esc','$sem_esc','$id_esc','$subj_esc','$sec_esc')");
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
