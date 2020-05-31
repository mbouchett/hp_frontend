<?php
//processAddRegistryItems.php 2018/05
// save a registry addition
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
 //rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

$sku=$_POST['sku'];
$qty=$_POST['qty'];
$regnum=$_POST['regnum'];

//echo $sku;
//exit;
if(!$qty) $qty=1;
if(!$sku){
    header('Location: editRegItems.php?message=Sku Required&messColor=990000&messSize=24&regnum='.$regnum);
    die;
}

//create an array containing all of the items that belong to this category
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `items` WHERE `item_ID` = \''.trim($sku).'\' ' ;
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
$item=mysqli_fetch_assoc($result);

if(!$num_results) {
    header('Location: editRegItems.php?message=Invalid Sku&messColor=990000&messSize=24&regnum='.$regnum);
    die;
}
$description=stripslashes($item['item_desc']);
$price=stripslashes($item['item_retail']);

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//create insert string
$sql = "INSERT INTO `".$db_db."`.`reg_items` (`ri_desc`, `ri_price`, `ri_qty`, `reg_ID`, `item_ID`)
		VALUES ('$description', '$price', '$qty', '$regnum', '$sku')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
//close the connection
mysqli_close($db);

header('Location: editRegItems.php?message='.$qty.' '.$description.' Added&messColor=006600&messSize=24&regnum='.$regnum);
die;
?>