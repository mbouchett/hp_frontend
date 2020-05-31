<?php
//processAddLayItem.php 2018/01
// Adds an item to a lay away
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$layaway_ID = $_POST['layaway_ID'];
$date = date('Y/m/d');
$dept_ID = $_POST['dept_ID'];
$li_desc = $_POST['li_desc'];
$li_qty = $_POST['li_qty'];
$li_price = $_POST['li_price'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`layItems` 
		  (`layaway_ID`, `dept_ID`, `li_desc`, `li_qty`, `li_price`) 
		  VALUES ('$layaway_ID', '$dept_ID', '$li_desc', '$li_qty', '$li_price')";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Add Item Layaway Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('location: layaway.php?layaway_ID='.$layaway_ID);
die;
?>