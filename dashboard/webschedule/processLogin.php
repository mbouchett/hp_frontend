<?php
//processLogin.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!
    //Establish Variables
  $date = date('F jS Y');
  $userName = $_POST['username'];
  $password = $_POST['pw'];

//Check to see if user exists

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `resource` WHERE `resource_userName` = '".$userName."'" ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//if the account is not found
if($num_results==0){
   	header('Location: index.php?message=Login Or Password Not Found&messColor=CC0033&messSize=20');
    die;
}

$resource=mysqli_fetch_assoc($result);

//if the account has a termination date
if($resource['lastDay']){
   	header('Location: index.php?message=Account Suspended&messColor=CC0033&messSize=20');
    die;
}

//if username and password don't match
$hash=crypt($password, '$2a$07$theclockswerestrikingthirteen$');

if(trim($hash) != trim($resource['resource_password'])){
	header('Location: index.php?message=Login Or Password Not Found&messColor=CC0033&messSize=20');
	die;
}

// SET SESSION VARIABLES
$_SESSION['usernum']=$resource['resource_ID']; // Save User Info For The Session
$_SESSION['username']=$resource['resource_userName'];
$_SESSION['useremail']=$resource['resource_email'];
$_SESSION['userlevel']=$resource['resource_level'];

header('Location: scheduleDash.php');
die;
?>