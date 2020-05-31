<?php   //reviewSwipes.php
        //2015-11
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
$ppPrev = $_POST['ppPrev'];
if(!$ppPrev) $ppPrev = $_REQUEST['ppPrev'];

$currentRecno = $_REQUEST['recno'];
if(!$currentRecno) $currentRecno = $_POST['recno'];

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

//Open The Database and get the user info
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `recno`, `firstName`, `lastName` FROM `resource` WHERE `lastDay` IS NULL AND `hourlyRate` > 0 ORDER BY `lastName`";
$result = mysqli_query($db, $sql); // create the query object
$resourceCount=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$resourceCount; $i++){               //Iniate The Loop
    $resources[$i]=mysqli_fetch_assoc($result);     //Fetch & Store The Current Record
}
if(!$currentRecno) $currentRecno = $resources[0]['recno'];

//Open The Resource Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `resource` WHERE `recno` = \''.$currentRecno.'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
$resource=mysqli_fetch_assoc($result);

// Get Swipes For Resource
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `rawPunch` WHERE `cardNumber` = \''.$currentRecno.'\' ORDER BY `timeStamp`' ;
$result = mysqli_query($db, $sql); // create the query object
$swipeCount=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$swipeCount; $i++){               //Iniate The Loop
    $swipe[$i]=mysqli_fetch_assoc($result);     //Fetch & Store The Current Record
}
$ii = 0;
for($i=0; $i<$swipeCount; $i++){               //Iniate The Loop
    if(strtotime($swipe[$i]['timeStamp']) > strtotime($ppStart) && strtotime($swipe[$i]['timeStamp']) < strtotime($ppEnd. '+ 1 days')){
        $curSwipe[$ii] = $swipe[$i];
        $ii++;
    }
}
$curSwipeCount = count($curSwipe);

$halfway =  strtotime($ppStart. ' + 7 days');

//create days in the pay period
for($i=0; $i < 14; $i++){
    $ppDayList[$i] = date('Y-m-d', strtotime($ppStart. ' + '.$i.' days'));
}

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
$weekTotal[0] = 0;
$weekTotal[1] = 0;
for($i = 1; $i < $curSwipeCount; $i++){
    // if this is not the first punch
    if($curSwipe[$i]['uneven'] == "Dangling Punch") $i++;
    if(date('Y-m-d', strtotime($curSwipe[$i]['timeStamp'])) == date('Y-m-d', strtotime($curSwipe[$i-1]['timeStamp']))){
        // Monster formula
        $curSwipe[$i]['time'] = gmdate("H:i", strtotime($curSwipe[$i]['timeStamp']) - strtotime($curSwipe[$i-1]['timeStamp']));
        $curSwipe[$i]['seconds'] = strtotime($curSwipe[$i]['timeStamp']) - strtotime($curSwipe[$i-1]['timeStamp']);
        $ppTotal = $ppTotal + $curSwipe[$i]['seconds'];

        if(strtotime($curSwipe[$i]['timeStamp']) > $halfway){
            $weekTotal[1] =  $weekTotal[1] + $curSwipe[$i]['seconds'];
        }else {
            $weekTotal[0] =  $weekTotal[0] + $curSwipe[$i]['seconds'];
        }
        $i++;
    }
}
$hours = floor($ppTotal / 3600);
$wHours[1] = floor($weekTotal[1] / 3600);
$wHours[0] = floor($weekTotal[0] / 3600);

$weekTotal[1] =  $wHours[1] + (floor(($weekTotal[1] / 60) % 60)/60);
$weekTotal[0] =  $wHours[0] + (floor(($weekTotal[0] / 60) % 60)/60);
$ppTotal = $hours + (floor(($ppTotal / 60) % 60)/60);

// reverse the order of the swipes so that most recent appears at the top
$curSwipe = array_reverse($curSwipe);
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="SHORTCUT ICON" href="images/schedule.ico">
    <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
    <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
    <title>Review Timeclock Punches: <?= $ppStart ?> - <?= $ppEnd ?> (a)</title>
    <script type="text/javascript" src="js/reviewAllSwipes.js"></script>
</head>
  <body>
  <div id="banner">
  <a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a>
