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
define('FPDF_FONTPATH','font/');
require('mc_table.php');
class PDF extends PDF_MC_Table
{
	//Override คำสั่ง (เมธอด) Header
	function Header(){
 	include('../connectdatabase.php'); 
	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
		//ใช้ตัวอักษร Arial ตัวเอียง ขนาด 5
		$this->SetFont('angsana','B',16);
 
		//พิมพ์ตัวหนังสือตัวเอียงๆ ที่ตำแหน่งเยื้องขอบกระดาษซ้าย 5หน่วย ขอบกระดาษบน 5หน่วย
		$this->Text(90,10,iconv( 'UTF-8','cp874' ,"รายชื่อโครงงานพิเศษที่ยังไม่ยื่นเรื่องสอบร้อยเปอร์เซ็นต์เมื่อเกินเวลาที่กำหนด 2 ภาคเรียน"));
		$this->Text(130,20,iconv( 'UTF-8','cp874' ,"ประจำภาคเรียนที่ $semester ปีการศึกษา $year"));
		$this->Text(125,30,iconv( 'UTF-8','cp874' ,'คณะเทคโนโลยีและการจัดการอุตสาหกรรม'));
   		$this->SetFont('angsana','',14);
		$year2 = date('Y')+543;
		$this->Text(10,10,iconv( 'UTF-8','cp874' ,'วันที่ออกรายงาน '.date('d/m/').$year2));
		$this->SetFont('angsana','B',16);
		//ปัดบรรทัด กำหนดความกว้างของบรรทัด 20หน่วย
		$this->Ln(30);
		$this->SetFont('angsana','',12);
$this->SetWidths(array(8,30,85,30,50,40,40));
$this->SetAligns(array('C','C','C','C','C','C'));
			$this->Row(array("",iconv( 'UTF-8','cp874' ,"รหัสโครงงานพิเศษ"),iconv( 'UTF-8','cp874' ,"ชื่อโครงงานพิเศษ"),iconv( 'UTF-8','cp874' ,"รหัสประจำตัว"),iconv( 'UTF-8','cp874' ,"ชื่อ - สกุล"),iconv( 'UTF-8','cp874' ,"ภาคปีการศึกษาที่ลงทะเบียน"),iconv( 'UTF-8','cp874' ,"สถานะโครงงาน")));
	$this->SetAligns(array('C','C','L','C','L','C','L'));
	}
 
}

	$idstudent=array();
	$namestudent=array();
	$telstudent=array();
	$gum=array();
$pdf=new PDF('L' , 'mm' , 'A4');
 
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
$pdf->SetWidths(array(8,30,85,30,50,40,40));
		$sql = "select id_project,name_project,semester_project,year_project,name_statusproject from academicyear,project,statusproject where statusproject.id_statusproject=project.id_statusproject AND (((year-year_project)*2)+semester)-semester_project > 1 AND (project.id_statusproject <> '0' AND project.id_statusproject <> '17' AND project.id_statusproject <> '18' AND project.id_statusproject <> '16' AND project.id_statusproject <> '12' AND project.id_statusproject <> '13' AND project.id_statusproject <> '14')";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{
		$no = 1;

	while($rs = mysqli_fetch_array($result))
	{
			$n = 0;
	$nn = 0;
	$strname="";
	$strid="";
	$teacher="";
	$dshow="";
	$strgum="";
	$strtel="";
						 $sql4 = "select * from student,title,manipulator where student.id_student=manipulator.id_student AND id_project='".$rs[0]."' AND student.id_title=title.id_title";
				 $result4 = mysqli_query($connect, $sql4);
				 while($rs2 = mysqli_fetch_array($result4))
				 {
					 $idstudent[$n]=$rs2[0];
					 $namestudent[$n]=$rs2[9].$rs2[2]." ".$rs2[3];
					 $telstudent[$n]=$rs2[13];
					 $n++;
				 }
				 for($i = 0;$i<$n;$i++)
				 {
					 $strid .= $idstudent[$i]."\n";
				 }
				 for($i = 0;$i<$n;$i++)
				 {
					 $strname .= $namestudent[$i]."\n";
				 }
				$pdf->Row(array($no,iconv( 'UTF-8','cp874' ,$rs[0]),iconv( 'UTF-8','cp874' ,$rs[1]),iconv( 'UTF-8','cp874' ,$strid),iconv( 'UTF-8','cp874' ,$strname),iconv( 'UTF-8','cp874' ,$rs[2]."/".$rs[3]),iconv( 'UTF-8','cp874' ,$rs[4]))); 
				$no++;
	}
	}
$pdf->Output();
mysqli_close($connect);
?>