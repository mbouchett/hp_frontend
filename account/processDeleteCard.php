<?php
/* process delete web_method
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/processDeleteCard.php
*/

@include "/home/homeportonline/crc/2018.php";

@$card = $_REQUEST['card'];
@$wc_ID = $_COOKIE['c_ID'];

if(!$card || !$wc_ID) {
	die;
}

// ********************************************* look up card ********************************************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_method` WHERE `wc_ID` = '.$_COOKIE['c_ID'].' AND `wm_ID` = '.$card;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$cardCount = mysqli_num_rows($result);
mysqli_close($db);

if($cardCount != 1) { die; }

// ********************************************* Delete Card**********************************************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `".$db_db."`.`web_method` WHERE `wm_ID`=".$card;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Delete Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}

//Return To the Calling Page With a status Alert
header('Location: usrEditPayment.php?alert=Payment Method Deleted');
die;
?>