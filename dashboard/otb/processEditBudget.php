<?php
	//dashboard/frontend/processEnterBudget.php 2019/01
	//Add Open to buy budget year
	
	//Load Credentials
	include "/home/homeportonline/crc/2018.php";
	date_default_timezone_set('America/New_York');

	//Check For Logged In User
	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
  	
  	// Get Some Post Variables
  	$year = $_POST['year'];
  	$amt = $_POST['amt'];
  	$id = $_POST['id'];
  	$recordCount = count($id);
  		
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	//perform the update
	for($i=0; $i<$recordCount; $i++){
		$sql = "UPDATE `".$db_db."`.`otb_budget`
				  SET `ob_amt` = '".str_replace(',', '', $amt[$i])."'
	         WHERE `ob_ID` = '".$id[$i]."';";
		$result = mysqli_query($db, $sql); // create the query object
		// on update error
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
	}
	mysqli_close($db);
	//Return To the Calling Page With a status Alert
	header('Location: editBudget.php?year='.$year.'&alert=Budget Updated '.date('Y-m-d H:i:s'));
	die;
?>