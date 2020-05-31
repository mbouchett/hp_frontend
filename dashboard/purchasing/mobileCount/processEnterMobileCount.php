<?php
//enterMobileCount.php 2018/07
// process Mobile count worksheet
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
$today = date("Y-m-d");
$vendor_ID = $_POST['vendor_ID'];
$place = $_POST['place'];
$item_ID = $_POST['item_ID'];
$tempFL = $_POST['tempFL'];
$tempBS = $_POST['tempBS'];
$tempOH = ($tempFL + $tempBS);
if($tempFL==NULL) $tempFL = "NULL";
if($tempBS==NULL) $tempBS = "NULL";

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`items` 
		  set `item_tempOH` = ".$tempOH.", 
		  		`item_tempFL` = ".$tempFL.", 
		  		`item_tempBS` = ".$tempBS." 
		  WHERE `item_ID` =".$item_ID;
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "Save No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

//update that the count has been printed
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`vendors` 
		  SET `vendor_printCount` = '".$today."' 
        WHERE `vendor_ID` =".$vendor_ID;
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "print Update No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

header('location: enterMobileCount.php?vendor_ID='.$vendor_ID.'&place='.($place+1));
?>