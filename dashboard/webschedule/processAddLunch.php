<?php
//processAddLunch.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$card = $_REQUEST['card'];
$date = $_REQUEST['date'];
$ppPrev = $_REQUEST['ppPrev'];

$timeStamp1 = $date." 13:00";
$timeStamp2 = $date." 13:35";

// Save New Data to an SQL database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string

$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`, `punch_comment`)
        VALUES ('$card', '$timeStamp1', '~Lunch Punch')";
$result = mysqli_query($db, $sql);                      // create the query object
$recno = mysqli_insert_id($db);                         // create the query object

$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`, `punch_comment`)
        VALUES ('$card', '$timeStamp2', '~Lunch Punch')";
$result = mysqli_query($db, $sql);                      // create the query object
$recno = mysqli_insert_id($db);                         // Get the insert ID

mysqli_close($db);                                      //close the connection

//send the punch for comment
header('location: reviewAllSwipes.php?ppPrev='.$ppPrev.'&recno='.$card);
die;
?>