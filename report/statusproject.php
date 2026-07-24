<? include('../change.php'); ?>
<?php
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
		$pdf->SetFont('angsana','',14);
		$year2 = date('Y')+543;
		$pdf->Text(10,10,iconv( 'UTF-8','cp874//IGNORE' ,'วันที่ออกรายงาน '.date('d/m/').$year2));
		$pdf->SetFont('angsana','B',16);
$pdf->SetFont('angsana','',12);
$pdf->SetWidths(array(25,100,60));
$header=array('Country','Capital','Area (sq km)','Pop. (thousands)');
$pdf->SetAligns(array('C','C','C'));
 include('../connectdatabase.php'); 
	 $sql = "select project.id_project,name_project,name_statusproject,name_teacher from project,statusproject,committee,teacher where  teacher.id_teacher=committee.id_teacher AND project.id_statusproject=statusproject.id_statusproject AND committee.id_project = project.id_project AND position='ที่ปรึกษา' AND teacher.id_teacher='$teacher' AND (statusproject.id_statusproject<>'0' AND statusproject.id_statusproject<>'16' AND statusproject.id_statusproject<>'18' AND statusproject.id_statusproject<>'17')";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
		$num = 0;
	$pdf->SetAligns(array('C','L','L'));
while($rs = mysqli_fetch_array($result))
{
	if($num==0)
	{
		$pdf->SetFont('angsana','B',16);
		$pdf->Cell(180,20,iconv( 'UTF-8','cp874//IGNORE' ,"รายงานสถานะโครงงานพิเศษของ อาจารย์".$rs[3]),0,1,'C');
		$pdf->SetFont('angsana','',12);
		$pdf->Row(array( iconv( 'UTF-8','cp874//IGNORE' ,"รหัสโครงงานพิเศษ"),iconv( 'UTF-8','cp874//IGNORE' ,"ชื่อโครงงานพิเศษ"),iconv( 'UTF-8','cp874//IGNORE' ,"สถานะโครงงานพิเศษ")));
		$num += 1;
	}
				$pdf->Row(array( iconv( 'UTF-8','cp874//IGNORE' ,$rs[0]),iconv( 'UTF-8','cp874//IGNORE' ,$rs[1]),iconv( 'UTF-8','cp874//IGNORE' ,$rs[2]))); 
				
}
	}
$pdf->Output();
mysqli_close($connect);
?>