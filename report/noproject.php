<? include('../change.php'); ?>
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
		$this->Text(60,10,iconv( 'UTF-8','cp874//IGNORE' ,"รายชื่อนักศึกษาที่ยังไม่มีหัวข้อประจำ ภาคเรียน ".$semester." ปีการศึกษา ".$year));
		$this->Text(75,20,iconv( 'UTF-8','cp874//IGNORE' ,'คณะเทคโนโลยีและการจัดการอุตสาหกรรม'));
  		$this->SetFont('angsana','',14);
		$year2 = date('Y')+543;
		$this->Text(10,10,iconv( 'UTF-8','cp874//IGNORE' ,'วันที่ออกรายงาน '.date('d/m/').$year2));
		$this->SetFont('angsana','B',16);
		//ปัดบรรทัด กำหนดความกว้างของบรรทัด 20หน่วย
		$this->Ln(20);
		$this->SetFont('angsana','',12);
$this->SetWidths(array(50,130));
$this->SetAligns(array('C','C'));
			$this->Row(array( iconv( 'UTF-8','cp874//IGNORE' ,"รหัสนักศึกษา"),iconv( 'UTF-8','cp874//IGNORE' ,"ชื่อ-สกุลนักศึกษา")));
	$this->SetAligns(array('C','L'));
	}
 
}
	$idstudent=array();
	$namestudent=array();
	$telstudent=array();
	$gum=array();
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

$header=array('Country','Capital','Area (sq km)','Pop. (thousands)');
 include('../connectdatabase.php'); 

	 $sql = "select name_title,student.id_student,name_student,sname_student from title,student,registration where student.id_student=registration.id_student  AND 	year_registration='$year' AND 	semester_registration='$semester' AND title.id_title=student.id_title AND student.id_student NOT IN(select id_student from manipulator,project where manipulator.id_project =project.id_project AND year_project = '$year' AND semester_project = '$semester')
UNION
select name_title,student.id_student,name_student,sname_student from title,student,manipulator,project,registration where student.id_student=registration.id_student AND project.id_project = manipulator.id_project AND title.id_title=student.id_title AND manipulator.id_student=student.id_student AND (project.id_statusproject='0' OR project.id_statusproject='18') AND 	year_registration='$year' AND 	semester_registration='$semester' AND student.id_student NOT IN (select student.id_student from title,student,manipulator,project,registration where student.id_student=registration.id_student AND project.id_project = manipulator.id_project AND title.id_title=student.id_title AND manipulator.id_student=student.id_student AND project.id_statusproject<>'0' AND project.id_statusproject<>'18' AND year_registration='$year' AND 	semester_registration='$semester')";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{

while($rs = mysqli_fetch_array($result))
{
				$pdf->Row(array( iconv( 'UTF-8','cp874//IGNORE' ,$rs[1]),iconv( 'UTF-8','cp874//IGNORE' ,$rs[0].$rs[2]." ".$rs[3]))); 
}
	}
$pdf->Output();
mysqli_close($connect);
?>