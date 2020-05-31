<?php
//processCounter.php 2019/07
// Assigns counter to count
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
If(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
  	
$cp = $_REQUEST['cp'];
$ven = $_REQUEST['ven'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
$sql = "UPDATE `".$db_db."`.`vendors` 
	    SET `vendor_curCounter` = '".$cp."'
        WHERE `vendor_ID` = ".$ven;
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "Update No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);


header('Location: printCount.php?vendor_ID='.$ven);
die;
?>