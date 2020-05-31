<?php
//processCsEdit.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

// ===================== get data =====================
// customer data
$cust_ID = $_POST['cust_ID'];
$cust_name = $_POST['cust_name'];
$cust_phone = $_POST['cust_phone'];
$cust_addr01 = $_POST['cust_addr01'];
$cust_addr02 = $_POST['cust_addr02'];
$cust_email = $_POST['cust_email'];
$cust_note = $_POST['cust_note'];
// customer item data
$ci_ID = $_POST['ci_ID'];
$painInFull = $_POST['painInFull'];
$ci_tagged = $_POST['ci_tagged'];
$ci_qty = $_POST['ci_qty'];
$ci_price = $_POST['ci_price'];
$ci_sku = $_POST['ci_sku'];
$ci_desc = $_POST['ci_desc'];
$dept_ID = $_POST['dept_ID'];
$vendor_ID = $_POST['vendor_ID'];
$itemcount = count($ci_ID);
$ci_pif = $_POST['ci_pif'];
$order_ID = $_POST['order_ID'];
$ci_location = $_POST['ci_location'];
$ci_datecontacted = $_POST['ci_datecontacted'];
$ci_datepickedup = $_POST['ci_datepickedup'];


// ================ save customer data ================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`customers` 
		  SET `cust_name` = '".addslashes($cust_name)."',
    	  		`cust_phone` = '".addslashes($cust_phone)."',
        		`cust_addr01` = '".addslashes($cust_addr01)."',
        		`cust_addr02` = '".addslashes($cust_addr02)."',
        		`cust_note` = '".addslashes($cust_note)."',
        		`cust_email` = '".addslashes($cust_email)."'
        WHERE `cust_ID` = ".$cust_ID;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Customer Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection

// ================ save item data ================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemcount; $i++) {
	$sql = "SELECT `cust_items`.`ci_location`, `cust_items`.`order_ID`  FROM `cust_items` WHERE `ci_ID` = ".$ci_ID[$i];
	$result = mysqli_query($db, $sql);
	$location = mysqli_fetch_assoc($result);
	if($location['ci_location'] != $ci_location[$i]) {	
		$sql = "UPDATE `".$db_db."`.`cust_items` 
		  SET `ci_dateheld` = '".date('Y-m-d')."'
		  WHERE `ci_ID` = ".$ci_ID[$i];
		$result = mysqli_query($db, $sql);
	}
	if($location['order_ID'] != $order_ID[$i]) {	
		$sql = "UPDATE `".$db_db."`.`cust_items` 
		  SET `ci_dateordered` = '".date('Y-m-d')."'
		  WHERE `ci_ID` = ".$ci_ID[$i];
		$result = mysqli_query($db, $sql);
	}
	if($ci_tagged[$i] == 'on') {
		$ci_tagged[$i] = 1;
	}else{
		$ci_tagged[$i] = 0;	
	}
	if($painInFull[$i] == 'on') {
		$painInFull[$i] = 1;
	}else{
		$painInFull[$i] = 0;	
	}	
	if(!$ci_qty[$i]) $ci_qty[$i] = 0;
	$sql = "UPDATE `".$db_db."`.`cust_items` 
		  SET `ci_tagged` = '".$ci_tagged[$i]."',
		  		`ci_pifFlag` = '".$painInFull[$i]."',
    	  		`ci_qty` = '".$ci_qty[$i]."',
        		`ci_price` = '".addslashes($ci_price[$i])."',
        		`ci_sku` = '".addslashes($ci_sku[$i])."',
        		`ci_desc` = '".addslashes($ci_desc[$i])."',
        		`dept_ID` = '".$dept_ID[$i]."',
        		`vendor_ID` = '".$vendor_ID[$i]."',
        		`ci_pif` = '".addslashes($ci_pif[$i])."',
				`order_ID` = '".addslashes($order_ID[$i])."',
				`ci_location` = '".addslashes($ci_location[$i])."',
				`ci_datecontacted` = '".addslashes($ci_datecontacted[$i])."',
				`ci_datepickedup` = '".addslashes($ci_datepickedup[$i])."'
        WHERE `ci_ID` = ".$ci_ID[$i];
	$result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Update Customer Item Failed<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db); //close the connection

// ================ remove deleted items ================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemcount; $i++) {
	if($ci_qty[$i] == 0) {
		$sql = "DELETE FROM `".$db_db."`.`cust_items` WHERE `ci_ID` = ".$ci_ID[$i];
		$result = mysqli_query($db, $sql);
		if(!$result) {
			echo "Delete Customer Item Failed<br>";
			echo mysqli_error($db);
			die;
		}
	}
}
mysqli_close($db); //close the connection

// ================ Check For PIFs ================
$pTrue = 0;
for($i = 0; $i < $itemcount; $i++) {
	if($painInFull[$i]) $pTrue++;
}
if($pTrue > 0) {
	header('location: printPif.php?cust_ID='.$cust_ID);
	die;
}

header('location: csEdit.php?cust_ID='.$cust_ID.'&message=Changes Saved '.date('h:m:s'));
?>