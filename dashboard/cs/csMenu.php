<?php
//csMenu.php 2018/01
// Display the customer service menu
include "/home/homeportonline/crc/2018.php";

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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dashboard.css" type="text/css" />
	<title>Homeport Dashboard</title>

</head>

<body>
<img alt="homeport logo" src="../../images/hp_compass.png">
<br />
<span class="largetext">Customer Service Dashboard</span>
<br />
<div class="menu">
<table>
	<tr>
      <td><a class="menubtn" href="csSearch.php" ><i class="fa fa-search"></i> Search</a></td>
      <td><a class="menubtn" href="printTag.php" ><i class="fa fa-print"></i> Print Queued Tags</a></td>
    </tr>
	<tr>
      <td><a class="menubtn" href="addCustomer.php" ><i class="fa fa-user-plus"></i> Add Customer</a></td>
      <td><a class="menubtn" href="uncalled.php" ><i class="fa fa-list"></i> List Un-Called Up</a></td>
    </tr>
	<tr>
      <td><a class="menubtn" href="unpicked.php" ><i class="fa fa-list-alt"></i> List Un-Picked-Up</a></td>
      <td><a class="menubtn" href="../"><i class="fa fa-reply"></i> Exit</a></td>
    </tr>
</table>
</div>
</body>
</html>
