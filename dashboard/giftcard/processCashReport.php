<?php
//processSwipe.php 2018/01
// Main Gift Card Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

//create short variable name
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$stamp=$_REQUEST['stamp'];
$before=$_REQUEST['before'];

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * from `gcLog` WHERE `gcLog_date` > '".$before."'";
$result = mysqli_query($db, $sql);
$logCount=mysqli_num_rows($result);
for($i = 0; $i < $logCount; $i++){
    $logs[$i] = mysqli_fetch_assoc($result);
}

//Update Date Stamp
$fp = fopen('datestamp.txt', "w");
  fwrite($fp,$stamp);
fclose($fp);         		    //close the file

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/processCashReport.css" type="text/css" />
  <title>Homeport Cash Report</title>
</head>

<body>
<div id="banner"><img alt="Homeport Logo" src="images/hplogosm.png" /></div>
<br />
<div class="title">Homeport Gift Card Daily Report <?= date("m/d/Y @ H:i") ?></div>
<table>
	<tr>
   	<td>Date/Time</td>
   	<td>Card #</td>
   	<td class="bal">Balance</td>
   	<td class="red">Redeem</td>
   	<td class="iss">Issued</td>
   	<td class="use">User</td>
	</tr>

 <?php for($i=$logCount-1; $i > -1; $i--){
 $day = substr($logs[$i]['gcLog_date'],8,2);
 $month = substr($logs[$i]['gcLog_date'],5,2);
 $year = substr($logs[$i]['gcLog_date'],0,4);
 $hour = substr($logs[$i]['gcLog_date'],11,2);
 $minute = substr($logs[$i]['gcLog_date'],14,2);
 $tSamp = $month.'/'.$day.'/'.$year.', '.$hour.':'. $minute;
 $redeemed=$redeemed+$logs[$i][gcLog_minus];
 $issued=$issued+$logs[$i]['gcLog_plus'];
 
 ?>
    <tr>
        <td><?= $tSamp?></td>
        <td><?=$logs[$i]['gcLog_num']?></td>
        <td class="bal" align="right"><?=$logs[$i]['gcLog_balance']?></td>
        <td class="red" align="right"><?=$logs[$i]['gcLog_minus']?></td>
        <td class="iss" align="right"><?=$logs[$i][gcLog_plus]?></td>
        <td class="use"><?=$logs[$i]['gcLog_user']?></td>
    </tr>
  <?php }
  if($logCount < 1){ ?>
    <tr>
        <td colspan="6" align="center"><h4>No New Transactions</h4></td>
    </tr>
  <?php }?>
 </table>
 <table width="550" align="center" border="4" style="border-color: #B8860B">
    <tr>
        <td align="right">Total Redeemed: $<?= number_format($redeemed,2) ?></td><td align="right">Total Issued: $<?= number_format($issued,2) ?></td><td align="center"><input value="Print This Report" TYPE="button" onClick="window.print()"></td>
    </tr>
 </table>
<br />
<table align="center">
<tr><td align="center"><input value="Exit" onclick="parent.location='gcDash.php'" type="button">
</td></tr>
</table>
</body>
</html>