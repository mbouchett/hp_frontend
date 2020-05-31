<?php
/* Process Edit User Profile
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/processUsrEditPrifile.php
*/
@include "/home/homeportonline/crc/2018.php";


function datawash($data){
    //clean data
    $data = strip_tags($data);          // strip html tags
    $data = str_replace('"','',$data); // remove quotes
    $data = addslashes($data);          // addslashes

    return $data;
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$fName = datawash($fname);
$lName = datawash($lname);

// ================ save user data ================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`web_cust` 
		  SET `wc_fname` = '".addslashes($fname)."',
    	  		`wc_lname` = '".addslashes($lname)."',
        		`wc_email` = '".addslashes($email)."',
                `wc_phone` = '".addslashes($phone)."'
        WHERE `wc_ID` = ".$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update User Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection


$alert = 'Changes Saved: '.date("M. Y, H:i:s");
header('Location: usrEditProfile.php?alert='.$alert);
die;
?>