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

$layaway_ID = $_REQUEST['layaway_ID'];
$cust_ID = $_REQUEST['cust_ID'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the delete
$sql = "DELETE FROM `layaway` WHERE `layaway_ID` = '".$layaway_ID."';";
$result = mysqli_query($db, $sql); // create the query object
if(!$result) {
	echo "Delete Layaway Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection
header('Location: csEdit.php?cust_ID='.$cust_ID.'&layaway=go');
die;
?>