<?php
//addInventory.php 2018/02
// search the warehouse inventory
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
	header('Location: index.php');
	die;
}

$qty=$_POST['qty'];
$vendor = $_POST['vendor'];
$sku = $_POST['sku'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$location = $_POST['location'];
$pic = $_POST['pic'];
$dept = $_POST['dept'];
if(!$location) $location = "Not Located";
if(!$desc) $desc = "No Description";

// insert into warehouse inventory
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`whseInv` (`vendor`, `wi_sku`, `wi_price`, `wi_desc`, `wi_location`, `wi_pic`, `wi_dept`)
              VALUES ('$vendor', '$sku', '$price', '$desc', '$location', '$pic', '$dept')";
for($i=0; $i<$qty; $i++){
	$result = mysqli_query($db, $sql); // create the query object
	if(!$result) {
		echo "Add To Warehouse Inventory Failed<br>";
		echo mysqli_error($db);
		die;
	}	
}
$wi_ID = mysqli_insert_id($db);
mysqli_close($db);

header('Location: addInventory.php?wi_ID='.$wi_ID."&qty=".$qty);
die();
?>