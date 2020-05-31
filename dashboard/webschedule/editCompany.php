<?php
date_default_timezone_set('America/New_York');
// EditCompany.php
// Mark Bouchett
// 2015/11
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

//Load A Single Value From A Flat File
$fp = fopen('pp.txt', "r");             //Open The File For Reading
  $pp = fgets($fp);                     //Load The Value
  $ppDays = fgets($fp);                 //Load The Value
fclose($fp);                            //Close The File
$today = date('Y-m-d');
$ppFirst = $pp;

// discover the subsequent pay periods of the year
while (strtotime($pp) < strtotime($today)){

    $pp = date('Y-m-d', strtotime($pp. ' + '.$ppDays.' days'));
}

$ppStart = date('Y-m-d', strtotime($pp. ' - '.$ppDays.' days'));
$ppEnd = date('Y-m-d', strtotime($pp. ' - 1 days'));

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="SHORTCUT ICON" href="images/schedule.ico">
    <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
    <title>Company Profile (a)</title>
</head>

<body>
<br><br>
        Current Pay Period Start: <?= $ppStart ?><br/>
        Current Pay Period End: <?= $ppEnd ?><br/>
        Today: <?= $today ?> <br/><br/>
    <form name="processEditCompany" action="processEditCompany.php" method="post">
        Pay Period Start: <input name="ppStart" value="<?= $ppFirst ?>" />
        <br/>Pay Period Length In Days: <input name="ppDays" value="<?= $ppDays ?>" />
      <br>
      <br>
      <a class="dashbut" onClick="document.processEditCompany.submit()"><span class="icontext">&#128190;&nbsp;</span>Save Changes</a>
    </form>

    <a class="dashbut" href="scheduleDash.php"><span class="icontext">&#128281;&nbsp;</span>Return</a>
    <br><br>
    <?php if($message) { ?>
         <?= $message ?>
    <?php } ?>
</body>

</html>