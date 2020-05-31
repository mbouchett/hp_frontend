<?php
//scheduleDash.php 2018/01
// Schedule dashboard
date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: index.php');
	die;
}
//get user variables

$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];
$resource_ID = $_REQUEST['resource_ID'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
  <link rel="SHORTCUT ICON" href="images/schedule.ico">
  <title>Web Schedule Main Menu</title>
</head>
  <body>
<div id="banner">
  <a href="../../index.php"><img alt="Homeport Logo" src="../../images/compass_white.png" /></a>
</div>
   <br><br>
  <span class="dashtitle">Web Schedule Main Menu: <?= $username ?></span>
    <br />
    <div class="dashbutcont">
            <br />
            <a class="biggreenbutton" href="timeClock.php"><span class="icontext3">&#128340;&nbsp;</span>Clock In</a>
            <br />
            <br />
            <a class="dashbut"><span class="icontext">&#59140;&nbsp;</span>Send A Note</a>

            <a class="dashbut" href="../../phpSchedule/viewSchedule.php"><span class="icontext">&#59146;&nbsp;</span>View Schedule</a>
            <br />
            <a class="dashbut" href="reviewSwipes.php"><span class="icontext">&#59249;&nbsp;</span>Review Swipes</a>
            <a class="dashbut" href="editProfile.php"><span class="icontext">&#9998;&nbsp;</span>Edit Profile</a>
            <br /><br />
            <a class="dashbut" href="phoneList.php"><span class="icontext">&#59158;&nbsp;</span>Print Phone List</a><br /><br />

            <a class="dashbut" href="../"><span class="icontext">&#59201;&nbsp;</span>Dashboard</a>
            <a class="dashbut" href="processLogout.php"><span class="icontext">&#59201;&nbsp;</span>Log Out</a>

    <?php if($userlevel >= 3){ ?>
    <!-- Stick your mid level options here -->
    		<hr width="50%">
           <br /><a class="dashbut" href="enterCommissions.php"><span class="icontext">&#128196;&nbsp;</span>Enter Commissions</a>
    <?php } ?>

    <?php if($userlevel >= 5){ ?>
    <br /><br />
    <span class="dashtitle">Admin Things</span>
    <br /><br />
            <a class="dashbut"><span class="icontext">&#128197;&nbsp;</span>Create a Schedule</a>
            <a class="dashbut" href="addResource.php"><span class="icontext">&#59136;&nbsp;</span>Add Employee</a><br />
            <a class="dashbut" href="periodSummary.php"><span class="icontext">&#9776;&nbsp;</span>PP Summary</a>
            <a class="dashbut" href="manualSwipe.php"><span class="icontext">&#128179;&nbsp;</span>Manual Swipe</a><br />
            <a class="dashbut" href="editResource.php"><span class="icontext">&#9998;&nbsp;</span>Edit Employees</a>
            <a class="dashbut" href="editCompany.php"><span class="icontext">&#9881;&nbsp;</span>Edit PP Range</a><br />
            <a class="dashbut" href="reviewAllSwipes.php"><span class="icontext">&#128196;&nbsp;</span>Review Swipes</a>
    <?php } ?>
    </div>
<?php if($resource_ID) { ?>
    User added card# <?= $resource_ID ?>
<?php } ?>
  </body>
</html>
