<?php
//processAddLayPay.php 2018/01
// processes a payment on a layaway
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
$layaway_ID = $_POST['layaway_ID'];
$lp_date = $_POST['date'];
$lp_trans = $_POST['lp_trans'];
$lp_payType = $_POST['payType'];
$lp_amount = $_POST['lp_amount'];
$lp_employee = $_POST['lp_employee'];
if(!$lp_date || !$lp_trans || !$lp_amount || !$lp_employee ){
	header('Location: layaway.php?layaway_ID='.$layaway_ID.'&alert=1');
	die;
}
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`layPayment` 
		  (`layaway_ID`, `lp_date`, `lp_trans`, `lp_payType`, `lp_amount`, `lp_employee`)
        VALUES ('$layaway_ID', '$lp_date', '$lp_trans', '$lp_payType', '$lp_amount', '$lp_employee')";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Add Layaway Payment Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('location: layaway.php?layaway_ID='.$layaway_ID);
die;
?>