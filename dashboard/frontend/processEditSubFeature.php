<?php
	//dashboard/frontend/processEditSubFeature.php 2019/01
	//Add A Sub-Feature Group:
	
	include "/home/homeportonline/crc/2018.php";
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
  	
  	$start = $_POST['start'];
  	$end = $_POST['end'];
  	$f1 = $_POST['f1'];
	$link = $_POST['link'];
	
	//validate for missing data
	if(!$start  || !$end || !$f1[0] || !$f1[1] || !$f1[2] || !$f1[3]){
		header('Location: editSubFeature.php?alert=NOT SAVED! All Fields Are Required');
		die;
	}
	if(!$link[0] || !$link[1] || !$link[2] || !$link[3]){
		header('Location: editSubFeature.php?alert=NOT SAVED! All Fields Are Required');
		die;
	}
	//validate start less than end	
	if($start  > $end){
		header('Location: editSubFeature.php?alert=NOT SAVED! Start must be before End');
		die;
	}	
	
	//open Database for insert
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "INSERT INTO `".$db_db."`.`sub_feature` (`sf_start`, `sf_end`, `sf_f1`, `sf_f2`, `sf_f3`, `sf_f4`, `sf_link1`, `sf_link2`, `sf_link3`, `sf_link4`)
	        VALUES ('$start', '$end', '$f1[0]', '$f1[1]', '$f1[2]', '$f1[3]', '$link[0]', '$link[1]', '$link[2]', '$link[3]')";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Save Error!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
	$insert_ID = mysqli_insert_id($db); //Grab the insert ID
	mysqli_close($db);
	
	header('Location: editSubFeature.php?alert=Sub-Features Added '.date('Y-m-d H:i:s'));
	die;
?>