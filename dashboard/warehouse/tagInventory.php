<?php
	//tagInventory.php 2020/04
	// search the warehouse inventory
	include "/home/homeportonline/crc/2018.php";
	
	date_default_timezone_set('America/New_York');
	
	session_start(); // Resume up your PHP session!
	  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
	}
	
	// ====================================== Update the database ======================================
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "UPDATE `whseInv` SET `wi_comment`=\"Verify\"";
	$result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Update Inventory Item Failed<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db); //close the connection	
	
	header('location: whDash.php');
	die;
?>whDash.php