<?php
	// processCreateReg.php

	@include "/home/homeportonline/crc/2018.php";

	
	$m = $_POST['eMonth'];
	$d = $_POST['eDay'];
	$y = $_POST['eYear'];
	$edate = $y.'-'.$m.'-'.$d;
	$fn = $_POST['fn'];
	$ln = $_POST['ln'];
	$phone = $_POST['phone'];
	$ship = $_POST['ship'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$zip = $_POST['zip'];
	$user = $_COOKIE['c_ID'];
	$wa_ID = $ship;
	// ************************** lookup city/state from zip **************************
	$strip_zip = ltrim($zip, '0');
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql  = 'SELECT *  FROM `zips` WHERE `zip_zip` LIKE \''.$strip_zip.'\'';
	$result = mysqli_query($db, $sql);
	mysqli_close($db);
	$citystate = mysqli_fetch_assoc($result);
	$city = $citystate['zip_city'];
	$state = $citystate['zip_state'];
	
	if($zip) {
		// ************************** lookup city/state from zip **************************
		$strip_zip = ltrim($zip, '0');
		$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql  = 'SELECT *  FROM `zips` WHERE `zip_zip` LIKE \''.$strip_zip.'\'';
		$result = mysqli_query($db, $sql);
		mysqli_close($db);
		$citystate = mysqli_fetch_assoc($result);
		$city = $citystate['zip_city'];
		$state = $citystate['zip_state'];
		
		// ************************** Does Address Already Exist **************************
		$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql  = 'SELECT *  FROM `web_addr` WHERE `wc_ID` = '.$user.' AND `wa_line1` LIKE \''.$addr1.'\'';
		$result = mysqli_query($db, $sql);
		$count = mysqli_num_rows($result);
		mysqli_close($db);
		if($count > 0){
			$addr = mysqli_fetch_assoc($result);
			$wa_ID = $addr['$wa_ID'];
			
			//Update Address
			$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
			$sql = "UPDATE `".$db_db."`.`web_addr` 
			    	SET `wa_registry` = 1 
	            	WHERE `wa_ID`=".$addr['wa_ID'];
			$result = mysqli_query($db, $sql);
			mysqli_close($db);
		}else {
			// ************************** Save new address **************************
			$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
			$sql = "INSERT INTO `".$db_db."`.`web_addr` (`wc_ID`, `wa_line1`, `wa_line2`, `wa_city`, `wa_state`, `wa_zip`, `wa_registry`)
	        	VALUES ('$user', '$addr1', '$addr2', '$city', '$state', '$zip', 1)";
			$result = mysqli_query($db, $sql);
			// on update error
			if(!$result){
				echo "Address Insert Error!<br>";
				echo $sql." - ".$i."<br>";
				echo mysqli_error($db);
				die;
			}
			$wa_ID = mysqli_insert_id($db); //Grab the insert ID
			mysqli_close($db);
		}
	}
	// ************************** update user registry info **************************
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "UPDATE `".$db_db."`.`web_cust` 
			SET `wc_phone` = '".$phone."',
            	`wc_spouse_fn` = '".$fn."',
            	`wc_spouse_ln` = '".$ln."',
            	`wc_event_date` = '".$edate."',
            	`wa_ID` = '".$wa_ID."'
        	WHERE `wc_ID`=".$user;
	$result = mysqli_query($db, $sql); // create the query object
	// on update error
	if(!$result){
		echo "Update No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}

	header('location: manageRegistry.php');
?>