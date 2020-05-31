<?php 
//vendor Number Fix
/*Takes the old department numbers from items and replaces it with the dept_ID from departments*/
include "/home/homeportonline/crc/2018.php";

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = 'SELECT `items`.`item_ID`, `departments`.`dept_ID` 
         FROM `items`
         LEFT JOIN `departments` on `items`.`oldDep` = `departments`.`oldDep`';

$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Error";
	die;
}		  
$num_results=mysqli_num_rows($result);
mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i]=mysqli_fetch_assoc($result);
}
$itemcount=count($items);
//echo $itemcount;

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$num_results; $i++){
	$dep=$items[$i]['dept_ID'];
	$rec=$items[$i]['item_ID'];
	$sql  = 'UPDATE `items` SET `dept_ID`='.$dep.' WHERE `items`.`item_ID`='.$rec; 
	//echo $vid."-".$rec."<br>";
	echo $sql."<br>";
	$result = mysqli_query($db, $sql);
}
mysqli_close($db);

?>