<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || ($_SESSION['right']!='2' && $_SESSION['right']!='3')) { exit; } ?>
<?php
	include('../connectdatabase.php');
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
	mysqli_close($connect);
define('FPDF_FONTPATH','font/');
require('mc_table.php');
	$idstudent=array();
	$namestudent=array();
	$telstudent=array();
	$gum=array();
$pdf=new PDF_MC_Table('P' , 'mm' , 'A4');
 
// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวธรรมดา กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','','angsa.php');
 
// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','B','angsab.php');
 
// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','I','angsai.php');
 
// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','BI','angsaz.php');
 
//สร้างหน้าเอกสาร
$pdf->Open();
$pdf->AddPage();
 
// กำหนดฟอนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 12
$pdf->SetFont('angsana','',12);
$pdf->SetWidths(array(50,130));
$pdf->SetAligns(array('C','C'));
$pdf->Cell(180,10,iconv( 'UTF-8','cp874' ,"รายชื่อโครงงานที่ยังไม่ยื่นสอบร้อยเปอร์เซ็นต์เมื่อใก้ลครบกำหนด"),0,1,'C');
 include('../connectdatabase.php'); 
	 $sql = "select * from project where (year_project<>'$year' OR semester_project<>'$semester') AND id_statusproject <> '0' AND id_statusproject <> '16' AND id_statusproject <> '18' AND id_statusproject <> '17'";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
	$pdf->Row(array( iconv( 'UTF-8','cp874' ,"รหัสโครงงานพิเศษ"),iconv( 'UTF-8','cp874' ,"ชื่อโครงงานพิเศษ")));
	$pdf->SetAligns(array('C','L'));
	while($rs = mysqli_fetch_array($result))
	{
				$pdf->Row(array( iconv( 'UTF-8','cp874' ,$rs[0]),iconv( 'UTF-8','cp874' ,$rs[1]))); 
	}
	}
$pdf->Output();
mysqli_close($connect);
?>