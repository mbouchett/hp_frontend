<?php  
	//dashboard.php 2020/10
	/*Makes Sure that Item and Item histories align*/
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
  	include "/home/homeportonline/crc/2018.php";
  	
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = 'SELECT `item_ID` FROM `items_hist`';  	
$result = mysqli_query($db, $sql);		  
$itemcount=mysqli_num_rows($result);

//Store the Results To A Local Array
for($i=0; $i<$itemcount; $i++){
	$items[$i]=mysqli_fetch_assoc($result);
}
mysqli_close($db);
echo "Item Hist Count: ".$itemcount;
echo "<hr>";

$db = new mysqli('localhost', $db_user, $db_pw, $db_db); 
for($i=0; $i<$itemcount; $i++){ 
	$sql  = 'SELECT *  FROM `items` WHERE `item_ID`='.$items[$i]['item_ID'];
	$result = mysqli_query($db, $sql);	
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}	  
	$count = mysqli_num_rows($result);
	if($count < 1) {
		echo "Unmatched History: ".$items[$i]['item_ID'].'<br>';
		$xb= new mysqli('localhost', $db_user, $db_pw, $db_db);
		$xql = "DELETE FROM `items_hist` WHERE `item_ID` = ".$items[$i]['item_ID'];
		$result = mysqli_query($xb, $xql);
		if(!$result) {
	   	echo "Database Query Failed<br>";
	   	echo $sql."<br>";
			mysqli_error($xb);
		 	die;
		}
		mysqli_close($xb); //close the connection
	}
}
mysqli_close($db);
die;
?>