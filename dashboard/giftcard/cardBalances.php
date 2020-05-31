<?php
//cardBalances.php 2018/01
// View card Balances
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

// Estasblish Variables
unset($detail);
$detail=$_REQUEST['detail'];
$today = date("F j, Y, g:i a");

//Open The Database and look for the card
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `gc` WHERE `gc_balance` > 0 ORDER BY `gc_ID` DESC' ;
$result = mysqli_query($db, $sql);
$gcCount=mysqli_num_rows($result);
mysqli_close($db);
unset($total);
for($i = 0; $i < $gcCount; $i++){
    $cards[$i] = mysqli_fetch_assoc($result);
    $total = $total + $cards[$i]['gc_balance'];
}
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `gcLog`";
$result = mysqli_query($db, $sql);
$logCount=mysqli_num_rows($result);
for($i = 0; $i < $logCount; $i++){
    $logs[$i] = mysqli_fetch_assoc($result);
    $logs[$i]['year'] = substr($logs[$i]['gcLog_date'],0,4);
}

unset($year);
$yt=0;
for($i=0; $i < $logCount; $i++){
  if(!$year) $year = $logs[$i]['year'];
  if($year != $logs[$i]['year']){
    $year = $logs[$i]['year'];
    $yt++;
    }
  $totals[$yt][0] =  $year;
  $totals[$yt][1] = $totals[$yt][1]+$logs[$i]['gcLog_minus']; //redeemed
  $totals[$yt][2] = $totals[$yt][2]+$logs[$i]['gcLog_plus'];  //issued
}
$totCount = count($totals);
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="css/gcDash.css" type="text/css" />
  <title>Card Balances(<?= $gcCount ?>) </title>
</head>
<body>
<div id="banner"><a href="../index.php"><img alt="Homeport Logo" src="images/hplogosm.png" /></a></div>
<br />
<div class="title">Gift Card Dashboard</div>
<br /><br />
<table align="center" width="500" class="dashtable">
<tr><td colspan="4" align="center"><p class="boldstandard"><?= $today ?></p></td></tr>
<tr><td colspan="4" align="center"><p class="boldstandard"><?= $gcCount ?> Cards For a total of: <?= number_format($total,2) ?></p></td></tr>
    <tr>
        <td colspan="4" bgcolor="#666633" height="2"></td>
    </tr>
    <tr>
        <td>Year</td><td>Redeemed</td><td>Issued</td><td>Return Rate</td>
    </tr>
<?php for($i=0; $i<$totCount; $i++){ ?>
    <tr>
        <td><?= $totals[$i][0] ?></td><td><?= number_format($totals[$i][1],2) ?></td><td><?= number_format($totals[$i][2],2) ?></td><td><?= number_format($totals[$i][1]/$totals[$i][2]*100) ?>%</td>
    </tr>
<?php } ?>
</table>
<div class="title">
	<?php if(!$detail) { ?>
	<input value="Show Cards" onclick="parent.location='cardBalances.php?detail=yes'" type="button"> <?php } ?>
	<input value="Exit" onclick="parent.location='gcDash.php'" type="button">
</div>
<?php if($detail) { ?>
<table align="center" width="500"  border="1" cellpadding="4">
    <?php for($i=0; $i<$gcCount; $i++){ ?>
    <tr><td><?= $cards[$i]['gc_issued'] ?></td><td><?= $cards[$i]['gc_num'] ?></td><td align="right"><?= number_format($cards[$i]['gc_balance'],2) ?></tr>
    <?php } ?>
</table>
<?php } ?>
</body>
</html>