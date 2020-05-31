<?php
//saveEnterCount.php 2018/01
//save vendor count worksheet
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$vendor_ID = $_REQUEST['vendor_ID'];


$saveType = $_POST['submit'];

if($saveType == "Exit"){
	header('location: ../items.php?vendor_ID='.$vendor_ID);
	die;
}
$vendor_ID = $_POST['vendor_ID'];
$item_ID = $_POST['item_ID'];
$qty = $_POST['qty'];
$ord = $_POST['ord'];

$itemcount = count($item_ID);

//first off save the data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemcount; $i++){
	if(!$qty[$i]) $qty[$i] = 0;
	if(!$ord[$i]) $ord[$i] = 0;
	$sql = "UPDATE `".$db_db."`.`items`
			  SET `item_tempOH` = '".$qty[$i]."',
               `item_tempOQ` = '".$ord[$i]."'
         WHERE `item_ID` = '".$item_ID[$i]."';";
	$result = mysqli_query($db, $sql); // create the query object
	// on update error
	if(!$result){
		echo "No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
}
//order preview
mysqli_close($db);
if($saveType == "Preview Order"){
	header('location: previewOrder.php?vendor_ID='.$vendor_ID);
	die;
}

if($saveType == "Cycle Order"){
	header('location: processCycleOrder.php?vendor_ID='.$vendor_ID);
	die;
}

if($saveType == "OC Order"){
	header('location: processOffCycleOrder.php?vendor_ID='.$vendor_ID);
	die;
}


header('location: enterCount.php?vendor_ID='.$vendor_ID);
?>