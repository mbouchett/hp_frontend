<?php
//processfundRItem.php

@include "/home/homeportonline/crc/2018.php";


$id = $_REQUEST['id'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'UPDATE `'.$db_db.'`.`web_reg` SET `reg_fund`=0 WHERE `reg_ID`='.$id;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Fund No Good!<br>";
	echo $sql." - ".$i."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('location: manageRegItems.php');
die;
?>