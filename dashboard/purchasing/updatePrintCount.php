<?php
//updatePrintCount.php 2018/01
//indicate that a count has been printed
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$today = date("Y-m-d");
$vendor_ID = $_REQUEST['vendor_ID'];

//update that the count has been printed
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`vendors` 
		  SET `vendor_printCount` = '".$today."' 
        WHERE `vendor_ID` =".$vendor_ID;
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "print Update No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

header('location: countList.php');
?>