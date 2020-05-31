<?php
        //reviewSwipes.php
        //2015-15
        //Mark Bouchett
//includes loads from the rootr so: ../../ ../
include "../../wsdb.php";

date_default_timezone_set('America/New_York');

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
$fp = fopen('pp.txt', "r");  //Open The File For Reading
  $pp = fgets($fp);                    //Load The Value
fclose($fp);                            //Close The File
$today = date('Y-m-d');

// calculate current payperiod start
while (strtotime($pp) < strtotime($today)){

    $pp = date('Y-m-d', strtotime($pp. ' + 14 days'));
}
$ppStart = date('Y-m-d', strtotime($pp. ' - 14 days'));
$ppEnd =  date('Y-m-d', strtotime($pp. ' - 1 second'));

// set up variables for previous pay period
if($ppPrev){
    $ppStart = $ppPrev;
    $ppEnd = date('Y-m-d', strtotime($ppStart. ' + 14 days'));
    $ppEnd =  date('Y-m-d', strtotime($ppEnd. ' - 1 second'));
}

//prepare next pay period start
$ppNext = date('Y-m-d', strtotime($ppStart. ' + 14 days'));
if($ppNext == $pp) unset($ppNext);

//Open The Resource Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `recno`, `firstName`, `lastName` FROM `resource` WHERE `userName` = \''.trim($username).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
$resource=mysqli_fetch_assoc($result);

// Get Swipes For Resource
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `rawPunch` WHERE `cardNumber` = \''.$resource['recno'].'\' ORDER BY `timeStamp`' ;
$result = mysqli_query($db, $sql); // create the query object
$swipeCount=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$swipeCount; $i++){               //Iniate The Loop
    $swipe[$i]=mysqli_fetch_assoc($result);     //Fetch & Store The Current Record
}
$ii = 0;
for($i=0; $i<$swipeCount; $i++){               //Iniate The Loop
    if(strtotime($swipe[$i]['timeStamp']) > strtotime($ppStart) && strtotime($swipe[$i]['timeStamp']) < strtotime($ppEnd)){
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
        if(date('Y-m-d', strtotime($curSwipe[$i]['timeStamp'])) > date('Y-m-d', strtotime($curSwipe[$i-1]['timeStamp']))){
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
    if(date('Y-m-d', strtotime($curSwipe[$i]['timeStamp'])) == date('Y-m-d', strtotime($curSwipe[$i-1]['timeStamp']))){
        // Monster formula
        $curSwipe[$i]['time'] = gmdate("H:i", strtotime($curSwipe[$i]['timeStamp']) - strtotime($curSwipe[$i-1]['timeStamp']));
        $curSwipe[$i]['seconds'] = strtotime($curSwipe[$i]['timeStamp']) - strtotime($curSwipe[$i-1]['timeStamp']);
        $ppTotal = $ppTotal + $curSwipe[$i]['seconds'];
        $i++;
    }
}

$hours = floor($ppTotal / 3600);
$ppTotal = $hours + (floor(($ppTotal / 60) % 60)/60);

// reverse the order of the swipes so that most recent appears at the top
$curSwipe = array_reverse($curSwipe);
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Review Timeclock Punches: <?= $ppStart ?> - <?= $ppEnd ?> (a)</title>
</head>
  <body>
    I present to you the swippings of: <?= $resource['firstName'] ?> <?= $resource['lastName'] ?><br>
    Pay Period Beginning: <?= $ppStart ?> And Ending: <?= $ppEnd ?> - Today: <?= $today ?>
    <br><br>
    <?php if($curSwipeCount > 0){ ?>
    <table>
        <tr><td>Time Stamp</td><td>Comment</td><td>Hrs Worked</td><td>Alerts</td></tr>
        <?php   $day = 0;
                for($i = 0; $i < $curSwipeCount; $i++){
                if($prevStamp && $prevStamp > date('Y-m-d', strtotime($curSwipe[$i]['timeStamp']))) { ?>
        <tr><td></td><td></td><td ><?= round($dTotal,2) ?></td></tr>
        <tr><td colspan="2"><hr></td></tr>
        <?php   $day = 0; } ?>
        <tr>
            <td><?= $curSwipe[$i]['timeStamp'] ?></td>
            <td><?= $curSwipe[$i]['comment'] ?></td>
            <td><?= $curSwipe[$i]['time'] ?></td>
            <td><?= $curSwipe[$i]['uneven'] ?></td>
        </tr>
        <?php $prevStamp = date('Y-m-d', strtotime($curSwipe[$i]['timeStamp']));
              $day = $day + $curSwipe[$i]['seconds'];
              $dh = floor($day / 3600);
              $dTotal = $dh + (floor(($day / 60) % 60)/60);
        } ?>
        <tr><td></td><td></td><td><?= round($dTotal,2) ?></td></tr>
    </table>
    <hr>Total Hours This PayPeriod: <?= round($ppTotal, 2) ?><hr>
    <?php  }else{ ?>
    No Swipes For This Period<br>
    <?php } ?>
    <a href="reviewSwipes.php?ppPrev=<?= date('Y-m-d', strtotime($ppStart. ' - 14 days')) ?>">View Previous Pay Period</a>
    <?php if($ppNext){ ?> < - > <a href="reviewSwipes.php?ppPrev=<?= $ppNext ?>">View Next Pay Period</a> <?php } ?>

    <br><br><a href="scheduleDash.php">Return</a>
  </body>
</html>