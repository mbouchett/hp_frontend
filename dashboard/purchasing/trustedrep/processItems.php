<?php
//processItems.php 2018/01
//process changes made on item.php
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['repnum'])){
		header('Location: index.php');
		die;
  	}
  	
//Establish Variables
$multiplier = $POST['multiplier'];
$recordCount=$_POST['recordcount'];
$vendor_ID=$_POST['vendor_ID'];
$item_ID=$_POST['item_ID'];
$sku=$_POST['sku'];
$desc=$_POST['desc'];
$pack=$_POST['pack'];
$cost=$_POST['cost'];

$now = date("F j, Y, g:i a");

/*	For Testing
for($i = 0; $i < $recordCount; $i++) {
	echo $item_ID[$i]."-".$sku[$i]."-".$desc[$i]."-".$pack[$i]."-".$cost[$i]."-".$retail[$i]."<br>"; 
}

exit;
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
//perform the items update
for($i=0; $i<$recordCount; $i++){
	$sql = "UPDATE `".$db_db."`.`items`
			  SET `item_sku` = '".$sku[$i]."',
               `item_desc` = '".mysqli_real_escape_string($db,$desc[$i])."',
		         `item_pack` = '".$pack[$i]."',
               `item_cost` = '".$cost[$i]."'
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
//perform the Rep Edit update
$sql = "UPDATE `".$db_db."`.`vendors` 
		  SET `vendor_tredit` = '".$now."' 
		  WHERE `vendor_ID` = '".$vendor_ID."';";
$result = mysqli_query($db, $sql); // create the query object
if(!$result){
	echo "No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

header('location: items.php?vendor_ID='.$vendor_ID);
?>