<?php
//processItems.php 2018/01
//process changes made on item.php
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
  	
$hq = $_POST['hq'];
$h = $_POST['h'];
$hist_ID = $_POST['hist_ID'];
$vendor_ID = $_POST['vendor_ID'];

if(!$hq) $hq = 0;
if(!is_numeric($hq)) header('location: items.php?vendor_ID='.$vendor_ID.'&message=History Not Saved!');
for($i = 0; $i < 8; $i++){
	if(!$h[$i]) $h[$i] = 0;
	if(!is_numeric($h[$i])){
		header('location: items.php?vendor_ID='.$vendor_ID.'&message=History Not Saved!');
		die;
	}
}

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`items` SET `item_qty`=".$hq." WHERE `item_ID`=".$hist_ID;
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "Update Quantity No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}

$sql = "UPDATE `".$db_db."`.`items_hist`
		  SET `h1`=".$h[0].", 
			   `h2`=".$h[1].",
				`h3`=".$h[2].",
				`h4`=".$h[3].",
				`h5`=".$h[4].",
				`h6`=".$h[5].",
				`h7`=".$h[6].",
				`h8`=".$h[7]."
		  WHERE `item_ID`=".$hist_ID;
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "Update History No Good!<br>";
	echo $sql." - ".$i."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('location: items.php?vendor_ID='.$vendor_ID.'&message=History Not Saved!');
die;
?>