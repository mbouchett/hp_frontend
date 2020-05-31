<?php
//processPunch.php 2018/01
// Handles a timeclock punch
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');// set the default time zone

//get user variables
$cardNumber = $_POST['cardNumber'];
$timeStamp = $_POST['timeStamp'];

$cardNumber = substr($cardNumber,1,strlen($cardNumber)-2); // Trim the card Number

// check for non numeric
if(!is_numeric($cardNumber)){
 header("Location: timeClock.php");
 die;
 }

// check for empty
if($cardNumber == 0){
 header("Location: timeClock.php");
 die;
 }

// Check to see if card exists
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `resource_firstName`,`resource_lastName` FROM `resource` WHERE `resource_ID` = '.$cardNumber ;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Card Check Failed<br>";
	echo mysqli_error($db);
	die;
}
$num_results=mysqli_num_rows($result);
mysqli_close($db);
//Store the Result To $punch
if($num_results < 1){
 header("Location: timeClock.php");
 die;
 }

// Save New Data to an SQL database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`)
        VALUES ('$cardNumber', '$timeStamp')";

$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Punch Process Failed<br>";
	echo mysqli_error($db);
	die;
}
$punch_ID = mysqli_insert_id($db);
mysqli_close($db);                                      //close the connection

//send the punch for comment 
header('location: punchComment.php?punch_ID='.$punch_ID);
die;
?>