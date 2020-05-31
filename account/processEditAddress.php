<?php
//processEditAddress.php
//Mark Bouchett 2019
@include "/home/homeportonline/crc/2018.php";

$branch = $_POST['branch'];
$wa_ID = $_POST['wa_ID'];
$line1 = $_POST['line1'];
$line2 = $_POST['line2'];
$zip = $_POST['zip'];

// ************************** lookup city/state from zip **************************
$strip_zip = ltrim($zip, '0');
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = 'SELECT *  FROM `zips` WHERE `zip_zip` LIKE \''.$strip_zip.'\'';
$result = mysqli_query($db, $sql);
mysqli_close($db);
$citystate = mysqli_fetch_assoc($result);
$city = $citystate['zip_city'];
$state = $citystate['zip_state'];

// ************************** Save Updated Info **************************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`web_addr` 
	    SET `wa_line1` = '".$line1."',
            `wa_line2` = '".$line2."',
            `wa_city` = '".$city."',
            `wa_state` = '".$state."',
            `wa_zip` = '".$zip."'
        WHERE `wa_ID` = ".$wa_ID;
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "Update No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

if($branch == "checkout") {
	header('Location: ../cart/checkout.php');
	die;
}

if($branch == "ur"){
	header('location: ../registries/regUpdateDetails.php');
	die;
}
header('location: usrEditAddress.php?alert=Changes Saved');
die;
?>