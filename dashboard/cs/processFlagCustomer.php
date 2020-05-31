<?php
//csEdit.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$cust_ID = $_REQUEST['cust_ID'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `customers` WHERE `cust_ID`='.$cust_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);
$customer=mysqli_fetch_assoc($result);       //Fetch The Current Record

if($customer['cust_flag']){
    $sql = "UPDATE `".$db_db."`.`customers` SET `cust_flag` = FALSE WHERE `cust_ID` = '".$cust_ID."';";
}else{
    $sql = "UPDATE `".$db_db."`.`customers` SET `cust_flag` = TRUE WHERE `cust_ID` = '".$cust_ID."';";
}

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$result = mysqli_query($db, $sql);  // create the query object
mysqli_close($db);                  //close the connection

$dest ='Location: csEdit.php?cust_ID='.$cust_ID;
header($dest);
die;
?>