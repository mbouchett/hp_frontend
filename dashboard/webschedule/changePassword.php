<?php
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
// *** Verify Login ***
if(!isset($_SESSION['username'])){
  header('Location: index.php');
  exit;
}

$resource_ID = $_REQUEST['resource_ID'];
$message = $_REQUEST['message'];

?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Change Password</title>
  <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />

</head>

<body>
<div id="banner">
  <a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a>
</div>
<br><br>
<div class="loginbox">
    <form action="processChangePassword.php" name="processChangePassword" method="post">
    <table>
      <tr>
        <td>Old Password</td>
        <td><input name="oldPassword" type="password"></td>
      </tr>
      <tr>
        <td>New Password</td>
        <td><input name="newPassword" type="password"></td>
      </tr>
      <tr>
        <td>Confirm Password</td>
        <td><input name="confirmPassword" type="password"></td>
      </tr>

    </table>

    <br>
    <a class="dashbut" onClick="document.processChangePassword.submit()"><span class="icontext">&#128190;&nbsp;</span>Save New Password</a>
    <input type="hidden" name="resource_ID" value="<?= $resource_ID ?>">
    </form>

</div>
    <br>
    <a class="dashbut" href="editProfile.php"><span class="icontext">&#128281;&nbsp;</span>Forget It</a>
    <br><br>
    <?php if($message) { ?>
         <?= $message ?>
    <?php } ?>
</body>

</html>