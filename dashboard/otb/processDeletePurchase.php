<?php
	//dashboard/frontend/processEditSubFeature.php 2019/01
	//Add A Sub-Feature Group:
	
	//Load Credentials
	include "/home/homeportonline/crc/2018.php";
	date_default_timezone_set('America/New_York');

	//Check For Logged In User
	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
  	
  	// Get Some Variables
  	$floor = $_REQUEST['floor'];
	$otb_ID = $_REQUEST['otb_ID'];
	
	//validate for missing data
	if(!$floor  || !$otb_ID ){
		die;
	}	
	
	// Delete otb_ID
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "DELETE FROM `".$db_db."`.`otb` WHERE `otb_ID` = '".$otb_ID."';";
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Delete Error!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	
	//Return To the Calling Page With a status Alert
	header('Location: enterPurchase.php?floor='.$floor.'&alert=Entry Deleted '.date('Y-m-d H:i:s'));
	die;

?>