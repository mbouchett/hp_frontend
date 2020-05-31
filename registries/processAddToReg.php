<?php
//processAddToReg.php
//Mark Bouchett 2019
@include "/home/homeportonline/crc/2018.php";


$item = $_REQUEST[item];
@$back = ($_REQUEST['back']) ? $_REQUEST['back'] : 2;

// Is the user logged in?
if(isset($_COOKIE['c_ID'])) $loggedIn = 1; // Is a user logged in
if(!$loggedIn) {
	header('location: ../account/signIn.php?item='.$item.'&branch=reg');
	die;
}

// if item has already been added to the list
$user = $_COOKIE['c_ID'];
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_reg` WHERE `wc_ID`='.$user.' AND `item_ID`='.$item;
$result = mysqli_query($db, $sql);
$count = mysqli_num_rows($result);
mysqli_close($db);
if($count > 0) {
	header('location: manageRegItems.php');
	die;
}

// Add the Reg item
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`web_reg` 
		  (`wc_ID`, `item_ID`)
        VALUES ('$user', '$item')";
//perform action
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Register Product Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

header('location: manageRegItems.php');
die;
?>