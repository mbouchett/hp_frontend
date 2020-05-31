<?php
//processNewaccount.php
//Mark Bouchett 2019
@include "/home/homeportonline/crc/2018.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pw = $_POST['pw'];
$pwv = $_POST['pwv'];

$hash=crypt($pw, '$2a$07$theclockswerestrikingthirteen$');

function datawash($data){
    //clean data
    $data = strip_tags($data);          	// strip html tags
    $data = str_replace('"','',$data); 	// remove quotes
    $data = addslashes($data);          	// addslashes

    return $data;
}
$fName = datawash($fname);
$lName = datawash($lname);

//validate for missing data
if(!$fname  || !$lname || !$email || !$pw || !$pwv){
	header('Location: newAccount.php?alert=Sorry! All Fields Are Required');
	die;
}	

// check to see if user exists
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "Select * from `web_cust` WHERE `wc_email` = '".$email."'";
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db);
if($num_results != 0) {
	header('Location: signIn.php?email='.$email);
	die;
}

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`web_cust` 
		  (`wc_fname`, `wc_lname`, `wc_email`, `wc_pw`)
        VALUES ('$fname', '$lname', '$email','$hash')";

//perform action
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Account Creation Failed<br>";
	echo mysqli_error($db);
	die;
}
$ID = mysqli_insert_id($db);
mysqli_close($db);
// set cookies
setcookie("c_name", $fname, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("c_ID", $ID, time() + (86400 * 30), "/");
header('Location: index.php');
die;
?>