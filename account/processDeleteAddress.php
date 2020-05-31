<?php
//processDeleteAddress.php
//Mark Bouchett 2019

@include "/home/homeportonline/crc/2018.php";

@$wa_ID = $_REQUEST['wa_ID'];

$loggedIn = 0;
if(isset($_COOKIE['c_ID'])) $loggedIn = 1; // Is a user logged in

// ********************************************* look up address ********************************************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_addr` WHERE `wa_ID` = '.$wa_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);
$wa=mysqli_fetch_assoc($result);	

if($wa['wc_ID'] == $_COOKIE['c_ID']) {
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "DELETE FROM `".$db_db."`.`web_addr` WHERE `wa_ID` = '".$wa_ID."';";
	$result = mysqli_query($db, $sql);
	mysqli_close($db);
}
header('Location: usrEditAddress.php?alert=Address Deleted '.date('Y-m-d H:i:s'));
die;
?>