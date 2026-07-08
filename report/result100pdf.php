<? session_start(); ?>
<? include('../change.php'); ?>
<? if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; } ?>
<?php
require('mc_table.php');
class PDF extends PDF_MC_Table
{
	//Override คำสั่ง (เมธอด) Header
	function Header(){
 
		//ใช้ตัวอักษร Arial ตัวเอียง ขนาด 5
		$this->SetFont('angsana','B',16);
 
		//พิมพ์ตัวหนังสือตัวเอียงๆ ที่ตำแหน่งเยื้องขอบกระดาษซ้าย 5หน่วย ขอบกระดาษบน 5หน่วย
		$this->Text(100,10,iconv( 'UTF-8','cp874' ,"รายงานผลการสอบร้อยเปอร์เซ็นต์ ประจำภาคเรียน ".$_GET["s"]." ปีการศึกษา ".$_GET["y"]));
		$this->Text(119,20,iconv( 'UTF-8','cp874' ,'คณะเทคโนโลยีและการจัดการอุตสาหกรรม'));
 		$this->SetFont('angsana','',14);
		$year2 = date('Y')+543;
		$this->Text(10,10,iconv( 'UTF-8','cp874' ,'วันที่ออกรายงาน '.date('d/m/').$year2));
		$this->SetFont('angsana','B',16);
		//ปัดบรรทัด กำหนดความกว้างของบรรทัด 20หน่วย
		$this->Ln(20);
		$this->SetFont('angsana','',12);
		$this->SetWidths(array(8,25,70,25,40,25,25,30,35));
		$this->SetAligns(array('C','C','C','C','C','C','C','C','C'));
$this->Row(array("",iconv( 'UTF-8','cp874' ,"รหัสโครงงานพิเศษ"),iconv( 'UTF-8','cp874' ,"ชื่อโครงงานพิเศษ"),iconv( 'UTF-8','cp874' ,"รหัสประจำตัว"),iconv( 'UTF-8','cp874' ,"ชื่อ - สกุล"),iconv( 'UTF-8','cp874' ,"อาจารย์ที่ปรึกษา"),iconv( 'UTF-8','cp874' ,"วัน/เวลา"),iconv( 'UTF-8','cp874' ,"กรรมการ"),iconv( 'UTF-8','cp874' ,"หมายเหตุ")));
$this->SetAligns(array('C','C','L','C','L','L','C','L','C'));
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
 include('../connectdatabase.php');
 $teacher = (int)$teacher;
 $y = mysqli_real_escape_string($connect, $y);
 $s = mysqli_real_escape_string($connect, $s);
 	$sql = "select * from academicyear";
	 $result = mysqli_query($connect, $sql);
	 while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
 $sql = "select project.id_project,name_project,engname_project,casestudy_project,name_typeexam,date_assignexam,time_assignexam,name_room,endtime_assignexam,statusproject.name_statusproject from assignexam,room,exam,project,typeexam,committee,statusproject where statusproject.id_statusproject=exam.id_statusproject AND exam.id_typeexam='2' AND committee.id_project=project.id_project AND position = 'ที่ปรึกษา' AND committee.id_teacher='$teacher' AND assignexam.id_room=room.id_room AND assignexam.id_exam=exam.id_exam AND (exam.id_statusproject ='24' OR exam.id_statusproject  = '23' OR exam.id_statusproject  = '25') AND exam.id_project=project.id_project AND typeexam.id_typeexam = exam.id_typeexam AND year_exam ='$y'  AND semester_exam ='$s'";
$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)!=0)
	{	$no = 1;

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
				 $sql2 = "select * from teacher,committee,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND teacher.id_teacher=committee.id_teacher AND committee.position='ที่ปรึกษา' AND id_project='".$rs[0]."'";
				  $result2 = mysqli_query($connect, $sql2);
				 while($rs2 = mysqli_fetch_array($result2))
				 {
					 $teacher = $rs2[18].$rs2[3];
				 }
				 $sql3 = "select * from teacher,committee,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND teacher.id_teacher=committee.id_teacher AND committee.position='ประธาน' AND id_project='".$rs[0]."'";
				  $result3 = mysqli_query($connect, $sql3);
				 while($rs2 = mysqli_fetch_array($result3))
				 {
					 $gum[$nn] = $rs2[18].$rs2[3];
					 $nn++;
				 }
				 $sql3 = "select * from teacher,committee,academictitle where academictitle.id_academictitle = teacher.id_academictitle AND teacher.id_teacher=committee.id_teacher AND committee.position='กรรมการ' AND id_project='".$rs[0]."'";
				  $result3 = mysqli_query($connect, $sql3);
				 while($rs2 = mysqli_fetch_array($result3))
				 {
					 $gum[$nn] = $rs2[18].$rs2[3];
					 $nn++;
				 }
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
				 for($i = 0;$i<$n;$i++)
				 {
					 $strtel .= $telstudent[$i]."\n";
				 }
				 for($i = 0;$i<$nn;$i++)
				 {
					 $strgum .= $gum[$i]."\n";
				 }
				 $d = explode("-", $rs[5]);
				 $date = new DateTime();
				 $date->setDate((int)$d[0]-543,(int)$d[1],(int)$d[2]);
				$year = $date->format('Y')+543;
								if($date->format('N')==1)
				{
					$day = "จ.";
				}
				else if($date->format('N')==2)
				{
					$day = "อ.";
				}
				else if($date->format('N')==3)
				{
					$day = "พ.";
				}
				else if($date->format('N')==4)
				{
					$day = "พฤ.";
				}
				else if($date->format('N')==5)
				{
					$day = "ศ.";
				}
				else if($date->format('N')==6)
				{
					$day = "ส.";
				}
				else if($date->format('N')==7)
				{
					$day = "อท.";
				}
				if($date->format('m')==1)
				{
					$m = "ม.ค.";
				}
				else if($date->format('m')==2)
				{
					$m = "ก.พ.";
				}
				else if($date->format('m')==3)
				{
					$m = "มี.ค.";
				}
				else if($date->format('m')==4)
				{
					$m = "เม.ย.";
				}
				else if($date->format('m')==5)
				{
					$m = "พ.ค.";
				}
				else if($date->format('m')==6)
				{
					$m = "มิ.ย.";
				}
				else if($date->format('m')==7)
				{
					$m = "ก.ค.";
				}
				else if($date->format('m')==8)
				{
					$m = "ส.ค.";
				}
				else if($date->format('m')==9)
				{
					$m = "ก.ย.";
				}
				else if($date->format('m')==10)
				{
					$m = "ต.ค.";
				}
				else if($date->format('m')==11)
				{
					$m = "พ.ย.";
				}
				else if($date->format('m')==12)
				{
					$m = "ธ.ค.";
				}
				$yy = $date->format('Y')+543;
				$dshow = $day." ".$date->format('d')." ".$m." ".substr($yy,2,2)."\n".$rs[6]." น.-".$rs[8]."น.\n".$rs[7];
				$pdf->Row(array($no,iconv( 'UTF-8','cp874' ,$rs[0]."\n".$rs[9]),iconv( 'UTF-8','cp874' ,$rs[1]."\n".$rs[2]."\n".$rs[3]."\n".$rs[4]),iconv( 'UTF-8','cp874' ,$strid),iconv( 'UTF-8','cp874' ,$strname),iconv( 'UTF-8','cp874' ,$teacher),iconv( 'UTF-8','cp874' ,$dshow),iconv( 'UTF-8','cp874' ,$strgum),iconv( 'UTF-8','cp874' ,$strtel)));
				$no++;
			  }
	}
	
$pdf->Output();
mysqli_close($connect);
?>