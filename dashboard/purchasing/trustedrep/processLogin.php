<?php
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!

//Establish Variables
$date = date('F jS Y');
$userName = $_POST['username'];
$password = $_POST['pw'];
$showHash = 0;
if(substr($password,0,1) == "*") {
	$showHash = 1;
	$password = substr($password,1);
}

$hash=crypt($password, '$2a$07$theclockswerestrikingthirteen$');
if($showHash == 1) {
	echo $hash;
	exit;
}

/*
echo "Username: ".$userName."<br>";
echo "Typed PW: ".$password."<br>";
echo "Hash  PW: ".$hash."<br>";
echo "Saved PW: ".$resource['resource_password']."<br>";
exit;
*/

//Check to see if user exists
//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `trusted_rep` WHERE `rep_email` = '".$userName."'" ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//if the account is not found
if($num_results==0){
   	header('Location: index.php?message=NOPE');
    die;
}

$rep=mysqli_fetch_assoc($result);

//if username and password don't match
if($hash != $rep['rep_password']){
	header('Location: index.php?message=NOT EVEN CLOSE');
	die;
}

// SET SESSION VARIABLES
$_SESSION['repnum']=$rep['rep_ID']; // Save User Info For The Session
$_SESSION['repemail']=$rep['rep_email'];
$_SESSION['repfname']=$rep['rep_fname'];
$_SESSION['replname']=$rep['rep_lname'];

header('Location: companySelect.php');
die;
?>