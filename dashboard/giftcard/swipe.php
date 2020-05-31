<?php
//swipe.php 2018/01
// Main Gift Card Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

//Establish Variables
$date = date('F jS Y');
$username=$_SESSION['username'];
$message=$_REQUEST['message'];

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Gift Card Swipe</title>
	<link rel="stylesheet" href="css/swipe.css" type="text/css" />
	<script type="text/javascript" src="js/swipe.js"></script>
</head>

<body onload="setFocus()">
<div id="banner">
  <img alt="Homeport Logo" src="images/hplogosm.png" />
</div>
<br />
<div style=" text-align:center; font-size:24px; font-weight:bold">Homeport Gift Card</div>
<br /><br />
<form action="viewSwipe.php" method="post">
<table align="center" class="dashtable" border="1" >
    <tr>
        <td class="dashcell" ><input id="swipe" name="swipe" type="password" onfocus="doClear(this)"  /></td>
    </tr>
    <tr>
        <td><h3>Swipe Card</h3></td>
    </tr>
    <tr>
        <td class="dashcell" ><input value="Return To Dashboard" onclick="parent.location='../'" type="button"></td>
    </tr>    
</table>
<input name="username" type="hidden" value="<?=$username?>" />
</form> 
<br />
<?php if($message){?>
<br />
<table align="center" class="dashtable" >
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>
 
</body>
</html>
