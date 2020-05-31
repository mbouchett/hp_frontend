<?php
//searchInventory.php 2018/02
// search the warehouse inventory
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
	header('Location: index.php');
	die;
}

// Get Variables
$catSelected = $_POST['catSelected'];
$searchKey = $_POST['searchKey'];
$wi_ID = $_POST['wi_ID'];
$wi_purchased = str_replace('"','“',$_POST['wi_purchased']);
$wi_cust = str_replace('"','“',$_POST['wi_cust']);
$wi_employee = str_replace('"','“',$_POST['wi_employee']);
$wi_comment = str_replace('"','“',$_POST['wi_comment']);
$wiCount = count($wi_ID);

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $wiCount; $i++) {
	$sql = "UPDATE `".$db_db."`.`whseInv` 
		  SET `wi_purchased` = '".mysqli_real_escape_string($db,$wi_purchased[$i])."',
    	  		`wi_cust` = '".mysqli_real_escape_string($db,$wi_cust[$i])."',
        		`wi_employee` = '".mysqli_real_escape_string($db,$wi_employee[$i])."',
        		`wi_comment` = '".mysqli_real_escape_string($db,$wi_comment[$i])."'
        WHERE `wi_ID` = ".$wi_ID[$i];	
		  
	$result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Update Inventory Item Failed<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db); //close the connection
header('location: searchInventory.php?referSearch='.$searchKey.'&catSelected='.$catSelected);
die;
?>