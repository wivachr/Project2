<? include('../change.php'); ?>
<?
	include('../connectdatabase.php');
$a=explode(";",$id);
foreach($a as $b)
{
	if($b == '') continue;
	mysqli_query($connect, $b);
}
	mysqli_close($connect);
?>