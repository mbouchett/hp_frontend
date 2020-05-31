<?php
//processDetailsUpload.php 2018/01
// Saves Changes to the item_details field
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

//Establish Variables
$vendor_ID=$_POST['vendor_ID'];
$item_ID=$_POST['item_ID'];
$details=$_POST['details'];

$details = str_replace('"',' ',$details);

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
$sql  = 'UPDATE `'.$db_db.'`.`items` SET `item_details` = \''.mysqli_real_escape_string($db,$details).'\' WHERE `items`.`item_ID` = '.$item_ID;
$result = mysqli_query($db, $sql); // create the query object
if(!$result) {
		echo "No Good!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
}
mysqli_close($db); //close the connection
header('Location: items.php?vendor_ID='.$vendor_ID);
die;
?>