<?php
//scheduleDash.php 2018/01
// Schedule dashboard

//get user variables
date_default_timezone_set('America/New_York');
$username=$_SESSION['resource_username'];
$userlevel=$_SESSION['resourcelevel'];

date_default_timezone_set('America/New_York');
$timeStamp = date("Y-m-d H:i:s");

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="SHORTCUT ICON" href="images/schedule.ico">
  <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
  <meta http-equiv="refresh" content="30">
  <title>Time Clock</title>
</head>

<body onload="focus()" onclick="parent.location='timeClock.php'">
   <div class="clockcontainer">
      <span class="dashtitle2">Time Clock</span><span class="dashtitle"><br>Swipe to Clock In/Out</span><br /><br />
   </div>
   <br />
   <div class="clock">
      <span class="digitalvoid">&middot;&nbsp;</span><span class="digitaltext"><?= date("g:i a") ?></span><span class="digitalvoid">&nbsp;&middot;</span>
   </div>
   <br />
   <h3> <?= date("l - F j, Y") ?></h3>
    <form method="post" action="processPunch.php">
        <input class="offpage" autocomplete="off" id="swipe" name="cardNumber" type="text"  />
        <input type="hidden" name="timeStamp" value="<?= $timeStamp ?>" />
    </form>
    <script defer="defer" type="text/javascript" src="js/timeClock.js"></script>
</body>
</html>