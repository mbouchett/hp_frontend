<?php
//processCsEdit.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

// take a bunch of seconds and convert to Decimal hours
function timeNumber($sec){
    $hours = floor($sec / 3600);
    $decimalHours = $hours + (floor(($sec / 60) % 60)/60);
    return $decimalHours;
}

@$pp1 = $_POST['pp1'];
@$start = $_POST['start'];
@$end = $_POST['end'];

//Get the payperiod profile Load A Single Value From A Flat File
$fp = fopen('pp.txt', "r");             //Open The File For Reading
  $pp = fgets($fp);                     //Load an arbitrary pay period to set the base
  $ppDays = fgets($fp);                 //Load load the pay period length in days
fclose($fp);                            //Close The File
$today = date('Y-m-d');

// calculate current payperiod start
while (strtotime($pp) < strtotime($today)){
    $pp = date('Y-m-d', strtotime($pp. ' + '.$ppDays.' days'));
}
$ppStart = date('Y-m-d', strtotime($pp. ' - '.$ppDays.' days'));

$ppEnd = date('Y-m-d', strtotime($pp. ' - '.$ppDays.' days'));

// Make a list of the pay period starts and ends for the dropdown
for($i = 0;$i < 52; $i++){
    $plus = $i * $ppDays;
    $ppList[$i]['start'] = date('Y-m-d', strtotime($ppStart. ' - '.$plus.' days'));
    $ppList[$i]['end'] = date('Y-m-d', strtotime($ppList[$i]['start']. ' + 13 days'));
}

// If no payperiod start date has been selected then choose current pp for start
if (!$pp1) $pp1 = $ppStart;
$pp1 = date('Y-m-d H:i', strtotime($pp1));
$pp2 = date('Y-m-d H:i', strtotime($pp1. ' + '.$ppDays.' days - 1 second'));

// If a date range has been selected then override the defauld start
if($start && $end){
    $pp1 = date('Y-m-d H:i', strtotime($start));
    $pp2 = date('Y-m-d H:i', strtotime($end.' + 23 hours + 59 minutes'));
}

// get the raw punches for the period
// Get raw Swipes For The Period
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `rawPunch` WHERE `punch_timeStamp` BETWEEN \''.$pp1.'\' AND \''.$pp2.'\' ORDER BY `resource_ID`, `punch_timeStamp`' ;
$result = mysqli_query($db, $sql); // create the query object
$swipeCount=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$swipeCount; $i++){               //Iniate The Loop
    $swipe[$i]=mysqli_fetch_assoc($result);     //Fetch & Store The Current Record
}
// begin swipe analysis
// look for missing swipes
$dangle = "Period Balanced";
$ii = 0;
for($i = 0; $i < $swipeCount; $i++){
    // if this is not the first punch
    if($i > 0){
        // if it's a new day
        if(date('Y-m-d', strtotime($swipe[$i]['punch_timeStamp'])) > date('Y-m-d', strtotime($swipe[$i-1]['punch_timeStamp']))){
            // if the punches are uneven
            if($ii % 2 != 0){
                $swipe[$i-1]['uneven'] = "Dangling Punch";
                $dangle = "This Period Is Not Balanced";
            }
            $ii = 0;
        }
    }
    $ii++;
}

//Time Calculations
$wk1 = 0;
$wk2 = 0;
$ot = 0;
$ii = 0;
if($dangle == "Period Balanced"){
    for($i = 1; $i < $swipeCount; $i++){
        if($i % 2 != 0){    //It's an even number
          $diff = strtotime($swipe[$i]['punch_timeStamp']) - strtotime($swipe[$i-1]['punch_timeStamp']);
          $swipe[$i]['timeDiff'] = gmdate('H:i', $diff);
          if(strtotime($swipe[$i]['punch_timeStamp']) < strtotime($pp1.' + 7 days - 1 second')){
            $wk1 = $wk1 + $diff;
          }else{
            $wk2 = $wk2 + $diff;
          }
        }else{              //It's an odd number
            if($swipe[$i]['resource_ID'] !=  $swipe[$i-1]['resource_ID']){ //It's a new card
                $swipeSum[$ii] = $swipe[$i-1];
                $wk1 = timeNumber($wk1);
                $wk2 = timeNumber($wk2);
                if($wk1 > 40){
                    $ot = $ot + ($wk1 - 40);
                    $wk1 = 40;
                }
                if($wk2 > 40){
                    $ot = $ot + ($wk2 - 40);
                    $wk2 = 40;
                }
                $swipeSum[$ii]['regHours'] = $wk1 + $wk2;
                $swipeSum[$ii]['ot'] = $ot;
                $wk1 = 0;
                $wk2 = 0;
                $ot = 0;
                $ii++;
            }
        }
    }
    @$swipeSum[$ii] = $swipe[$i-1];
    $wk1 = timeNumber($wk1);
    $wk2 = timeNumber($wk2);
    if($wk1 > 40){
        $ot = $ot + ($wk1 - 40);
        $wk1 = 40;
    }
    if($wk2 > 40){
        $ot = $ot + ($wk2 - 40);
        $wk2 = 40;
    }
    $swipeSum[$ii]['regHours'] = $wk1 + $wk2;
    $swipeSum[$ii]['ot'] = $ot;
    $wk1 = 0;
    $wk2 = 0;
    $ot = 0;
    $ii++;
}
$swipeSumCount = count($swipeSum);

