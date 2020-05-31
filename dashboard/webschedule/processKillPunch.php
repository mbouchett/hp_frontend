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

$card = $_REQUEST['recno'];
$ppPrev = $_REQUEST['ppPrev'];
$punch = $_REQUEST['punch'];

//echo $card."<br />";
//echo $ppPrev."<br />";
//echo $punch."<br />";

//Delete a punch
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the delete
$sql = "DELETE FROM `".$db_db."`.`rawPunch` WHERE `punch_ID` = '".$punch."';";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

//return
header('location: reviewAllSwipes.php?ppPrev='.$ppPrev.'&recno='.$card);
die;

?>