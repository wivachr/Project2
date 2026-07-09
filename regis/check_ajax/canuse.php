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
	$query = "select manipulator.id_student from project,manipulator ";
	$query .= " WHERE project.id_project=manipulator.id_project AND project.year_project='$year' AND ";
	$query .= "project.semester_project='$semester'";
	$query .= "AND (project.id_statusproject<>'0' AND project.id_statusproject<>'18')";
	$query .= " AND manipulator.id_student ='".$idstudent."'";
	$result = mysqli_query($connect, $query);
	while($rs = mysqli_fetch_array($result))
	{
		echo $rs[0];
	}
?>