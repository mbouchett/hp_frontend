<?php
//processAddToLikes.php
//Mark Bouchett 2019
@include "/home/homeportonline/crc/2018.php";


$item = $_REQUEST[item];
@$back = ($_REQUEST['back']) ? $_REQUEST['back'] : 2;

// Is the user logged in?
if(isset($_COOKIE['c_ID'])) $loggedIn = 1; // Is a user logged in
if(!$loggedIn) {
	header('location: signIn.php?item='.$item.'&branch=like');
	die;
}
$user = $_COOKIE['c_ID'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`web_likes` 
		  (`wc_ID`, `item_ID`)
        VALUES ('$user', '$item')";

//perform action
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Like Product Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

header('location: ../product.php?item='.$item.'&back='.$back);
die;
?>