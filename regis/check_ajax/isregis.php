<?
	include('../../connectdatabase.php');
	$sql = "select * from academicyear";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
	$regis = mysqli_query($connect, "select * from registration,student where student.id_student=registration.id_student AND year_registration='$year' and semester_registration='$semester' AND student.id_student='".$_GET["idstudent"]."'");
	if(mysqli_num_rows($regis)!=0)
	{
		while($rg = mysqli_fetch_array($regis))
		{
			$project = array(
				'check'=>true,
				'year'=>$rg[0],
				'semester'=>$rg[1],
				'sec'=>$rg[4],
				'id_subject'=>$rg[3],
				'showname'=>$rg[7]." ".$rg[8]
			);
		}
	}
	else
		$project = array('check'=>false);
	echo json_encode($project);
	