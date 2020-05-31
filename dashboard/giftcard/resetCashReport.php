<?php
//resetCashReport.php 2018/01
// reset the cash report date
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
?>
<!DOCTYPE>
<html>
<head>
  <link rel="stylesheet" href="css/gcDash.css" type="text/css" />
  <title>Reset Cash Report Date & Time</title>
</head>
<body>
<div id="banner">
  <img alt="Homeport Logo" src="images/hplogosm.png" />
</div>
<br />
<div class="title">Reset Cash Report Date & Time</div>
<br />
<form action="processResetCashReport.php" method="post">
<table>
	<tr>
		<td ><input class="time" name="mm"/></td>
		<td ><input class="time" name="dd" /></td>
		<td ><input class="time" name="yyyy"/></td>
		<td><input class="time" name="th"/>:<input class="time" name="tm"/></td>
	</tr>
   <tr>
		<td align="center" >mm</td>
		<td align="center" >dd</td>
		<td align="center" >yyyy</td>
		<td align="center" >@ hh:mm</td>
	</tr>
	<tr><td colspan="4" ><input type="submit" name="" value="Reset Timestamp" /></td></tr>
</table>
</form>
<br />
<table align="center">
	<tr><td><input value="Exit" onclick="history.go(-1)" type="button"></td></tr>
</table>
</body>

</html>