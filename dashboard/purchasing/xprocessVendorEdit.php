<?php
//processVendorEdit.php 2018/01
// Save Vendor Data
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

    //Establish Variables
$v=$_POST['v'];
$vendor_ID=$_POST['vendor_ID'];
$v[12] = ucwords($v[12]);
$flag = 0;
if($v[13]) $flag = 1;
if(!$v[14]) $v[14] = 0;
//echo $record."<br />";
//echo $v[0]."<br />"; //number
//echo $v[1]."<br />"; //name
//echo $v[2]."<br />"; //addr1
//echo $v[3]."<br />"; //addr2
//echo $v[4]."<br />"; //addr3
//echo $v[5]."<br />"; //email
//echo $v[6]."<br />"; //rep
//echo $v[7]."<br />"; //fax
//echo $v[8]."<br />"; //voice
//echo $v[9]."<br />"; //ship1
//echo $v[10]."<br />"; //ship2
//echo $v[11]."<br />"; //multi
//echo $v[12]."<br />"; //note
//echo 'venEdit.php?ven='.$v[0].'&message=Changes Saved&messColor=009900&messSize=24';
//exit;
if(!$v[9]) $v[9] = "Please Call With Freight Quote";
if(!$v[10]) $v[10] = "Cancel 30 Days After Ship Date - No Backorders Without Prior Approval";

// Make the query string
$sql = "UPDATE `".$db_db."`.`vendors`
    SET `vendor_name` = '".addslashes($v[1])."',
        `vendor_hti` = '".addslashes($flag)."',
        `vendor_group` = '".$v[14]."', 
        `vendor_addr1` = '".addslashes($v[2])."',
        `vendor_addr2` = '".addslashes($v[3])."',
        `vendor_addr3` = '".addslashes($v[4])."',
        `vendor_email` = '".addslashes($v[5])."',
        `vendor_rep` = '".addslashes($v[6])."',
        `vendor_fax` = '".addslashes($v[7])."',
        `vendor_voice` = '".addslashes($v[8])."',
        `vendor_ship1` = '".addslashes($v[9])."',
        `vendor_ship2` = '".addslashes($v[10])."',
        `vendor_multi` = '".addslashes($v[11])."',
        `vendor_note` = '".addslashes($v[12])."'
     WHERE `vendor_ID` = '".trim($vendor_ID)."';";
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Vendor Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection

$dest ='Location: vendorEdit.php?vendor_ID='.$vendor_ID.'&message=Changes Saved';
header($dest);
die;
?>
