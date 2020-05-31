<?php
// processEnterCommissions.php
// mark bouchett 04/19/2019
date_default_timezone_set('America/New_York');
include "/home/homeportonline/crc/2018.php";

$name = $_POST['cust'];
$desc = $_POST['desc'];
$qty = $_POST['qty'];
$type = $_POST['type']; //1=Regular, 2=Discount, 3=protection, 4 = Spiff
$amt = $_POST['amt'];
$trans = $_POST['trans'];
$emp = $_POST['emp'];
$date = $_POST['date'];
$now = date('Y-m-d h:i');

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`com` (`com_cust`, `resource_id`, `com_desc`, `com_qty`, `com_type`, `com_amt`, `com_trans`, `com_date`)
	    VALUES ('$name', '$emp', '$desc', '$qty', '$type', '$amt', '$trans', '$date')";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Commission Save Error!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	header('location: enterCommissions.php?alert=Commission Saved: '.$now);
	die;
?>