<?php
//whPickup.php 2018/01
// initiates a pickup request
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$pu_ID = $_REQUEST['pu_ID'];
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `".$db_db."`.`pickups` WHERE `pu_ID` = '".$pu_ID."';";
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Database Error!<br>";
	echo $sql." - ".$i."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('Location: whPickup.php');
die;
?>