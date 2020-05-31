<?php
//processDelLayItem.php 2018/01
// Deletes a layaway item
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$li_ID = $_REQUEST['li_ID'];
$layaway_ID = $_REQUEST['layaway_ID'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `layItems` WHERE `li_ID`=".$li_ID;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Delete Layaway Item Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('Location: layaway.php?layaway_ID='.$layaway_ID);
die;
?>