<? session_start(); ?>
<? include('../change.php'); ?>
<?
	if(!isset($_SESSION['right']) || $_SESSION['right']!='2') { exit; }
	if(!isset($teacherid) || trim($teacherid)==="") { exit; }
	include('../connectdatabase.php');
	$teacherid = (int)$teacherid;
	$ops = isset($ops) ? $ops : '';
	$tokens = explode(";", $ops);
	foreach($tokens as $t)
	{
		if($t === '') continue;
		$parts = explode(",", $t);
		if(count($parts)!=3) continue;
		$action = $parts[0];
		$day = (int)$parts[1];
		$time = (int)$parts[2];
		if($day<1 || $day>5) continue;
		if($action=="I")
		{
			$sql = "insert into teacherfreetime values($day,$time,$teacherid)";
			mysqli_query($connect, $sql);
		}
		else if($action=="D")
		{
			$sql = "delete from teacherfreetime where id_teacher = $teacherid AND day_freetime=$day AND time_freetime=$time";
			mysqli_query($connect, $sql);
		}
	}
	mysqli_close($connect);
?>