<?php 
//vendor Number Fix
/*Takes the old vendor numbers from items and replaces it with the vendor_ID from vendors*/
include "/home/homeportonline/crc/2018.php";

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = 'SELECT `item_ID`,`vendors`.`vendor_ID` 
         FROM `items`
         LEFT JOIN `vendors` ON `items`.`vendor`=`vendors`.`number`';

$result = mysqli_query($db, $sql);		  
$num_results=mysqli_num_rows($result);
mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i]=mysqli_fetch_assoc($result);
}
$itemcount=count($items);

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$num_results; $i++){
	$vid=$items[$i]['vendor_ID'];
	$rec=$items[$i]['item_ID'];
	$sql  = 'UPDATE `items` SET `vendor_ID`='.$vid.' WHERE `items`.`item_ID`='.$rec; 
	//echo $vid."-".$rec."<br>";
	echo $sql."<br>";
	$result = mysqli_query($db, $sql);
}
mysqli_close($db);
?>