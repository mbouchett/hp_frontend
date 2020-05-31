<?php
/* Contact form
	Mark/Francois Bouchett 2020
	processUpdateItemsInfo.php
*/

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/_unMash.php";

	$wo_ID = $_POST['wo_id'];
	$item_id = $_POST['item_id'];
	$qty = $_POST['qty'];
	
	// look up the item price
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `item_retail` FROM `items` WHERE `item_ID` = '.$item_id;
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Lookup Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	$item=mysqli_fetch_assoc($result);	
	$retail = $item['item_retail'];
	
	//Add New Item To Order
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "INSERT INTO `".$db_db."`.`web_order_items` (`wo_ID`, `item_ID`, `wo_qty`, `wo_amt`)
	        VALUES ('$wo_ID', '$item_id', '$qty', '$retail')";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Save Error!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	
	//Return To the Calling Page With a status Alert
	header('Location: orderDetails.php?wo_ID='.$wo_ID);
	die;
?>