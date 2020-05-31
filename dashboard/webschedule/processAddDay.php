<?php
//processAddDay.php 2018/01

include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

date_default_timezone_set('America/New_York');// set the default time zone

//get user variables
$card = $_REQUEST['card'];
$ppPrev = $_REQUEST['ppPrev'];
$theDay = $_REQUEST['theDay'];

$timeStamp1 = $theDay." 10:00:00";
$timeStamp2 = $theDay." 13:00:00";
$timeStamp3 = $theDay." 13:35:00";
$timeStamp4 = $theDay." 18:00:00";

// Save New Data to an SQL database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//create insert string Punch In
$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`, `punch_comment`)
        VALUES ('$card', '$timeStamp1', '~Manual Swipe')";
$result = mysqli_query($db, $sql);                      // create the query object

//create insert string Punch Out
$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`, `punch_comment`)
        VALUES ('$card', '$timeStamp2', '~Manual Swipe')";
$result = mysqli_query($db, $sql);                      // create the query object

//create insert string Punch In
$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`, `punch_comment`)
        VALUES ('$card', '$timeStamp3', '~Manual Swipe')";
$result = mysqli_query($db, $sql);                      // create the query object

//create insert string  Punch Out
$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`, `punch_comment`)
        VALUES ('$card', '$timeStamp4', '~Manual Swipe')";
$result = mysqli_query($db, $sql);                      // create the query object

mysqli_close($db);                                      //close the connection

//send the punch for comment 
header('location: reviewAllSwipes.php?ppPrev='.$ppPrev.'&recno='.$card);
die;
?>