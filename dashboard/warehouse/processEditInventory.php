<?php
//processEditInventory.php 2018/02
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
$wi_pic = $_POST['wi_pic'];
$wi_vendor = $_POST['wi_vendor'];
$wi_sku = $_POST['wi_sku'];
$wi_price = $_POST['wi_price'];
$wi_desc = $_POST['wi_desc'];
$wi_location = $_POST['wi_location'];
$wi_purchased = str_replace('"','“',$_POST['wi_purchased']);
$wi_cust = str_replace('"','“',$_POST['wi_cust']);
$wi_employee = str_replace('"','“',$_POST['wi_employee']);
$wi_comment = str_replace('"','“',$_POST['wi_comment']);
$wi_dept = $_POST['wi_dept'];
$del = $_POST['del'];
$wiCount = count($wi_ID);

// ====================================== Update the database ======================================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $wiCount; $i++) {
	$sql = "UPDATE `".$db_db."`.`whseInv` 
		  SET `wi_pic` = '".mysqli_real_escape_string($db,$wi_pic[$i])."',
		  		`vendor` = '".mysqli_real_escape_string($db,$wi_vendor[$i])."',
		  		`wi_sku` = '".mysqli_real_escape_string($db,$wi_sku[$i])."',
		  		`wi_price` = '".mysqli_real_escape_string($db,$wi_price[$i])."',
		  		`wi_desc` = '".mysqli_real_escape_string($db,$wi_desc[$i])."',
		  		`wi_location` = '".mysqli_real_escape_string($db,$wi_location[$i])."',
		  		`wi_purchased` = '".mysqli_real_escape_string($db,$wi_purchased[$i])."',
    	  		`wi_cust` = '".mysqli_real_escape_string($db,$wi_cust[$i])."',
        		`wi_employee` = '".mysqli_real_escape_string($db,$wi_employee[$i])."',
        		`wi_comment` = '".mysqli_real_escape_string($db,$wi_comment[$i])."',
        		`wi_dept` = '".$wi_dept[$i]."' 
        WHERE `wi_ID` = ".$wi_ID[$i];	
		  
	$result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Update Inventory Item Failed<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db); //close the connection

// ====================================== perform deletes ======================================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $wiCount; $i++) {
	if($del[$i] == 'on') {
		$sql = "DELETE FROM `".$db_db."`.`whseInv` WHERE `wi_ID` = ".$wi_ID[$i];	  
		$result = mysqli_query($db, $sql);
		if(!$result) {
			echo "Update Inventory Item Failed<br>";
			echo mysqli_error($db);
			die;
		}
	}
}
mysqli_close($db); //close the connection
header('location: editInventory.php?referSearch='.$searchKey.'&catSelected='.$catSelected);
die;
?>