//Open The Database and get the user info
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `resource` ORDER BY `resource_lastName`";
$result = mysqli_query($db, $sql); // create the query object
$resourceCount=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$resourceCount; $i++){               //Iniate The Loop
    $resources[$i]=mysqli_fetch_assoc($result);     //Fetch & Store The Current Record
}
//assign names to the summary

for($i = 0; $i < $swipeSumCount; $i++){
    for($ii = 0; $ii < $resourceCount; $ii++){
        if(@$swipeSum[$i]['resource_ID'] == @$resources[$ii]['resource_ID']){
            $swipeSum[$i]['firstName'] = $resources[$ii]['resource_firstName'];
            $swipeSum[$i]['lastName'] = $resources[$ii]['resource_lastName'];
            $swipeSum[$i]['empNumber'] = $resources[$ii]['resource_num'];
            $swipeSum[$i]['rate'] = $resources[$ii]['resource_hourly'];
        }
    }
}

//bubble sort for the summary by employee number
$end = count($swipeSum);
$status = 1;
while($status == 1){
    $status = 0;
    for($i = 1; $i < $end; $i++){
        $container = $swipeSum[$i - 1];
        if($swipeSum[$i]['empNumber'] < $container['empNumber']){
            //swap places
            $swipeSum[$i-1] = $swipeSum[$i];
            $swipeSum[$i] = $container;
            $status = 1;
        }
    }
    $end--;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
  <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
  <link rel="SHORTCUT ICON" href="images/schedule.ico">
  <title>Web Schedule Pay Period Summary - <?= $dangle ?> (a)</title>
  <script type="text/javascript" src="js/periodSummary.js"></script>
</head>
  <body>
  <br /><br />
    <form name="selectPeriod" action="periodSummary.php" method="post">
    <div class="dashtitle">Period Summary: <?= $dangle ?></div><br>
    <div class="hideforprint">Period Start:<input type="text" name="start" placeholder="yyyy-mm-dd"> End: <input type="text" name="end" placeholder="yyyy-mm-dd"> or
      <select name="pp1" size="1">
      <?php for($i = 0;$i < 52; $i++){ ?>
      <option
        <?php if($ppList[$i]['start'] == date('Y-m-d', strtotime($pp1))) echo " selected=\"selected\" "?>
        onclick="this.form.submit()" value="<?= $ppList[$i]['start'] ?>"><?= $ppList[$i]['end'] ?>
      </option>
      <?php } ?>
      </select>
      <input type="submit" name="" value="Go" />
      </div></form>
    <hr><div class="dashtitlemed">
    <?= date('Y-m-d', strtotime($pp1)) ?> -
    <?= date('Y-m-d', strtotime($pp2)) ?></div>
    <hr>
    <table class="listtable">
    <tr class="tableheadtext"><td>Employee Name</td><td>E#</td><td>Tl Pay</td><td>Regular Hours</td><td>OT Hours</td><td>Total Hours</td><td>Vac Pay</td></tr>
    <?php for($i = 0; $i < $swipeSumCount; $i++){ 
    //Calculate Potential Holiday Pay
      $holidayPay = 0;
  		if($swipeSum[$i]['regHours'] > 0) $holidayPay = 4 * $swipeSum[$i]['rate'];
  		if($swipeSum[$i]['regHours'] > 40) $holidayPay = 6 * $swipeSum[$i]['rate'];
  		if($swipeSum[$i]['regHours'] > 60) $holidayPay = 8 * $swipeSum[$i]['rate'];
  		
  		@$regHourTotal = $regHourTotal + round($swipeSum[$i]['regHours'],2);
        @$otHours = $otHours + round($swipeSum[$i]['ot'],2);
        @$fullHours = round($swipeSum[$i]['regHours'],2) + (round($swipeSum[$i]['ot'],2) * 1.5);
        @$tlPay = $fullHours * $swipeSum[$i]['rate'];
        @$supertlpay = $supertlpay + $tlPay;
    ?>
        <tr>
            <td><?= @$swipeSum[$i]['lastName'] ?>, <?= @$swipeSum[$i]['firstName'] ?></td>
            <td><?= @$swipeSum[$i]['empNumber'] ?></td>
            <td style="text-align: right;"><?= number_format(@$tlPay,2) ?></td>
            <td><?= number_format($swipeSum[$i]['regHours'],2) ?></td>
            <td><?= number_format(round($swipeSum[$i]['ot'],2),2) ?></td>
            <td><?= number_format(round($swipeSum[$i]['regHours'] + $swipeSum[$i]['ot'],2),2) ?></td>
            <td><?= number_format(round($holidayPay,2),2) ?></td>
        </tr>
    <?php } ?>
    	<tr class="tableheadtext"><td></td><td>Totals:</td><td><?= $regHourTotal ?></td><td><?= $otHours ?></td><td><?= $regHourTotal + $otHours ?></td>
    	<td colspan="2">$<?= number_format($supertlpay,2) ?></td></tr>
    </table>
    <br><br><a class="dashbut" href="scheduleDash.php"><span class="icontext">&#128281;&nbsp;</span>Return</a>
  </body>
</html>