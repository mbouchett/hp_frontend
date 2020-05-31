<?php
//processViewOrder.php 2018/01
// enter a vendor count worksheet
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

// =========================>  order data
$order_ID = $_POST['order_ID'];
$disc = $_POST['disc'];
$shipDate = $_POST['shipDate'];
$frgt01 = $_POST['frgt01'];
$frgt02 = $_POST['frgt02'];
$comment = $_POST['comment'];
$today = date("Y-m-d");
unset($itemsReceivedStatus);

// =========================>  items data
$oi_id = $_POST['oi_id'];
$qty = $_POST['qty'];
$itemcount = count($qty);
$recd = $_POST['recd'];
$ID = $_POST['ID'];

// =========================>  defaults
if(!$disc) $disc = 0;
if(!$shipDate) $shipDate = "ASAP";
if(!$frgt01) $frgt01 = "Please Call With Freight Quote";
if(!$frgt02) $frgt02 = "Cancel 30 Days After Ship Date - No Backorders Without Prior Approval";
if(!$comment) $comment = "Please Apply Discount - Special Terms - And Freight Allowance";


// =========================> update the order information
$sql = "UPDATE `".$db_db."`.`orders`
    SET `order_discount` = '".$disc."',
    	  `order_shipDate` = '".$shipDate."',
        `order_frgt01` = '".$frgt01."',
        `order_frgt02` = '".$frgt02."',
        `order_comments` = '".$comment."'
     WHERE `order_ID` = '".$order_ID."';";
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Order Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection

// =========================> update the quantities and process the deletes
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemcount; $i++) {
	if($qty[$i] == 0) {
		$sql = "DELETE FROM `".$db_db."`.`order_items` WHERE `order_items`.`oi_id`='".$oi_id[$i]."';";
	}else {
		$sql = "UPDATE `".$db_db."`.`order_items` SET `oi_qty`='".$qty[$i]."' WHERE `oi_id`='".$oi_id[$i]."';";
	}
	$result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Update Order Item Failed<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db); //close the connection

// =========================> update the received information and the item on hands
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//update received
for($i = 0; $i < $itemcount; $i++) {
	if($recd[$i]) {
		$itemsReceivedStatus = 1;
		$sql = "UPDATE `".$db_db."`.`order_items` SET `oi_received`='".$today."' WHERE `oi_id`='".$oi_id[$i]."';";
		$result = mysqli_query($db, $sql);
		if(!$result) {
			echo "Update Receive Item Failed<br>";
			echo mysqli_error($db);
			die;
		}
// get old quantity
		$sql = "SELECT `item_qty` FROM `items` WHERE `item_ID`=".$ID[$i];	
		$result = mysqli_query($db, $sql);
		$oldqty = mysqli_fetch_assoc($result);
// save new quantity
		$sql = "UPDATE `".$db_db."`.`items` SET `item_qty`=".($qty[$i] + $oldqty['item_qty'])." WHERE `item_ID`='".$ID[$i]."';";
		$result = mysqli_query($db, $sql);
		if(!$result) {
			echo "Update Item On Hand Failed<br>";
			echo mysqli_error($db);
			die;
		}
	}
}
if($itemsReceivedStatus) {
	// update order status
	$sql = "UPDATE `".$db_db."`.`orders` SET `order_status`=4 WHERE `order_ID`=".$order_ID;
	$result = mysqli_query($db, $sql);
	if(!$result) {
	    echo "Update Order Status Failed<br>";
	    echo $sql."<br>";
	    echo mysqli_error($db);
	    die;
	}
}
mysqli_close($db); //close the connection

header('location: viewOrder.php?order_ID='.$order_ID);
?>