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
	
	//validate for missing data
	if(!$year){
		header('Location: enterBudget.php?alert=Year is a required field');
		die;
	}	
	
	// See if year already exists
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `otb_budget` WHERE `ob_year` = '.$year;
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Lookup Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	$count = mysqli_num_rows($result);
	mysqli_close($db);
	if($count > 0) {
		header('Location: editBudget.php?year='.$year.'&alert=Year already exists');
		die;
	}
	
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i = 1; $i < 13; $i++) {
		for($ii = 0; $ii < 4; $ii++) {
			$jj = $ii+1;
			$amount = $amt[$i][$ii];
			$sql = "INSERT INTO `".$db_db."`.`otb_budget` (`ob_month`, `ob_year`, `area_ID`, `ob_amt`)
			        VALUES ('$i', '$year', '$jj', '$amount')";
			$result = mysqli_query($db, $sql);
			// on update error
			if(!$result){
				echo "Save Error!<br>";
				echo $sql." - ".$i."<br>";
				echo mysqli_error($db);
				die;
			}
		}
	}
	mysqli_close($db);
	

	
	//Return To the Calling Page With a status Alert
	header('Location: editBudget.php?year='.$year.'&alert=Budget Year Added '.date('Y-m-d H:i:s'));
	die;
?>