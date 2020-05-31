<?php
//processAddVendor.php 2018/01
// Chooses which vendor's items to look at
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$v=$_POST['v'];

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

//Check for missing data
//if information is missing

if(!$v[1]){
	header('Location: addVendor.php?message=Vendor Name Is Required');
	die;
}
if(!$v[9]) $v[9] = "Please Call With Freight Quote";
if(!$v[10]) $v[10] = "Cancel 30 Days After Ship Date - No Backorders Without Prior Approval";

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
$sql = "INSERT `".$db_db."`.`vendors` (`vendor_name`, `vendor_addr1`, `vendor_addr2`, `vendor_addr3`, `vendor_email`, `vendor_rep`, `vendor_fax`, `vendor_voice`, 
													`vendor_ship1`, `vendor_ship2`, `vendor_multi`, `vendor_note`)
        VALUES ('$v[1]', '$v[2]', '$v[3]', '$v[4]', '$v[5]', '$v[6]', '$v[7]', '$v[8]', '$v[9]', '$v[10]', '$v[11]', '$v[12]')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
if(!$result){
	echo "Add Vendor - No Good<br>";
   echo $sql;
   echo mysqli_error($db);
   die;
}else {
	$vendor_ID = mysqli_insert_id($db);	
}
mysqli_close($db); //close the connection

header('Location: editVendor.php?vendor_ID='.$vendor_ID.'&message=Vendor Added '.date('l jS \of F Y h:i:s A'));
die;
?>