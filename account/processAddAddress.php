<?php
//processEditAddress.php
//Mark Bouchett 2019

@include "/home/homeportonline/crc/2018.php";

@$branch = $_POST['branch'];
$addr1 = $_POST['line1'];
$addr2 = $_POST['line2'];
$zip = $_POST['zip'];
$user = $_COOKIE['c_ID'];

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
	// ************************** Does Address Already Exist **************************
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql  = 'SELECT *  FROM `web_addr` WHERE `wc_ID` = '.$user.' AND `wa_line1` LIKE \''.$addr1.'\'';
	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);
	mysqli_close($db);
	if($count > 0){
		header('location: usrEditAddress.php?alert=Address Is Already On File');
		die;
	}else {
		// ************************** Save new address **************************
		$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql = "INSERT INTO `".$db_db."`.`web_addr` (`wc_ID`, `wa_line1`, `wa_line2`, `wa_city`, `wa_state`, `wa_zip`)
        	VALUES ('$user', '$addr1', '$addr2', '$city', '$state', '$zip')";
		$result = mysqli_query($db, $sql);
		mysqli_close($db);
	}
}
if($branch == "checkout") {
	header('Location: ../cart/checkout.php');
	die;
}
header('location: usrEditAddress.php?alert=Address Added');
die;	
?>