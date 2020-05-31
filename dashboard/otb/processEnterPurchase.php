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
  	
  	// scrub text for database
	function scrubText($text){
	    $scrubbedText = str_replace("'", "", $text);
	    $scrubbedText = str_replace('"', '', $scrubbedText);
	    $scrubbedText = str_replace("\\", "-", $scrubbedText);
	    return $scrubbedText;
	}
  	
  	// Get Some Post Variables
  	$floor = $_POST['floor'];
  	$date = $_POST['date'];
  	$dept = $_POST['dept'];
	$vendor = $_POST['vendor'];
	$amount = $_POST['amount'];
	$po = $_POST['po'];
	$shipDate = $_POST['shipDate'];
	$comment = scrubText($_POST['comment']);
	$username = $_SESSION['username'];
	
	//validate for missing data
	if(!$date  || !$dept || !$vendor || !$amount || !$po || !$shipDate){
		header('Location: enterPurchase.php?floorSelection='.$floor.'&alert=NOT SAVED! All Fields Are Required');
		die;
	}	
	
	// Save the data
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "INSERT INTO `".$db_db."`.`otb` (`otb_date`, `otb_ship_date`, `vendor_ID`, `dept_ID`, `area_ID`, `otb_amt`, `otb_po`, `otb_comment`, `otb_buyer`)
	        VALUES ('$date', '$shipDate', '$vendor', '$dept', '$floor', '$amount', '$po', '$comment','$username')";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Save Error!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	
	//Return To the Calling Page With a status Alert
	header('Location: enterPurchase.php?floor='.$floor.'&alert=Purchase Added '.date('Y-m-d H:i:s'));
	die;

?>