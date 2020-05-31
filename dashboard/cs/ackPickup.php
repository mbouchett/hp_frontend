<?php
//whPickup.php 2018/01
// initiates a pickup request
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

$pu_ID = $_REQUEST['pu_ID'];
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
$sql = "UPDATE `".$db_db."`.`pickups` SET `pu_confirmed`=1 WHERE `pu_ID`=".$pu_ID;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: pickup.php?pu_ID='.$pu_ID);
die;
?>