<?php
//processRemWish.php
//Mark Bouchett 2019
@include "/home/homeportonline/crc/2018.php";


$id = $_REQUEST[id];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'DELETE FROM `'.$db_db.'`.`web_wish` WHERE `wish_ID`='.$id;
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "UN-Wish Error!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
header('location: manageWishItems.php');
die;
?>