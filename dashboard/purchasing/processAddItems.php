<?php
//processAddItems.php 2018/01
// Vendor Catalog Edit Workspace
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
  	
//Establish Variables
$vendor_ID = $_POST['vendor_ID'];
$sku=strtoupper($_POST['isku']);
$desc=$_POST['desc'];
$dept=$_POST['dept'];
$pack=$_POST['pack'];
$cost=number_format(doubleval($_POST['cost']),2);
$retail=number_format(doubleval($_POST['retail']),2,'.','');
//echo $description."<br>";
//clean data
$desc = strip_tags($desc);
$desc = str_replace('"','in',$desc);
$desc = addslashes($desc);
//exit;
//if information is missing
if(!$sku  || !$desc || !$dept || !$pack || !$cost || !$retail){
	header('Location: items.php?vendor_ID='.$vendor_ID.'&message=ITEM NOT SAVED! All Fields Are Required');
	die;
}

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT `".$db_db."`.`items` (`vendor_ID`, `item_sku`, `item_desc`, `dept_ID`, `item_pack`, `item_cost`, `item_retail`, `item_qty`)
        VALUES ('$vendor_ID', '$sku', '$desc', '$dept', '$pack', '$cost', '$retail', 0)";
$result = mysqli_query($db, $sql); // create the query object
// create associated history file
if($result){
	$last_id = mysqli_insert_id($db);
}else{
	echo "Add Item Failed";
	echo mysqli_error($db);
	die;
}
$sql = "INSERT `".$db_db."`.`items_hist` (`item_ID`) VALUES ('$last_id')";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: items.php?vendor_ID='.$vendor_ID.'&message=Item Added '.date('l jS \of F Y h:i:s A'));
die;
?>