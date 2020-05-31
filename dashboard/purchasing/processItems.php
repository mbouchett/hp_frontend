<?php
//processItems.php 2018/01
//process changes made on item.php
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
  	
//Establish Variables
$recordCount=$_POST['recordcount'];
$vendor_ID=$_POST['vendor_ID'];
$item_ID=$_POST['item_ID'];
$sku=$_POST['sku'];
$oldsku=$_POST['oldsku'];
$desc=$_POST['desc'];
$dept=$_POST['dept'];
$pack=$_POST['pack'];
$cost=$_POST['cost'];
$retail=$_POST['retail'];
$reg=$_POST['reg'];
@$qty=$_POST['qty'];
$vnd=$_POST['vnd'];

/*	For Testing
for($i = 0; $i < $recordCount; $i++) {
	echo $item_ID[$i]."-".$sku[$i]."-".$desc[$i]."-".$dept[$i]."-".$pack[$i]."_".$cost[$i]."-".$retail[$i]."-[".$qty[$i]."]<br>"; 
}
*/

// Data Validation
for($i=0; $i<$recordCount; $i++){
	// Fix desc
	$desc[$i] = strip_tags($desc[$i]);
	$desc[$i] = str_replace('"','in',$desc[$i]);
	$desc[$i] = addslashes($desc[$i]);
	// Fix Null qty
	if(!$qty[$i]) $qty[$i] = 0;
	// Fix prices
	$cost[$i] = str_replace(',', '', $cost[$i]);
	$retail[$i] = str_replace(',', '', $retail[$i]);
	if(!$reg[$i]) $reg[$i] = 0;

}

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
for($i=0; $i<$recordCount; $i++){
	$sql = "UPDATE `".$db_db."`.`items`
			  SET `item_sku` = '".$sku[$i]."',
			   `vendor_ID` = '".$vnd[$i]."',
               `item_desc` = '".mysqli_real_escape_string($db,$desc[$i])."',
               `dept_ID` = '".$dept[$i]."',
		         `item_pack` = '".$pack[$i]."',
               `item_cost` = '".$cost[$i]."',
               `item_retail` = '".$retail[$i]."',
               `item_regPrice` = '".$reg[$i]."'
         WHERE `item_ID` = '".$item_ID[$i]."';";
	$result = mysqli_query($db, $sql); // create the query object
	// on update error
	if(!$result){
		echo "No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
}

//perform deletes
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$recordCount; $i++){
	if(trim($sku[$i])==""){
		/*
		$sql = "DELETE FROM `".$db_db."`.`items` WHERE `item_ID` = '".$item_ID[$i]."';";
		$result = mysqli_query($db, $sql); // create the query object
		if(!$result) {
			echo "Delete Item Failed";
			echo mysqli_error($db);
			die;
		}
		// delete item history
		$sql = "DELETE FROM `".$db_db."`.`items_hist` WHERE `item_ID` = '".$item_ID[$i]."';";
		$result = mysqli_query($db, $sql); // create the query object
		if(!$result) {
			echo "Delete History Failed";
			echo mysqli_error($db);
			die;
		}
		*/
		$sql = "UPDATE `".$db_db."`.`items`
				SET `item_sku` = '".$oldsku[$i]."',
				    `vendor_ID` = 1483 
	            WHERE `item_ID` = '".$item_ID[$i]."';";
		$result = mysqli_query($db, $sql); // create the query object
		// on update error
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
		
	}
}
mysqli_close($db);

header('location: items.php?vendor_ID='.$vendor_ID);
?>