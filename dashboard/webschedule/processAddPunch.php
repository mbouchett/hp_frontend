<?php
//processAddPunch.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$card = $_POST['card'];
$date = $_POST['date'];
$ppPrev = $_POST['ppPrev'];
$time = $_POST['time'];

if(substr($time,-3,1) != ":" ) $time = substr($time,0,(strlen($time)-2)).":".substr($time,-2);

// Verify for valid time
$pattern = '#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#'; // Valid XX:XX or X:XX ()
if(!preg_match($pattern, $time)){
    header('location: reviewAllSwipes.php?ppPrev='.$ppPrev.'&recno='.$card);
    die;
}

$timeStamp = $date." ".$time.":00";

// Save New Data to an SQL database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string

$sql = "INSERT INTO `".$db_db."`.`rawPunch` (`resource_ID`, `punch_timeStamp`, `punch_comment`)
        VALUES ('$card', '$timeStamp', '~Manual Swipe')";
$result = mysqli_query($db, $sql);
$recno = mysqli_insert_id($db);

mysqli_close($db);                                      //close the connection

//send the punch for comment
header('location: reviewAllSwipes.php?ppPrev='.$ppPrev.'&recno='.$card);
die;
?>