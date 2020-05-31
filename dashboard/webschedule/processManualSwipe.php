<?php
//processManualSwipe.php 2018/01
// Process A Manual Swipe
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

//get user variables
$card = $_POST['card'];
$hour = $_POST['hour'];
$min = $_POST['min'];
$ap = $_POST['ap'];
$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
if($ap == "pm") $hour = $hour + 12;

$timeStamp = $year."-".$month."-".$day." ".$hour.":".$min;                                                                    //Close The Connection

// Save New Data to an SQL database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string

$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`, `punch_comment`)
        VALUES ('$card', '$timeStamp', 'Manual Swipe')";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Manual Punch Save Failed<br>";
	echo mysqli_error($db);
	die;
}
$punch_ID = mysqli_insert_id($db);
mysqli_close($db);

//send the punch for comment 
header('location: punchComment.php?punch_ID='.$punch_ID);
die;
?>