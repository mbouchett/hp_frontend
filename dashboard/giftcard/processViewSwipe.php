<?php
//processSwipe.php 2018/01
// Main Gift Card Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$user = $_SESSION['username'];
$today = date("F j, Y, g:i a");
$time = date("Y-m-d-H-i");
$gc_num = $_POST['gc_num'];
$gc_ID=$_POST['gc_ID'];
$gc_alert=$_POST['gc_alert'];
$add=$_POST['add'];
$gc_balance=$_POST['gc_balance'];
$subtract=$_POST['subtract'];

if(!$add and !$subtract and !$gc_alert) {
	header('Location: viewSwipe.php?swipe='.$gc_num.'&message=No Changes Detected');
	die;
}
if($add and $subtract) {
	header('Location: viewSwipe.php?swipe='.$gc_num.'&message=Cannot Add And Subtract In The Same Transaction');
	die;
}
if($subtract > $gc_balance) {
	header('Location: viewSwipe.php?swipe='.$gc_num.'&message=Cannot Subtract More Than The Balance');
	die;
}

$newBalance=number_format((double)($gc_balance + $add -$subtract),2);
$subtract = number_format((double)$subtract,2);
$add = number_format((double)$add,2);
// Save The Transaction To the Log
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`gcLog` (`gcLog_num`, `gcLog_date`, `gcLog_plus`, `gcLog_minus`, `gcLog_balance`, `gcLog_user`)
		  VALUES ('$gc_num', '$time', '$add', '$subtract', '$newBalance', '$user')";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Gift Card Log Update Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}		  

// Save The Changes to the card
$sql = "UPDATE `".$db_db."`.`gc` SET `gc_balance` = '".$newBalance."', `gc_alert` = '".$gc_alert."' WHERE `gc_ID`=".$gc_ID;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Gift Card Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('Location: viewSwipe.php?swipe='.$gc_num.'&message=Changes Saved!');
die;
?>
