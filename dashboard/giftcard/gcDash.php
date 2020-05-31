<?php
//gcDash.php 2018/01
// Gift Card Dashboard

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/gcDash.css" type="text/css" />
  <link rel="SHORTCUT ICON" href="../dash.ico">
  <title>Gift Card Dashboard</title>
</head>

<body>
<div id="banner"><a href="../index.php"><img alt="Homeport Logo" src="images/hplogosm.png" /></a></div>
<br />
<div class="title">Gift Card Dashboard</div>
<br />
<table>
	<tr>
		<td><input value="Card Balances" onclick="parent.location='cardBalances.php'" type="button"></td>
      <td><input value="Cash Report" onclick="parent.location='cashReport.php'" type="button"  ></td>
      <td><input value="Transaction Log" onclick="parent.location='gclog.php'" type="button"></td>
	</tr>
	<tr>
      <td colspan="3"><input value="Exit" onclick="parent.location='../dashboard.php'" type="button"></td>
	</tr>
</table>
</body>
</html>
