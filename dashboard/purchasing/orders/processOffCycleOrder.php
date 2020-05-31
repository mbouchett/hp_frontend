<?php
//processOffCycleOrder.php 2018/01
//save vendor count worksheet
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$today = date("Y-m-d");
$vendor_ID = $_REQUEST['vendor_ID'];
$poExt = strtoupper(substr($_SESSION['username'], 0, 2));

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$vendor_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);

if($result) {
	$vendor = mysqli_fetch_assoc($result);
	$frgt01 = $vendor['vendor_ship1'];
	$frgt02 = $vendor['vendor_ship2'];
	$comments = $vendor['vendor_note'];
}else{
	echo "Vendor Not Found";
	die;
}

// load vendor catalog into array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `items`
		  LEFT JOIN `items_hist` ON `items`.`item_ID`=`items_hist`.`item_ID` 
		  WHERE `items`.`vendor_ID` = '.$vendor['vendor_ID']." AND `items`.`item_tempOQ` > 0 
		  ORDER BY `dept_ID`, `item_desc`";
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
}
$itemcount=count($items);

//create the new Order
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`orders` (`vendor_ID`, `order_by`, `order_shipDate`, `order_frgt01`, `order_frgt02`, `order_comments`, `order_offCycle`, `order_date`)
        VALUES ( '$vendor_ID', '$poExt', 'ASAP', '$frgt01', '$frgt02', '$comments', 1, '$today');";
$result = mysqli_query($db, $sql);
if(!$result){
	echo "No Good<br>";
   echo $sql;
   die;
}else {
	$order_ID = mysqli_insert_id($db);	
}
mysqli_close($db);

//add the items to the order
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemcount; $i++) {
	$item_ID = $items[$i]['item_ID'];
	$io_qty = $items[$i]['item_tempOQ'];
	$sql = "INSERT INTO `".$db_db."`.`order_items` (`item_ID`, `oi_qty`, `order_ID`)
			  VALUES ('$item_ID','$io_qty','$order_ID');";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db);

//Update the Item History
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemcount; $i++) {
	
	$item_ID = $items[$i]['item_ID'];
	$io_qty = $items[$i]['item_tempOQ'];
	$lpo = $items[$i]['lpo'];
	if(!$lpo) $lpo = "-";
	$loq = $items[$i]['loq'];
	if(!$loq) $loq = 0;
	$ldat = $items[$i]['ldat'];
	if(!$ldat) $ldat = "-";
	$po = $order_ID.$poExt."X";
	
	$sql = "UPDATE `".$db_db."`.`items_hist` 
			  SET `ppo` = '".$lpo."',
               `poq` = '".$loq."',
               `pdat` = '".$ldat."',
		         `lpo` = '".$po."',
               `loq` = '".$io_qty."',
               `ldat` = '".$today."'
         WHERE `item_ID` = '".$item_ID."';";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db);

//Clear Temporary items data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemcount; $i++) {
	$item_ID = $items[$i]['item_ID'];
	$sql = "UPDATE `".$db_db."`.`items` 
			  SET `item_tempOH` = 0,
               `item_tempOQ` = 0 
         WHERE `item_ID` = '".$item_ID."';";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
}
header('location: viewOrder.php?order_ID='.$order_ID);
die;
?>