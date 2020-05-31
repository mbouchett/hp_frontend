<?php
//ackOrder.php 2018/01
// manual Acknowledge order receipt
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$order_ID=$_REQUEST['order_ID'];

$date = date('F d, Y');

// Update the order as sent
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `orders`.`order_akn` = \"M-".$date."\"
        WHERE `orders`.`order_ID` = ".$order_ID;
$result = mysqli_query($db, $sql); 
if(!$result) {
	echo "Update Aknowledgement Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection

header('Location: viewOrder.php?order_ID='.$order_ID);
die();
?>