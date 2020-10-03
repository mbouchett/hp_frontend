<?php
/* Contact form
	Mark/Francois Bouchett 2019
	viewCustOrders.php
*/

date_default_timezone_set('America/New_York');

@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/functions/f_resolve.php";

// ********** checks to see if the user is logged in **********

session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: ../dashboard.php');
    die;
  }

@$bc = "ffffff";
$filter = ($_REQUEST['filter']) ? $_REQUEST['filter'] : 0;

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
if($filter == 8) {
	$sql = 'SELECT * 
		    	FROM `web_order` 
		    	LEFT JOIN `web_cust` USING (`wc_ID`)
				ORDER BY `wo_status`';
			
}else {
	$sql = 'SELECT * 
		    	FROM `web_order` 
		    	LEFT JOIN `web_cust` USING (`wc_ID`)
				WHERE `wo_status`='.$filter.' 
				ORDER BY `wo_status`';
}
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
	$orderCount = mysqli_num_rows($result);
	mysqli_close($db); 
	//Store the Results To A Local Array
	for($i=0; $i<$orderCount; $i++){
		$order[$i] = mysqli_fetch_assoc($result);
		switch($order[$i]['wo_status']) {
			case 1:
				$order[$i]['stat'] = "Awaiting Items";
				$order[$i]['bc'] = "ebdb34";
				break;
			case 2:
				$order[$i]['stat'] = "Order Canceled";
				$order[$i]['bc'] = "eea4f5";
				break;
			case 3:
				$order[$i]['stat'] = "Items Awaiting Pickup";
				$order[$i]['bc'] = "a4f5e2";
				break;
			case 4:
				$order[$i]['stat'] = "Items Picked Up";
				$order[$i]['bc'] = "a4c8f5";
				break;
			case 5:
				$order[$i]['stat'] = "Order Shipped";
				$order[$i]['bc'] = "f2a4f5";
				break;
			case 6:
				$order[$i]['stat'] = "Payment Issue";
				$order[$i]['bc'] = "f5aca4";
				break;
			case 7:
				$order[$i]['stat'] = "Closed";
				$order[$i]['bc'] = "888888";
				break;
			default:
				$order[$i]['stat'] = "Order Placed";
				$order[$i]['bc'] = "ffff00";
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="SHORTCUT ICON" href="../images/icon.ico">
	<title>Homeport - Review Orders</title>
	<style type="text/css">
	a{
		text-decoration: none;	
	}
	</style>
</head>
<body>
	<a href="index.php">Exit</a>
   <div>Here's a list of your orders!</div>
   <hr>
   <table>
	  	<tr>
  			<td style="vertical-align: top; border-color: black;border-style: solid; border-width: 1px; padding: 4px;">
  				Filter By<br><br>
  				<a style="background-color: #ffff00; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=0">Placed</a><br><br>
  				<a style="background-color: #ebdb34; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=1">Awaiting Items</a><br><br>
  				<a style="background-color: #eea4f5; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=2">Canceled</a><br><br>
				<a style="background-color: #a4f5e2; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=3">Awaiting Pickup</a><br><br>
				<a style="background-color: #a4c8f5; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=4">Picked Up</a><br><br>
				<a style="background-color: #f2a4f5; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=5">Shipped</a><br><br>
				<a style="background-color: #f5aca4; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=6">Payment Issue</a><br><br>
				<a style="background-color: #888888; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=7">Closed</a><br><br>
				<a style="background-color: #95eb34; border-color: black;border-style: solid; border-width: 1px;" href="viewCustOrders.php?filter=8">Show All</a>
  			</td>
	  			<td style="vertical-align: top;">
				<table>
					<tr>
						<td>Order Number</td><td>Customer</td><td>Order Date</td><td>Status</td><td>Tracking#</td><td>Comment</td><td>Amt</td>
					</tr>       
					<!--Actual List begins Here-->				
					<?php for($i = 0; $i < $orderCount; $i++) { ?>
					<tr style="background-color: #<?= $order[$i]['bc'] ?>;">
						<td><a href="orderDetails.php?wo_ID=<?= $order[$i]['wo_ID'] ?>">HP-<?= str_pad($order[$i]['wo_ID'],7,0,STR_PAD_LEFT) ?></a></td>
						<td><a href="custDetails.php?wc_ID=<?= $order[$i]['wc_ID'] ?>"><?= $order[$i]['wc_fname'] ?> <?= $order[$i]['wc_lname'] ?></a></td>
						<td><?= substr($order[$i]['wo_date'],0,10) ?></td>
						<td><?= $order[$i]['stat'] ?></td>
						<td><?= $order[$i]['wo_tracking'] ?></td>
						<td><?= $order[$i]['wo_note'] ?></td>
						<td><?= number_format($order[$i]['wo_cc_charge'],2) ?></td>
					</tr> 
					<?php } ?>
				</table>
			</td>
		</tr>
	</table> 
	<a href="index.php">Exit</a>
</body>
</html>