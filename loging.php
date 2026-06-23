<?php
session_start();
?>
<? include('change.php'); ?>
	<?
		include('connectdatabase.php');
		$password = md5($password);
		$stmt = mysqli_prepare($connect, "SELECT * FROM user WHERE username=? AND password=? AND status_user='1'");
		mysqli_stmt_bind_param($stmt, 'ss', $uname, $password);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if(mysqli_num_rows($result)!=0)
		{
			while($rs = mysqli_fetch_array($result))
			{
			$_SESSION['iduser']=$rs[0];
			$_SESSION['fullname']=$rs[1];
			$_SESSION['right']=$rs[5];
			$_SESSION['idproject']=$rs[3];
			}
			?>

            <?
		}
		else
		{
			echo "ไม่สามารถเข้าสู่ระบบได้";
		}
		mysqli_stmt_close($stmt);
		mysqli_close($connect);
	?>
