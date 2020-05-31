<?php
//processCsEdit.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$fName = $_POST['fName'];
$lName = $_POST['lName'];
$uName = $_POST['uName'];
$email = $_POST['email'];
$rate = $_POST['rate'];
$firstDay = $_POST['firstDay'];
$phone = $_POST['phone'];


// Verify All Fields present
if(!$fName || !$lName || !$email || !$rate || !$firstDay){
    header('location: addResource.php?message=All Fields Required&messColor=CC0033&messSize=20');
    die;
}
// Verify for valid email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('location: addResource.php?message=Invalid Email&messColor=CC0033&messSize=20');
    die;
}
// Verify if rate of pay is number
if(!is_numeric($rate)){
    header('location: addResource.php?message=Rate Of Pay Must Be A Number&messColor=CC0033&messSize=20');
    die;
}
// Verify for valid date
$firstDay = str_replace("/","-",$firstDay);
$pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"; // Valid Date (YYYY-MM-DD)
if(!preg_match($pattern, $firstDay)){
    header('location: addResource.php?message=Invalid Date (yyyy-mm-dd)&messColor=CC0033&messSize=20');
    die;
}

$password = "password";
$hash=crypt($password, '$2a$07$theclockswerestrikingthirteen$');

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`resource` 
		  (`resource_firstName`, `resource_lastName`, `resource_userName`, `resource_phone`, 
		  `resource_email`, `resource_password`, `resource_firstDay`, `resource_hourly`, `resource_payChange`)
        VALUES ('$fName', '$lName', '$uName', '$phone', '$email','$hash', '$firstDay', '$rate', '$firstDay')";

//perform action
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Add User Failed<br>";
	echo mysqli_error($db);
	die;
}
$resource_ID = mysqli_insert_id($db);
mysqli_close($db);
header('Location: scheduleDash.php?resource_ID='.$resource_ID);
die;

?>