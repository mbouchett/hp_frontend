<?php
//processDelMc.php 2018/01
// Deletes a merchandise credit entry from the system
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

//Establish Variables
$mc_ID=$_REQUEST['mc_ID'];
$cust_ID=$_REQUEST['cust_ID'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db); 
$sql = "DELETE FROM `".$db_db."`.`MC_Items` WHERE `mc_ID`=".$mc_ID;
$result = mysqli_query($db, $sql); // create the query object
if(!$result) {
	echo "Delete Mc Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection
header('location: csEdit.php?cust_ID='.$cust_ID.'&mc=go');
?>