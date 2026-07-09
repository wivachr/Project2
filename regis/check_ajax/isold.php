<?
	include('../../connectdatabase.php');
	$idstudent = mysqli_real_escape_string($connect, $_GET["idstudent"]);
	$sql = "select * from academicyear";
	$result = mysqli_query($connect, $sql);
	while($rs = mysqli_fetch_array($result))
	{
		$year = $rs[0];
		$semester = $rs[1];
	}
	$regis = mysqli_query($connect, "select * from registration,student where student.id_student=registration.id_student AND year_registration='$year' and semester_registration='$semester' AND student.id_student='".$idstudent."'");
	if(mysqli_num_rows($regis)!=0)
	{
		while($rg = mysqli_fetch_array($regis))
		{
			$query = "SELECT * FROM project,manipulator WHERE project.id_project=manipulator.id_project";
			$query .= " AND (project.year_project<>'$year' OR project.semester_project<>'$semester')";
			$query .= " AND (project.id_statusproject='16') AND manipulator.id_student='".$idstudent."'";
			$result = mysqli_query($connect, $query);
			if(mysqli_num_rows($result)!=0)
			{
				while($rs = mysqli_fetch_array($result))
				{
					$project = array(
					'check'=>true,
					'oldproject'=>$rs[0],
					'nameproject'=>$rs[1],
					'casestudy'=>$rs[2],
					'engnameproject'=>$rs[12],
					'engcasestudy' => $rs[13],
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
		}
	}
	else
		$project = array('check'=>false);
	echo json_encode($project);
	