<?php
//processPunchComment.php 2018/01
// Handles a timeclock punch comment
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');// set the default time zone

//get user variables
$comment = $_POST['comment'];
$punch_ID = $_POST['punch_ID'];

if(!$comment){
    header('location: timeClock.php');
    die;
}
if(is_nan($punch_ID)){
    header('location: timeClock.php');
    die;
}
if(substr($comment,0,1) == "%") {
	 header('location: timeClock.php');
    die;
}

// Save New Data to an SQL database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`rawPunch` 
		  SET `punch_comment` = '".mysqli_real_escape_string($db,$comment)."' 
		  WHERE `punch_ID`=".$punch_ID;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Save Comment Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

//send the punch for comment
header('location: timeClock.php');
?>