</div>
   <br><br />
    <div class="hideforprint"><span class="dashtitle">I present to you the swipings of:</span></div>
    <br />
    <div class="loginbox">
    <form name="selectUser" action="reviewAllSwipes.php" method="post">
    <select name="recno" size="1">
        <?php for($i=0; $i<$resourceCount; $i++){ ?>
        <option onclick="this.form.submit()" value="<?= $resources[$i]['recno'] ?>"
        <?php if($resources[$i]['recno'] == $currentRecno) echo " selected=\"selected\" "?>
        ><?= $resources[$i]['lastName'] ?>, <?= $resources[$i]['firstName'] ?></option>
        <?php } ?>
    </select>
    <input type="submit" name="" value="Go" />
    <input type="hidden" name="ppPrev" value="<?= $ppPrev ?>">
    </form>
    </div>
    <br>
    <div class="alignright">
    <span class="dashtitlemed">
    Pay Period Beginning: <?= $ppStart ?><br />
    Pay Period Ending: <?= $ppEnd ?><br />
    Today: <?= $today ?></span>
    </div>
    <br><br>
    <table class="databox">
    <?php
    if($curSwipeCount > 0){ // if there are no swipes echo: No Swipes For This Period
        $prevStamp = $curSwipe[0]['timeStamp'];
    ?>
    <tr>
        <td><?= date('D', strtotime($curSwipe[0]['timeStamp'])) ?></td>
        <td onclick="addPunch('<?= date('Y-m-d', strtotime($curSwipe[0]['timeStamp'])) ?>');">
            <?= date('Y-m-d', strtotime($curSwipe[0]['timeStamp'])) ?>
        </td>
    <?php
    for($i = 0; $i < $curSwipeCount; $i++){
         if(date('Y-m-d', strtotime($curSwipe[$i]['timeStamp'])) != date('Y-m-d', strtotime($prevStamp))){
         unset($punch);
         $qq = 0;
         //Gather the swipes for this one day
         for($q = 0; $q < $curSwipeCount; $q++){
            if(date('Y-m-d', strtotime($curSwipe[$q]['timeStamp'])) == date('Y-m-d', strtotime($prevStamp))){
                $punch[$qq]['stamp'] = date('H:i', strtotime($curSwipe[$q]['timeStamp']));
                $punch[$qq]['recno'] =$curSwipe[$q]['recno'];
                $punch[$qq]['comment'] =$curSwipe[$q]['comment'];
                $qq++;
            }
         }
         // reverse the order of the swipes
         $punch = array_reverse($punch);
         $punchCount = count($punch);
         // echo the hell out of the punches
         for($q = 0; $q < $punchCount; $q++){
    ?>
         <!-- Here is the Time Stamp -->
         <td>
            <input
              <?php
                if($punch[$q]['comment']){
                    $color ="#FF99FF";
                    if(substr($punch[$q]['comment'],0,1) == "~") $color ="#FFFFCC";
                    echo "style=\"background-color: ".$color.";\"";
                }
              ?>
                onkeyup="fixTime(this,event,'<?= $currentRecno ?>', '<?= $ppPrev ?>', '<?= $punch[$q]['recno'] ?>')"
                type="text" value="<?= $punch[$q]['stamp'] ?>" size="3" title="<?= $punch[$q]['comment'] ?>"
            />
            <div class="hideforprint"><input onclick="parent.location='processKillPunch.php?punch=<?= $punch[$q]['recno'] ?>&recno=<?= $currentRecno ?>&ppPrev=<?= $ppPrev ?>'" type="button" value="x" /></div>
         </td>
    <?php } //End the punch echoing ?>

            <!-- Html Begins Here for the end of the day -->
            <?php for($z=(4-$qq); $z > 0; $z--) echo "<td></td>"; ?>
            <td title="<?= $qq ?>">Hours: <?= number_format(round($dTotal,2),2) ?></td>
            </tr>
            <?php
            if(strtotime($curSwipe[$i]['timeStamp']) < $halfway && !$split){
                echo '<tr class="split" style="background-color: rgba(163, 0, 3, .8);"><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                $split = "done";
            }
            ?>
            <tr>
                <td><?= date('D', strtotime($curSwipe[$i]['timeStamp'])) ?></td>
                <td onclick="addPunch('<?= date('Y-m-d', strtotime($curSwipe[$i]['timeStamp'])) ?>');">
                    <?= date('Y-m-d', strtotime($curSwipe[$i]['timeStamp'])) ?>
                </td>
            <!-- Html Ends Here -->
            <?php
            $prevStamp = $curSwipe[$i]['timeStamp'];    // update previous day
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
            if(date('Y-m-d', strtotime($curSwipe[$q]['timeStamp'])) == date('Y-m-d', strtotime($prevStamp))){
                $punch[$qq]['stamp'] = date('H:i', strtotime($curSwipe[$q]['timeStamp']));
                $punch[$qq]['recno'] =$curSwipe[$q]['recno'];
                $punch[$qq]['comment'] =$curSwipe[$q]['comment'];
                $qq++;
            }
         }
         // reverse the order of the swipes
         $punch = array_reverse($punch);
         $punchCount = count($punch);
         // echo the hell out of the punches
         for($q = 0; $q < $punchCount; $q++){
    ?>
         <!-- Html Begins Here for the last row of punches -->
         <!-- Here is the Time Stamp -->
         <td>
            <input
              <?php
                if($punch[$q]['comment']){
                    $color ="#FF99FF";
                    if(substr($punch[$q]['comment'],0,1) == "~") $color ="#FFFFCC";
                    echo "style=\"background-color: ".$color.";\"";
                }
              ?>
              onkeyup="fixTime(this,event,'<?= $currentRecno ?>', '<?= $ppPrev ?>', '<?= $punch[$q]['recno'] ?>')"
              type="text" value="<?= $punch[$q]['stamp'] ?>" size="3" title="<?= $punch[$q]['comment'] ?>"
            />
            <div class="hideforprint"><input onclick="parent.location='processKillPunch.php?punch=<?= $punch[$q]['recno'] ?>&recno=<?= $currentRecno ?>&ppPrev=<?= $ppPrev ?>'" type="button" value="x" /></div>
         </td>
         <!-- Html Ends Here -->
    <?php } //End the punch echoing
          $holidayPay = 0;
          if($ppTotal > 0) $holidayPay = 4 * $resource['hourlyRate'];
          if($ppTotal > 40) $holidayPay = 6 * $resource['hourlyRate'];
          if($ppTotal > 60) $holidayPay = 8 * $resource['hourlyRate'];
    ?>
            <!-- Html Begins Here for the daily total  And Period totals-->
            <?php for($z=(4-$qq); $z > 0; $z--) echo "<td></td>"; ?>
            <td title="<?= $qq ?>">Hours: <?= number_format(round($dTotal,2),2) ?></td>
            </tr>
            </table>
            <br />
            <div class="hourbox">
            <hr>
            <div class="hideforprint">
            Add A Day&rarr;
            <select name="recno" size="1">
                <?php for($i=0; $i<14; $i++){ ?>
                <option onclick="addDay('<?= $ppDayList[$i] ?>', '<?= $currentRecno ?>', '<?= $ppPrev ?>')" value="<?= $ppDayList[$i] ?>">
                    <?= $ppDayList[$i] ?>
                </option>
                <?php } ?>
            </select>
            &nbsp;&nbsp;&nbsp;
            </div><span
            <?php if($weekTotal[0] > 40) echo 'style="color: #FF0000; font-weight: bold;"'; ?>
             >Week 1: <b><?= round($weekTotal[0], 2) ?></b></span>
            &nbsp;&nbsp;&nbsp;<span
            <?php if($weekTotal[1] > 40) echo 'style="color: #FF0000; font-weight: bold;"'; ?>
            >Week 2: <b><?= round($weekTotal[1], 2) ?></b></span>
            &nbsp;&nbsp;&nbsp;Total Hours This PayPeriod: <b><?= round($ppTotal, 2) ?></b>
            &nbsp;&nbsp;&nbsp;Potential Holiday Pay: <b>$<?= number_format(round($holidayPay,2),2) ?></b>
            <hr>
            </div>
            <br />


    <!-- Hidden Div to add a punch -->
    <div id='addP'>
        <div id="dateTitle"></div>
          <form name="punch" action="processAddPunch.php" method="post">
          <div class="loginbox">
             <table>
                  <tr><td>Hour:Min</td></tr>
                  <tr>
                      <td><input id="addTime" name="time" size="8"  maxlength="5"/></td>
                  </tr>
              </table>
              <input type="hidden" name="card" value="<?= $currentRecno ?>">
              <input type="hidden" name="ppPrev" value="<?= $ppPrev ?>">
              <input id="hideDate" type="hidden" name="date" value="">
          <br />

          </div>
          <br />
          <a class="dashbut" onClick="document.punch.submit()"><span class="icontext">&#10003;&nbsp;</span>Punch the Clock</a>
          <br><a class="dashbut" onClick="addLunch('<?= $currentRecno ?>', '<?= $ppPrev ?>');"><span class="icontext">&#10003;&nbsp;</span>Add Lunch</a>
          </form>
        <a onclick="closeAddP();">Close Window</a>
    </div>

            <!-- Html Ends Here -->

    <?php  }else{ ?>
    <br />
    <div class="hourbox">
    <hr>
    *No Swipes For This Period &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="hideforprint">
    Add A Day&rarr;
    <select name="recno" size="1">
        <?php for($i=0; $i<14; $i++){ ?>
        <option onclick="addDay('<?= $ppDayList[$i] ?>', '<?= $currentRecno ?>', '<?= $ppPrev ?>')" value="<?= $ppDayList[$i] ?>">
            <?= $ppDayList[$i] ?>
        </option>
        <?php } ?>
    </select>
    </div>
    <hr>
    </div>
    <br />

    <?php } ?>

    <!-- Show the links to other pay periods -->
    <a class="dashbut" href="reviewAllSwipes.php?ppPrev=<?= date('Y-m-d', strtotime($ppStart. ' - 14 days')) ?>&recno=<?= $currentRecno ?>"><span class="icontext">&larr;&nbsp;</span>Previous PP</a>
    <?php if($ppNext){ ?>

    <!-- Html Begins Here for the View Next if there's more-->
    &nbsp;&nbsp;<a class="dashbut" href="reviewAllSwipes.php?ppPrev=<?= $ppNext ?>&recno=<?= $currentRecno ?>">Next PP<span class="icontext">&nbsp;&rarr;</span></a>
    <!-- Html Ends Here -->

    <?php } ?>

    <br><br><a class="dashbut" href="scheduleDash.php"><span class="icontext">&#128281;&nbsp;</span>Return</a>
  </body>
</html>