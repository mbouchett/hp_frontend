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

$cust_ID = $_POST['cust_ID'];
$date = date('Y/m/d');
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`layaway` (`cust_ID`, `lay_dateint`, `lay_datecomp`) VALUES ('$cust_ID', '$date', 'Due: Nothing Added Yet')";
$result = mysqli_query($db, $sql); // create the query object
if(!$result) {
	echo "Update Add LAyaway Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection
header('location: csEdit.php?cust_ID='.$cust_ID.'&layaway=go');
die;
?>