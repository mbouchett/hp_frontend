<?php
//processAddOrderItem.php 2018/01
//save vendor count worksheet
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$order_ID = $_POST['add_order_ID'];
$item_ID = $_POST['add_ID'];
$io_qty = $_POST['add_qty'];
if(!$item_ID) header('location: viewOrder.php?order_ID='.$order_ID);
if(!$io_qty) $io_qty = 1;

//add the items to the order
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`order_items` (`item_ID`, `oi_qty`, `order_ID`)
		  VALUES ('$item_ID','$io_qty','$order_ID');";
$result = mysqli_query($db, $sql);
//on update error
if(!$result){
	echo "No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);	
	die;
}
mysqli_close($db);
header('location: viewOrder.php?order_ID='.$order_ID);
?>