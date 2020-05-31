<?php
//punchComment.php 2018/01
// Handles a timeclock punch
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');// set the default time zone

session_start(); // Resume up your PHP session!
// *** Verify Login ***
if(!isset($_SESSION['username'])){
  header('Location: index.php');
  exit;
}
//get user variables
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];
$message = $_REQUEST['message'];

$ppPrev = $_REQUEST['ppPrev'];

//Load A Single Value From A Flat File
$fp = fopen('pp.txt', "r");             //Open The File For Reading
  $pp = fgets($fp);                     //Load The Value
  $ppDays = fgets($fp);                 //Load The Value
fclose($fp);                            //Close The File
$today = date('Y-m-d H:i');

// calculate current payperiod start
while (strtotime($pp) < strtotime($today)){

    $pp = date('Y-m-d', strtotime($pp. ' + '.$ppDays.' days'));
}
$ppStart = date('Y-m-d', strtotime($pp. ' - '.$ppDays.' days'));
$ppEnd =  date('Y-m-d', strtotime($pp. ' - 1 second'));

// set up variables for previous pay period
if($ppPrev){
    $ppStart = $ppPrev;
    $ppEnd = date('Y-m-d', strtotime($ppStart. ' + '.$ppDays.' days'));
    $ppEnd =  date('Y-m-d', strtotime($ppEnd. ' - 1 second'));
}

//prepare next pay period start
$ppNext = date('Y-m-d', strtotime($ppStart. ' + '.$ppDays.' days'));
if($ppNext == $pp) unset($ppNext);

//Open The Resource Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `resource` WHERE `resource_userName` = \''.trim($username).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
$resource=mysqli_fetch_assoc($result);

// Get Swipes For Resource
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `rawPunch` WHERE `resource_ID` = \''.$resource['resource_ID'].'\' ORDER BY `punch_timeStamp`' ;
$result = mysqli_query($db, $sql); // create the query object
$swipeCount=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$swipeCount; $i++){               //Iniate The Loop
    $swipe[$i]=mysqli_fetch_assoc($result);     //Fetch & Store The Current Record
}
$ii = 0;
for($i=0; $i<$swipeCount; $i++){               //Iniate The Loop
    if(strtotime($swipe[$i]['punch_timeStamp']) > strtotime($ppStart) && strtotime($swipe[$i]['punch_timeStamp']) < strtotime($ppEnd. '+ 1 days')){
        $curSwipe[$ii] = $swipe[$i];
        $ii++;
    }
}
$curSwipeCount = count($curSwipe);

// begin swipe analysis

// look for missing swipes
$ii = 0;
for($i = 0; $i < $curSwipeCount; $i++){
    // if this is not the first punch
    if($i > 0){
        // if it's a new day
        if(date('Y-m-d', strtotime($curSwipe[$i]['punch_timeStamp'])) > date('Y-m-d', strtotime($curSwipe[$i-1]['punch_timeStamp']))){
            // if the punches are uneven
            if($ii % 2 != 0){
                $curSwipe[$i-1]['uneven'] = "Dangling Punch";
            }
            $ii = 0;
        }
    }
    $ii++;
}

// time calculations
$ppTotal = 0;
for($i = 1; $i < $curSwipeCount; $i++){
    // if this is not the first punch
    if($curSwipe[$i]['uneven'] == "Dangling Punch") $i++;
    if(date('Y-m-d', strtotime($curSwipe[$i]['punch_timeStamp'])) == date('Y-m-d', strtotime($curSwipe[$i-1]['punch_timeStamp']))){
        // Monster formula
        $curSwipe[$i]['time'] = gmdate("H:i", strtotime($curSwipe[$i]['punch_timeStamp']) - strtotime($curSwipe[$i-1]['punch_timeStamp']));
        $curSwipe[$i]['seconds'] = strtotime($curSwipe[$i]['punch_timeStamp']) - strtotime($curSwipe[$i-1]['punch_timeStamp']);
        $ppTotal = $ppTotal + $curSwipe[$i]['seconds'];
        $i++;
    }
}

$hours = floor($ppTotal / 3600);
$ppTotal = $hours + (floor(($ppTotal / 60) % 60)/60);

// reverse the order of the swipes so that most recent appears at the top
if($curSwipe) $curSwipe = array_reverse($curSwipe);

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="SHORTCUT ICON" href="images/schedule.ico">
    <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
    <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
    <title>Review Timeclock Punches: <?= $ppStart ?> - <?= $ppEnd ?> (a)</title>
