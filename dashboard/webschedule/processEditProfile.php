<?php
// processEditProfile.php 2018/01
// Handles a timeclock punch comment
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');// set the default time zone

session_start(); // Resume up your PHP session!
// *** Verify Login ***
if(!isset($_SESSION['username'])){
  header('Location: index.php');
  exit;
}

$resource_ID = $_POST['resource_ID'];
$firstName = $_POST['fName'];
$lastName = $_POST['lName'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Verify All Fields present
if(!$firstName || !$lastName || !$email || !$phone){
    header('location: editProfile.php?message=All Fields Required');
    die;
}

// Verify for valid email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('location: editProfile.php?message=Invalid Email');
  die;
}

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
    $sql = "UPDATE `".$db_db."`.`resource`
        SET `resource_firstName` = '".$firstName."',
		 `resource_lastName` = '".$lastName."',
         `resource_phone` = '".$phone."',
         `resource_email` = '".$email."'
         WHERE `resource_ID` = ".$resource_ID;
//perform action
$result = mysqli_query($db, $sql); // create the query object                         // create the query object
mysqli_close($db); //close the connection
header('Location: editProfile.php?message=Changes Saved');
die;
?>