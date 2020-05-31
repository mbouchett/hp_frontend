<?php
// processAddPayment.php

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/_mash.php";
	
// ****************** initializes variables *******************
@$branch = $_POST['branch'];
$wc_ID = $_COOKIE['c_ID'];
$cardNum = $_POST['cardNum'];
$month = $_POST['mm'];
$year = $_POST['yyyy'];
$expiry = $month."-".$year;
$cvv = $_POST['cvv'];
$newaddress1 = $_POST['addr1'];
$newaddress2 = $_POST['addr2'];
$newzip = $_POST['zip'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$state = $_POST['state'];

// Encrypt Card Info
$eCardNum = mash($cardNum);
$ecvv = mash('xxx');
$eExpiry = mash($expiry);
$eLine1 = mash($newaddress1);
$eLine2 = mash($newaddress2);
$eZIP = mash($newzip);
$ePhone = mash($newphone);
$eCity = mash($newcity);
$eState = mash($newstate);

// Save the New Card Info and get new wm_ID
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`web_method` (`wc_ID`, `wm_card`, `wm_expiry`, `wm_cvv`, `wm_line1`, `wm_line2`, `wm_zip`,
                                                `wm_phone`, `wm_city`, `wm_state`)
    VALUES ('$wc_ID', '$eCardNum', '$eExpiry', '$ecvv', '$eLine1', '$eLine2', '$eZIP', '$ePhone', '$eCity', '$eState')";
$result = mysqli_query($db, $sql);

$wm_ID = mysqli_insert_id($db); //Grab the insert ID
mysqli_close($db);

if($branch == "checkout") {
	header('Location: ../cart/checkout.php');
	die;
}

header('Location: usrEditPayment.php?alert=Payment Method Added');
die;
?>