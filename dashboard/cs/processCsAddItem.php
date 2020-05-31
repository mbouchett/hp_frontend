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
$cust_ID = $_POST['cust_ID'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$sku = $_POST['sku'];
$desc = $_POST['desc'];
$dept_ID = $_POST['dept_ID'];
$vendor_ID = $_POST['vendor_ID'];
$today = date('Y-m-d');

// ================== validate data ===================
$desc = strip_tags($desc);
$desc = str_replace('"','"',$desc);
$desc = addslashes($desc);

//if information is missing
if(!$qty  || !$price || !$sku || !$desc) {
	header('Location: csEdit.php?cust_ID='.$cust_ID.'&message=ITEM NOT SAVED! All Fields Are Required');
	die;
}

// ================= Insert New Item ==================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT `".$db_db."`.`cust_items` (`cust_ID`, `dept_ID`, `ci_qty`, `ci_sku`, `ci_desc`, `ci_price`, `vendor_ID`, `ci_dateadded`)
        VALUES ('$cust_ID', '$dept_ID', '$qty', '$sku', '$desc', '$price', '$vendor_ID', '$today')";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Add Customer Item Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

header('location: csEdit.php?cust_ID='.$cust_ID.'&message=Item Added '.date('h:m:s'));
?>