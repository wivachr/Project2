<?php
mysqli_report(MYSQLI_REPORT_OFF);
$host = "localhost";
$username = "root";
$passwd = "";
$dbname = "projectinformationsystem";
$connect = mysqli_connect($host, $username, $passwd, $dbname);
if (!$connect) die("Can't connect: " . mysqli_connect_error());
mysqli_set_charset($connect, 'utf8');
?>
