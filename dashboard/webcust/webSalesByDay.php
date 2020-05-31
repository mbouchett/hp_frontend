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
  
$offset = ($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
$d = date('Y-m-d'); 
$os = ' '.$offset.' days';
$date = date('Y-m-d', strtotime($d.$os));
$dateEnd = date('Y-m-d', strtotime($date.' +1 days'));

@$bc = "ffffff";

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
	    	FROM `web_order` 
	    	LEFT JOIN `web_cust` USING (`wc_ID`)
	    	WHERE `wo_date` BETWEEN "'.$date.'" AND "'.$dateEnd.'"';
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
				$order[$i]['bc'] = "ffffff";
				break;
			case 2:
				$order[$i]['stat'] = "Order Canceled";
				$order[$i]['bc'] = "ffffff";
				break;
			case 3:
				$order[$i]['stat'] = "Items Awaiting Pickup";
				$order[$i]['bc'] = "ffffff";
				break;
			case 4:
				$order[$i]['stat'] = "Items Picked Up";
				$order[$i]['bc'] = "ffffff";
				break;
			case 5:
				$order[$i]['stat'] = "Order Shipped";
				$order[$i]['bc'] = "ffffff";
				break;
			case 6:
				$order[$i]['stat'] = "Payment Issue";
				$order[$i]['bc'] = "ffffff";
				break;
			case 7:
				$order[$i]['stat'] = "Closed";
				$order[$i]['bc'] = "888888";
				break;
			default:
				$order[$i]['stat'] = "Order Placed";
				$order[$i]['bc'] = "ffff00";
		}
		$total += $order[$i]['wo_cc_charge']; 
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Homeport - Web Sales By Day <?= $date ?></title>
</head>
<body>
    <div id="container">
        <div>Here's a list of your orders!</div>
        <hr>
        <a href="webSalesByDay.php?offset=<?= $offset - 1 ?>" ><--</a> <?= $date ?> <a href="webSalesByDay.php?offset=<?= $offset + 1 ?>" >--></a>
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
				<td style="text-align: right"><?= number_format($order[$i]['wo_cc_charge'],2) ?></td>
			</tr> 
			<?php } ?>
			<tr><td colspan="7" style="text-align: right"><?= $orderCount ?> - <?=  number_format($total,2) ?></td></tr>
        </table>
        <div class="bottomlinks">     
            <a href="index.php">Exit</a>
        </div>
    </div>
</body>
</html>