</head>
  <body>
  <div id="banner">
  <a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a>
  </div>
  <br><br>

    <span class="dashtitle"><div class="hideforprint">I present to you the swippings of: </div><?= $resource['firstName'] ?> <?= $resource['lastName'] ?></span><br>
  <div class="alignright">
    <span class="dashtitlemed">Pay Period Beginning: <?= $ppStart ?><br>
    Pay Period Ending: <?= $ppEnd ?><br>
    Today: <?= $today ?></span>
  </div>
    <br><br>
    <div class="databox2">
    <?php
    if($curSwipeCount > 0){ // if there are no swipes echo: No Swipes For This Period
        $prevStamp = $curSwipe[0]['punch_timeStamp'];
    ?>
    <b><?= date('D Y-m-d', strtotime($curSwipe[0]['punch_timeStamp'])) ?></b> |
    <?php
    for($i = 0; $i < $curSwipeCount; $i++){
         if(date('Y-m-d', strtotime($curSwipe[$i]['punch_timeStamp'])) != date('Y-m-d', strtotime($prevStamp))){
         unset($punch);
         $qq = 0;

         //Gather the swipes for this one day
         for($q = 0; $q < $curSwipeCount; $q++){
            if(date('Y-m-d', strtotime($curSwipe[$q]['punch_timeStamp'])) == date('Y-m-d', strtotime($prevStamp))){
                $punch[$qq] = date('H:i', strtotime($curSwipe[$q]['punch_timeStamp']));
                $qq++;
            }
         }
         // reverse the order of the swipes
         $punch = array_reverse($punch);
         $punchCount = count($punch);
         // echo the hell out of the punches
         for($q = 0; $q < $punchCount; $q++){
    ?>
         <?= $punch[$q] ?> |
    <?php } //End the punch echoing ?>

            <!-- Html Begins Here for the end of the day -->
            | <b>Hours: <?= number_format(round($dTotal,2),2) ?></b>
            <hr/>
            <b><?= date('D Y-m-d', strtotime($curSwipe[$i]['punch_timeStamp'])) ?></b> |
            <!-- Html Ends Here -->

            <?php
            $prevStamp = $curSwipe[$i]['punch_timeStamp'];    // update previous day
            $day = 0;
        } ?>
        <?php
        $day = $day + $curSwipe[$i]['seconds'];
        $dh = floor($day / 3600);
        $dTotal = $dh + (floor(($day / 60) % 60)/60);
    } ?>
    <?php
         unset($punch);
         $qq = 0;

         //Gather the swipes for this one day
         for($q = 0; $q < $curSwipeCount; $q++){
            if(date('Y-m-d', strtotime($curSwipe[$q]['punch_timeStamp'])) == date('Y-m-d', strtotime($prevStamp))){
                $punch[$qq] = date('H:i', strtotime($curSwipe[$q]['punch_timeStamp']));
                $qq++;
            }
         }
         // reverse the order of the swipes
         $punch = array_reverse($punch);
         $punchCount = count($punch);
         // echo the hell out of the punches
         for($q = 0; $q < $punchCount; $q++){
    ?>

         <!-- Html Begins Here for the punches -->
         <?= $punch[$q] ?> |
         <!-- Html Ends Here -->

    <?php } //End the punch echoing
          //$holidayPay = 0;
          //if($ppTotal > 0) $holidayPay = 4 * $resource['hourlyRate'];
          //if($ppTotal > 40) $holidayPay = 6 * $resource['hourlyRate'];
          //if($ppTotal > 60) $holidayPay = 8 * $resource['hourlyRate'];
    ?>
            <!-- Html Begins Here for the daily total  And Period totals-->
            | <b>Hours: <?= number_format(round($dTotal,2),2) ?></b>
            <hr/>
            <b>Total Hours This PayPeriod: <?= round($ppTotal, 2) ?></b> <!--&nbsp;&nbsp;&nbsp;Potential Holiday Pay: $<?= number_format(round($holidayPay,2),2) ?>--><hr>
            <!-- Html Ends Here -->
       </div>
       <br>

    <?php  }else{ ?><span class="redtitlemed">*No Swipes For This Period*</span><br><?php } ?>

       <br><br>
    <!-- Show the links to other pay periods -->
    <a class="dashbut" href="reviewSwipes.php?ppPrev=<?= date('Y-m-d', strtotime($ppStart. ' - 14 days')) ?>"><span class="icontext">&larr;&nbsp;</span>Previous PP</a>
    <?php if($ppNext){ ?>

    <!-- Html Begins Here for the View Next if there's more-->
    &nbsp;&nbsp;&nbsp; <a class="dashbut" href="reviewSwipes.php?ppPrev=<?= $ppNext ?>">Next PP<span class="icontext">&nbsp;&rarr;</span></a>
    <!-- Html Ends Here -->

    <?php } ?>

    <br><br><a class="dashbut" href="scheduleDash.php"><span class="icontext">&#128281;&nbsp;</span>Return</a>
  </body>
</html>