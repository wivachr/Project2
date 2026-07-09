<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<?php
define('FPDF_FONTPATH','font/');
require('mc_table.php');
class PDF extends PDF_MC_Table
{
	//Override คำสั่ง (เมธอด) Header
	function Header(){
 
		//ใช้ตัวอักษร Arial ตัวเอียง ขนาด 5
		$this->SetFont('angsana','B',16);
  		$this->SetFont('angsana','',14);
		$year2 = date('Y')+543;
		$this->Text(10,10,iconv( 'UTF-8','cp874' ,'วันที่ออกรายงาน '.date('d/m/').$year2));
		$this->SetFont('angsana','B',16);
		//พิมพ์ตัวหนังสือตัวเอียงๆ ที่ตำแหน่งเยื้องขอบกระดาษซ้าย 5หน่วย ขอบกระดาษบน 5หน่วย
		$this->Text(50,10,iconv( 'UTF-8','cp874' ,"รายชื่อโครงงานพิเศษที่มีกรณีศึกษา
 ประจำภาคเรียน ".$_GET["s"]." ปีการศึกษา ".$_GET["y"]));
 
		//ปัดบรรทัด กำหนดความกว้างของบรรทัด 20หน่วย
		$this->Ln(10);
		$this->SetFont('angsana','',12);
		$this->SetWidths(array(10,75,105));
		$this->Row(array("",iconv( 'UTF-8','cp874' ,"หน่วยงาน"),iconv( 'UTF-8','cp874' ,"ชื่อโครงงานพิเศษ")));
		$this->SetAligns(array('C','L','L'));
	}
 
}
$pdf=new PDF('P' , 'mm' , 'A4');
 
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
$pdf->SetWidths(array(10,75,105));
$header=array('Country','Capital','Area (sq km)','Pop. (thousands)');

 include('../connectdatabase.php');
	 $y = mysqli_real_escape_string($connect, $y);
	 $s = mysqli_real_escape_string($connect, $s);
	 $sql = "select casestudy_project,name_project from project where casestudy_project <>'' AND year_project ='$y'  AND semester_project ='$s'";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{

	$no=1;
while($rs = mysqli_fetch_array($result))
{
				$pdf->Row(array($no,iconv( 'UTF-8','cp874' ,$rs[0]),iconv( 'UTF-8','cp874' ,$rs[1]))); 
				$no++;
}
	}
$pdf->Output();
mysqli_close($connect);
?>