<?php
//processUnLike.php
//Mark Bouchett 2019
@include "/home/homeportonline/crc/2018.php";

$item = $_REQUEST[item];
@$back = ($_REQUEST['back']) ? $_REQUEST['back'] : 2;

// Is the user logged in?
$user = $_COOKIE['c_ID'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'DELETE FROM `'.$db_db.'`.`web_likes` WHERE `wc_ID`='.$user.' AND `item_ID`='.$item;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "UN-Like Error!<br>";
	echo $sql." - ".$i."<br>";
	echo mysqli_error($db);
	die;
}

header('location: ../product.php?item='.$item.'&back='.$back);
die;
?>