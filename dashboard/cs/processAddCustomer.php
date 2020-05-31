<?php
//processAddCustomer.php 2018/01
// Add A CS Customer to the system
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

function datawash($data){
    //clean data
    $data = strip_tags($data);          // strip html tags
    $data = str_replace('"','”',$data); // remove quotes
    $data = addslashes($data);          // addslashes

    return $data;
}

//Establish Variables
$c=$_POST['c'];

//echo $record."<br />";
//echo $c[0]."<br />"; //First Date
//echo $c[1]."<br />"; //Employee
//echo $c[2]."<br />"; //Customer Name
//echo $c[3]."<br />"; //Customer Phone
//echo $c[4]."<br />"; //Address Line 1
//echo $c[5]."<br />"; //Address Line 2
//echo $c[6]."<br />"; //Customer Email
//echo $c[7]."<br />"; //Note

$c[2] = datawash($c[2]);
$c[2] = ucwords($c[2]);

//Check for missing data
if(!$c[1] || !$c[2]){
	header('Location: addCustomer.php?message=Employee and customer Name Are Required');
	die;
}
if(!$c[3] & !$c[6]){
	header('Location: addCustomer.php?message=Phone Number and/or Email Are Required');
	die;
}

//if email exists then validate it
// Check For Valid Email
if ($c[6] && !filter_var($c[6], FILTER_VALIDATE_EMAIL)) {
	//Do this stuff if the email is invalid
	header('Location: addCustomer.php?message=Invalid Email Address');
	die;
}

// ======================= Save Customer Data =======================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `customers` WHERE `cust_name` LIKE"'.$c[2].'"' ;
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db);
//if the name is found

if($num_results>0){
    $cust=mysqli_fetch_assoc($result);
    header('Location: csEdit.php?cust_ID='.$cust['cust_ID'].'&message=Customer Is Already In The Database');
	die;
}

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`customers` (`cust_addDate`, `cust_employee`, `cust_name`, `cust_phone`, `cust_addr01`, `cust_addr02`, `cust_email`, `cust_note`)
        VALUES ('$c[0]', '$c[1]', '$c[2]', '$c[3]', '$c[4]', '$c[5]', '$c[6]', '$c[7]')";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Add Customer Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$cust_ID = mysqli_insert_id($db);
mysqli_close($db);

header('Location: csEdit.php?cust_ID='.$cust_ID.'&message=Customer Added '.date('l jS \of F Y h:i:s A'));
die;
?>