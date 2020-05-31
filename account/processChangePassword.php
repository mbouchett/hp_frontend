<?php
/*  Process forgot password
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/processForgotpw.php
*/
@include "/home/homeportonline/crc/2018.php";

$ID = $_COOKIE['c_ID'];
$op = $_POST['oldPW'];
$np = $_POST['newPW'];

$opHash = crypt($op, '$2a$07$theclockswerestrikingthirteen$');
$npHash = crypt($np, '$2a$07$theclockswerestrikingthirteen$');

// check old password
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_cust` WHERE `wc_ID`='.$ID;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Fatal Error!<br>";
	//echo $sql." - ".$i."<br>";
	//echo mysqli_error($db);
	die;
}
$user=mysqli_fetch_assoc($result);

if($user['wc_pw'] != $opHash) {
    header('Location: changePassword.php?alert=Old Password Error...');
	die;
}

// Save new password
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "UPDATE `".$db_db."`.`web_cust`  
		    SET `wc_pw` = '".$npHash."'
            WHERE `wc_ID`=".$ID;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Update No Good!<br>";
	//echo $sql." - ".$i."<br>";
	//echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('Location: usrEditProfile.php?alert=Password Updated!');
?>
