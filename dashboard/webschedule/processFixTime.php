<?php
//processCsEdit.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}


$card = $_REQUEST['card'];
$time = $_REQUEST['time'];
$ppPrev = $_REQUEST['ppPrev'];
$recno = $_REQUEST['recno'];

if(substr($time,-3,1) != ":" ) $time = substr($time,0,(strlen($time)-2)).":".substr($time,-2);

// Verify for valid time
$pattern = '#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#'; // Valid XX:XX or X:XX ()
if(!preg_match($pattern, $time)){
    header('location: reviewAllSwipes.php?ppPrev='.$ppPrev.'&recno='.$card);
    die;
}

// Save New Data to an SQL database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * from `rawPunch` WHERE `punch_ID` = ".$recno;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Failed 1<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$punch=mysqli_fetch_assoc($result);

$theDate = date('Y-m-d', strtotime($punch['punch_timeStamp']))." ".$time.":00";

$comment = $punch['comment'];
if(substr($comment,0,10) != "~Adjusted~") $comment = "~Adjusted~ ".$punch['comment'];


$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`rawPunch` SET `punch_comment` = '".$comment."', `punch_timeStamp` = '".$theDate."' WHERE `punch_ID` = '".$recno."';";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Failed 2<br>";
	echo mysqli_error($db);
	die;
}
$recno = mysqli_insert_id($db);
mysqli_close($db);

//return to review
header('location: reviewAllSwipes.php?ppPrev='.$ppPrev.'&recno='.$card);
die;
?>