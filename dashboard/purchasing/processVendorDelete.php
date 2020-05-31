<?php
//processVendorDelete.php 2018/01
// Vendor Catalog Edit Workspace
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
  	
$vendor_ID = $_REQUEST['vendor_ID'];

// delete vendor
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `".$db_db."`.`vendors` WHERE `vendor_ID` = '".$vendor_ID."';";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

// return to the dashboard
header('location: index.php');
?>