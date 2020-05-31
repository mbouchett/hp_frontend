<?php
//allpics.php 2018/07
// enter a vendor count by pic
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
  	
$vendor_ID = $_REQUEST['vendor_ID'];
if(!$vendor_ID) $vendor_ID = 516;

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$vendor_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);

if($result) {
	$vendor = mysqli_fetch_assoc($result);
}else{
	echo "Vendor Not Found";
	die;
}  	

// load vendor catalog into array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `items` 
		  LEFT JOIN `items_hist` USING (`item_ID`)
        LEFT JOIN `departments` USING (`dept_ID`)
		  WHERE `items`.`vendor_ID` = '.$vendor['vendor_ID']."
		  ORDER BY `dept_belongs_to`, `dept_ID`, `item_desc`";
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
	$items[$i]['ext'] = $items[$i]['item_cost'] * $items[$i]['item_tempOQ'];
	$totalOrder += $items[$i]['ext'];
}
	
$itemcount=count($items);
?>
<!DOCTYPE html>
<html>
<head>
<title>Mobile Count Pics</title>
</head>
<body>
<?php 
	for($i = 0; $i < $itemcount; $i++) { 
		$color = "ff0000";
		if($items[$i]['item_tempFL'] != NULL) $color = "0000ff";
		if($items[$i]['item_tempBS'] != NULL) $color = "ffff00";
		if($items[$i]['item_tempFL'] != NULL && $items[$i]['item_tempBS'] != NULL) $color = "00ff00";
?>
<a href="enterMobileCount.php?vendor_ID=<?= $vendor_ID ?>&place=<?= $i ?>">
	<img style="max-height: 200px; max-width: 200px; border: solid 5px #<?= $color ?>" src="<?= resolve($items[$i]['item_pic']) ?>" alt="<?= $items[$i]['item_desc'] ?>">
</a>
<?php } ?>
</body>
</html>