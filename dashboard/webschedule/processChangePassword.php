<?php
//processChangePassword.php 2018/01
// changes user password
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');// set the default time zone

session_start(); // Resume up your PHP session!
// *** Verify Login ***
if(!isset($_SESSION['username'])){
  header('Location: index.php');
  exit;
}

$resource_ID = $_POST['resource_ID'];
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `resource` WHERE `resource_ID` = '.trim($resource_ID);
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
$resource=mysqli_fetch_assoc($result);

if(!$oldPassword || !$newPassword || !$confirmPassword){
    header('location: changePassword.php?message=All Fields Required&resource_ID='.$resource_ID);
    die;
}
if($newPassword != $confirmPassword){
    header('location: changePassword.php?message=Passwords Do Not Match&resource_ID='.$resource_ID);
    die;
}

//convert password to hash
$hash=crypt($oldPassword, '$2a$07$theclockswerestrikingthirteen$');
if($hash != $resource['resource_password']){
    header('location: changePassword.php?message=Incorrect Password&resource_ID='.$resource_ID);
    die;
}

//convert password to hash
$hash=crypt($newPassword, '$2a$07$theclockswerestrikingthirteen$');
//Open The Database

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
    $sql = "UPDATE `".$db_db."`.`resource`
        SET `resource_password` = '".$hash."'
         WHERE `resource_ID` = '".$resource_ID."';";
//perform action

$result = mysqli_query($db, $sql); // create the query object                         // create the query object
mysqli_close($db); //close the connection
header('Location: editProfile.php?message=Password Changed');

die;
?>