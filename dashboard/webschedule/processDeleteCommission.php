<?php
// processDeleteCommissions.php
// mark bouchett 04/19/2019
date_default_timezone_set('America/New_York');
include "/home/homeportonline/crc/2018.php";

$com_ID = $_REQUEST['com_ID'];
$now = date('Y-m-d h:i');

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `".$db_db."`.`com` WHERE `com_ID` = '".$com_ID."';";
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Delete Error!<br>";
	echo $sql." - ".$i."<br>";
	echo mysqli_error($db);
	die;
}	
	
mysqli_close($db);
header('location: enterCommissions.php?alert=Commission Deleted: '.$now);
die;
?>