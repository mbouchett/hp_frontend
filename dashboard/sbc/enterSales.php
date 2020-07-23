<?php
//enterSales.php 2020/07
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$today = ($_REQUEST['today']) ? $_REQUEST['today'] : date('Y-m-d');


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Enter Sales By Category</title>
</head>
<body>
	<form method="post" action="processEnterSales.php">
	<label for="date">Date:</label>
	<input type="date" id="date" name="date" value="<?= $today ?>"> 
	<label for="amt">Amt:</label>
	<input type="text" id="amt" name="amt">
	<label for="cat">Cat:</label>
	<input type="text" id="cat" name="cat">
	<input type="submit" value="Save" />
	</form>
</body>
</html>