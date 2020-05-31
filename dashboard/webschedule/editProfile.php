<?php
//processPunchComment.php 2018/01
// Handles a timeclock punch comment
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

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `resource` WHERE `resource_userName` = \''.trim($username).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
$resource=mysqli_fetch_assoc($result);

?>
<!DOCTYPE HTML>
<html>
  <head>
    <link rel="SHORTCUT ICON" href="images/schedule.ico">
    <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
    <title>Edit Profile</title>
  </head>
  <body>
    <div id="banner">
        <a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a>
    </div>
    <br><br>
    <div id="title"><span class="dashtitle">Edit User Info</span></div>
    <br><br>
    <div class="loginbox">
    <form action="processEditProfile.php" name="processEditProfile" method="post">
    <table style="border-collapse: collapse">
      <tr>
        <td><h3>First Name&nbsp;</h3></td>
        <td><input name="fName" value="<?= $resource['resource_firstName'] ?>"></td>
      </tr>
      <tr>
        <td><h3>Last Name&nbsp;</h3></td>
        <td><input name="lName" value="<?= $resource['resource_lastName'] ?>"></td>
      </tr>
      <tr>
        <td><h3>Phone</h3></td>
        <td><input name="phone" value="<?= $resource['resource_phone'] ?>"></td>
      </tr>
      <tr>
        <td><h3>Email</h3></td>
        <td><input name="email" value="<?= $resource['resource_email'] ?>"></td>
      </tr>
    </table>
      <input type="hidden" name="resource_ID" value="<?= $resource['resource_ID'] ?>">
      <br>
      <br>
      <a class="dashbut" onClick="document.processEditProfile.submit()"><span class="icontext">&#128190;&nbsp;</span>Save Changes</a>
    </form>
    </div>
    <br>
    <a class="dashbut" href="changePassword.php?resource_ID=<?= $resource['resource_ID'] ?>"><span class="icontext">&#128274;&nbsp;</span>Change Password</a>
    <a class="dashbut" href="scheduleDash.php"><span class="icontext">&#128281;&nbsp;</span>Return</a>
    <br><br>
    <?php if($message) { ?>
         <?= $message ?>
    <?php } ?>
  </body>

</html>