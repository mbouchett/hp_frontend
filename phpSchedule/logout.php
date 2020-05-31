<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="SHORTCUT ICON" href="524.ico">
  <title>Logged Out!</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
<br />
<div style="text-align: center; font-family: Arial Black; font-size: 18px; color: #999933">Logged out</div>
<br /><br />
<div style="text-align: center">
<input value="Log Back In" onclick="parent.location='<?=$rootLoc?>'" type="button">
<input value="Return To The Homepage" onclick="parent.location='http://www.homeportonline.com'" type="button">
</div>

</body>

</html>
