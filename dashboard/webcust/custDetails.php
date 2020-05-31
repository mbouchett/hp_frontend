<?php
/* Contact form
	Mark/Francois Bouchett 2019
	custDetails.php
*/

date_default_timezone_set('America/New_York');

@include "/home/homeportonline/crc/2018.php";

// ********** checks to see if the user is logged in **********

session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: ../dashboard.php');
    die;
  }

@$alert = $_REQUEST['alert'];
@$wc_ID = $_REQUEST['wc_ID'];

// ********************* get customer info ********************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
	    	FROM `web_cust` 
			WHERE `wc_ID`='.$wc_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db); 
$cust = mysqli_fetch_assoc($result);

// ************************ get orders ************************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
	    	FROM `web_order` 
			WHERE `wc_ID` = '.$wc_ID."
			ORDER BY `wo_date` DESC";
$result = mysqli_query($db, $sql);
$orderCount = mysqli_num_rows($result);
mysqli_close($db); 
//Store the Results To A Local Array
for($i=0; $i<$orderCount; $i++){
	$order[$i] = mysqli_fetch_assoc($result);
	switch($order[$i]['wo_status']) {
		case 1:
			$order[$i]['stat'] = "Awaiting Items";
			break;
		case 2:
			$order[$i]['stat'] = "Order Canceled";
			break;
		case 3:
			$order[$i]['stat'] = "Items Awaiting Pickup";
			break;
		case 4:
			$order[$i]['stat'] = "Items Picked Up";
			break;
		case 5:
			$order[$i]['stat'] = "Order Shipped";
			break;
		case 6:
			$order[$i]['stat'] = "Payment Issue";
			break;
		default:
			$order[$i]['stat'] = "Order Placed";
	}
}

// ************************ get Wishes ************************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, `items`.`item_retail`, `items`.`item_pic`, 
               `web_wish`.`wish_ID`,`web_wish`.`wish_qty`, `web_wish`.`wish_fund`, `web_wish`.`wish_fundAmt` 
        FROM `web_wish` 
        LEFT JOIN `items` USING (`item_ID`) 
        WHERE `wc_ID`='.$wc_ID.'
        ORDER BY `wish_ID` DESC';
$result = mysqli_query($db, $sql);  
if(!$result){
	echo "Update No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
if($result) {    	
	$wwCount = mysqli_num_rows($result);  
	for($i = 0;$i < $wwCount; $i++) {
		$ww[$i] = mysqli_fetch_assoc($result);
		$ww[$i]['percent'] = ceil(($ww[$i]['wish_fundAmt'] / $ww[$i]['item_retail']) * 100);
	}
}
mysqli_close($db);

// ************************ get Likes ************************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, `items`.`item_retail`, `items`.`item_pic`, 
               `web_likes`.`wl_ID` 
        FROM `web_likes` 
        LEFT JOIN `items` USING (`item_ID`) 
        WHERE `wc_ID`='.$wc_ID.'
        ORDER BY `wl_ID` DESC';
$result = mysqli_query($db, $sql);  
if(!$result){
	echo "Update No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
if($result) {    	
	$wlCount = mysqli_num_rows($result);  
	for($i = 0;$i < $wlCount; $i++) {
		$wl[$i] = mysqli_fetch_assoc($result);
	}
}
mysqli_close($db);

// ********************** get reg items ***********************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, `items`.`item_retail`, `items`.`item_pic`, 
               `web_reg`.`reg_ID` 
        FROM `web_reg` 
        LEFT JOIN `items` USING (`item_ID`) 
        WHERE `wc_ID`='.$wc_ID.'
        ORDER BY `reg_ID` DESC';
$result = mysqli_query($db, $sql);  
if(!$result){
	echo "Update No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
if($result) {    	
	$wrCount = mysqli_num_rows($result);  
	for($i = 0;$i < $wrCount; $i++) {
		$wr[$i] = mysqli_fetch_assoc($result);
	}
}
mysqli_close($db);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="SHORTCUT ICON" href="../images/icon.ico">
	<title>Homeport - Customer Details</title>
	<style type="text/css">
		td{
			border-style: solid;
			border-width: 1px;
			border-color: black;
		}
	</style>
</head>
<body>
	- <?= $cust['wc_acct_created'] ?> -<br>
	Customer: <?= $cust['wc_fname'] ?> <?= $cust['wc_lname'] ?><br>
	Email: <?= $cust['wc_email'] ?> Phone: <?= $cust['wc_phone'] ?><br>
	<table>
		<tr><td>Orders</td><td>Wish Lists</td><td>Liked Items</td><td>Registry items</td></tr>
		<tr>
			<td>
				<?php for($i=0; $i<$orderCount; $i++){ ?>
				<a href="orderDetails.php?wo_ID=<?= $order[$i]['wo_ID'] ?>">HP-<?= str_pad($order[$i]['wo_ID'],7,0,STR_PAD_LEFT) ?></a> -> 
				<?= substr($order[$i]['wo_date'],0,10) ?>: 
				<?= $order[$i]['stat'] ?>: 			
				<br>
				<?php } ?>			
			</td>	
			<td>
				<?php for($i = 0;$i < $wwCount; $i++) { ?>
				<a class="desclink" href="../../product.php?item=<?= $ww[$i]['item_ID'] ?>"><?= $ww[$i]['item_desc'] ?></a><br>
				<?php } ?>			
			</td>	
			<td>
				<?php for($i = 0;$i < $wlCount; $i++) { ?>
				<a class="desclink" href="../../product.php?item=<?= $wl[$i]['item_ID'] ?>"><?= $wl[$i]['item_desc'] ?></a><br>
				<?php } ?>			
			</td>
			<td>
				<?php for($i = 0;$i < $wrCount; $i++) { ?>
				<a class="desclink" href="../../product.php?item=<?= $wr[$i]['item_ID'] ?>"><?= $wr[$i]['item_desc'] ?></a><br>
				<?php } ?>			
			</td>
		</tr>
	</table>
</body>
</html>