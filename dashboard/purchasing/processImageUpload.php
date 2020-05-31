<?php
//processImageUpload.php 2018/01
// Vendor Catalog Edit Workspace
include "/home/homeportonline/crc/2018.php";

session_start(); // Resume up your PHP session!

date_default_timezone_set('America/New_York');
$vendor_ID = $_REQUEST['vendor_ID'];
$item_ID = $_REQUEST['item_ID'];
$fn = $_REQUEST['fn'];

//If nothing submitted return
if(!$fn){
	/*
	//If nothing submitted then clear the record from the database
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "UPDATE `".$db_db."`.`items` SET `item_pic` = NULL WHERE `item_ID` =".$item_ID;
    $result = mysqli_query($db, $sql);
    if(!$result) {
		echo "Clear Image Failed<br>";
		echo mysqli_error($db);
		die;
	 }
    mysqli_close($db);
    header('Location: items.php?vendor_ID='.$vendor_ID.'&message=Picture Removed ');
    die;
    */
    
    header('Location: items.php?vendor_ID='.$vendor_ID.'&message=Image Retained&go=1');
    die;
}

//do the database stuff & perform the update
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`items` SET `item_pic` = '".$fn."' WHERE `item_ID`=".$item_ID;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Image Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('Location: items.php?vendor_ID='.$vendor_ID.'&message=Picture Added&go=1');
die;
?>