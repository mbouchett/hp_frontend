<?php
//cashReport.php 2018/01
// Cash Report

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$now = date("m/d/Y @ H:i");
$stamp = date("Y-m-d-H-i");

$fp = fopen('datestamp.txt', "r");
  // get the last run date
  $before= fgets($fp);
fclose($fp);

$year = substr($before,0,4);
$month = substr($before,5,2);
$day = substr($before,8,2);
$hour = substr($before,11,2);
$minute = substr($before,14,2);
$lastDate = $month.'/'.$day.'/'.$year.' @ '.$hour.':'.$minute;
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/gcDash.css" type="text/css" />
  <title>Homeport Cash Report</title>
</head>

<body>
<div id="banner"><a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a></div>
<div class="title">Homeport Cash Report</div>

 <table style="width: 500px;">
   <tr>
    <td align="right">Last Report: <?= $lastDate ?> <input value="Reset" onclick="parent.location='resetCashReport.php'" type="button"></td>
  </tr>
   <tr>
    <td align="center"><input style="width: 350px;" value="Run A New Report: <?= $now ?>" onclick="parent.location='processCashReport.php?stamp=<?= $stamp ?>&before=<?= $before ?>'" type="button"></td>
  </tr>
 </table>
<br /><br /><br />
<table align="center">
<tr><td align="center"><input value="Exit" onclick="parent.location='gcDash.php'" type="button">
</td></tr>
</table>
</body>

</html>