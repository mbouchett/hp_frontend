<?php
//repViewOrder.php 2018/01
// rep version of an order
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');


$order_ID = $_REQUEST['order_ID'];
$order_ID = substr($order_ID,0,7);
$sort =$_REQUEST['sort'];

$today = date("F d, Y");

//load order
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `orders` WHERE `order_ID`=".$order_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);
if($result) {
	$order = mysqli_fetch_assoc($result);//Get The Record
}else{
	echo "Order Not Found";
	die;
}

// load order items
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * 
		  FROM `order_items`
		  LEFT JOIN `items` ON `order_items`.`item_ID`=`items`.`item_ID`
		  WHERE `order_items`.`order_ID`=".$order_ID;
if($sort == 'sku') {
$sql = "SELECT * 
		  FROM `order_items`
		  LEFT JOIN `items` ON `order_items`.`item_ID`=`items`.`item_ID`
		  WHERE `order_items`.`order_ID`=".$order_ID." 
		  ORDER BY `item_sku`";	
}
if($sort == 'desc') {
$sql = "SELECT * 
		  FROM `order_items`
		  LEFT JOIN `items` ON `order_items`.`item_ID`=`items`.`item_ID`
		  WHERE `order_items`.`order_ID`=".$order_ID. "
		  ORDER BY `item_desc`";	
}
$result = mysqli_query($db, $sql);	
$num_results=mysqli_num_rows($result);	  
//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
	$items[$i]['ext'] = ($items[$i]['item_cost'] * $items[$i]['oi_qty']) * ((100 - $order['order_discount'])/100);
	$totalOrder += $items[$i]['ext'];
}

$itemcount=count($items);

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$items[0]['vendor_ID'];
$result = mysqli_query($db, $sql);          //Initiate The Query
mysqli_close($db);                          //Close The Connection

if($result) {
	$vendor = mysqli_fetch_assoc($result);//Get The Record
}else{
	echo "Vendor Not Found";
	die;
}

$pages=ceil($itemcount/25);
$page=1;

$po = $order_ID.$order['order_by'];
if($order['order_offCycle'] == 1) $po = $po."X";
?>
<!DOCTYPE html>
<html>
<head>
	<meta/>
	<title><?= $vendor['vendor_name'] ?> Order Preview</title>
	<link href="css/viewOrder.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<!-- Order Header -->
	<table class="order">
		<tr><td>Purchase Order# <?= $po ?><br>Order Date: <?= $today ?></td><td></td><td>Page <?= $page ?> of  <?= $pages ?></td></tr>	
		<tr><td colspan="3" height="1" bgcolor="#767676"></td></tr>
		<tr>
			<td>From:</td>
			<td rowspan="8"><?php if($vendor['vendor_hti'] == 1){ ?><img src="../images/hti.jpg" alt="HTI" height="125px" /> <?php } ?></td>
			<td>For:</td>
		</tr>
		<tr>
			<td><b><span style="font-family: Arial; font-size: 24px"><a href="sentOrders.php" style="text-decoration: none; color: #000000">Homeport</a></span></b></td>
			<td><span style="font-size: 16px; font-weight: bold; background-color: #FFFF33; font-family: Arial"><?= $vendor['vendor_name'] ?> (<?= $vendor['vendor_rep'] ?>)</span></td>
		</tr>
		<tr><td>52 Church Street</td><td><?= $vendor['vendor_addr1'] ?></td></tr>
		<tr><td>Burlington, VT 05401</td><td><?= $vendor['vendor_addr2'] ?></td></tr>
		<tr><td></td><td><?= $vendor['vendor_addr3'] ?></td></tr>
		<tr><td>email: home@homeportonline.com</td><td><?= $vendor['vendor_email'] ?></td></tr>
		<tr><td>v(802) 863-4832, f(802) 660-0523</td><td>v.<?= $vendor['vendor_voice'] ?> - f.<?= $vendor['vendor_fax'] ?></td></tr>
		<tr><td colspan="3"><hr /></td></tr>
	</table>
	
	<!-- Order Terms -->	
	<table class="terms">
		<tr><td>Order Discount: %<?= $order['order_discount'] ?></td><td class="button"></td></tr>	
		<tr><td>Order Ship Date: <?= $order['order_shipDate'] ?></td><td class="button"></td></tr>
		<tr><td>Freight: <?= $order['order_frgt01'] ?></td><td class="button"></td></tr>
		<tr><td>Order Terms: <?= $order['order_frgt02'] ?></td><td class="button"></td></tr>
		<tr><td>Order Comments: <?= $order['order_comments'] ?></td><td class="button"></td></tr>
		<tr><td colspan="2">Please Email Invoices To: homeportap@gmail.com</td></tr>
		<tr><td colspan="2"><hr /></td></tr>
	</table>	
	
	<!-- Order Items -->
	<table class="order">
		<tr><td>Order</td><td><a href="repViewOrder.php?order_ID=<?= $order_ID ?>&sort=sku" >Sku</a></td><td><a href="repViewOrder.php?order_ID=<?= $order_ID ?>&sort=desc" >Description</a></td><td style="text-align: right;">Cost</td><td style="text-align: right;">Extension</td></tr>
		<tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
		<?php for($i = 0; $i < $itemcount; $i++) { ?>
		<tr>
			<td class="items" style="width: 30px;"><?= $items[$i]['oi_qty'] ?></td>
			<td class="items"><?= $items[$i]['item_sku'] ?><input type="hidden" name="ID[<?= $i ?>]" value="<?= $items[$i]['item_ID'] ?>"></td>
			<td class="items"><?= $items[$i]['item_desc'] ?></td>
			<td class="items" style="text-align: right;"><?= number_format($items[$i]['item_cost'],2) ?></td>
			<td class="items" style="text-align: right;"><?= number_format($items[$i]['ext'],2) ?></td>
		</tr>
		<tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
	<?php if($i > 0 && $i % 25 == 0) { $page++?>
	</table>
	<p class="breakhere">
	<!-- Order Header -->
	<table class="order">
		<tr><td>Purchase Order# <?= $po ?><br>Order Date: <?= $today ?></td><td></td><td>Page <?= $page ?> of  <?= $pages ?></td></tr>	
		<tr><td colspan="3" height="1" bgcolor="#767676"></td></tr>
		<tr>
			<td>From:</td>
			<td rowspan="8"><?php if($vendor['vendor_hti'] == 1){ ?><img src="../images/hti.jpg" alt="HTI" height="125px" /> <?php } ?></td>
			<td>For:</td>
		</tr>
		<tr>
			<td><b><span style="font-family: Arial; font-size: 24px"><a href="sentOrders.php" style="text-decoration: none; color: #000000">Homeport</a></span></b></td>
			<td><span style="font-size: 16px; font-weight: bold; background-color: #FFFF33; font-family: Arial"><?= $vendor['vendor_name'] ?> (<?= $vendor['vendor_rep'] ?>)</span></td>
		</tr>
		<tr><td>52 Church Street</td><td><?= $vendor['vendor_addr1'] ?></td></tr>
		<tr><td>Burlington, VT 05401</td><td><?= $vendor['vendor_addr2'] ?></td></tr>
		<tr><td></td><td><?= $vendor['vendor_addr3'] ?></td></tr>
		<tr><td>email: <?= $selfmail ?></td><td><?= $emaillink ?></td></tr>
		<tr><td>v(802) 863-4832, f(802) 660-0523</td><td>v.<?= $vendor['vendor_voice'] ?> - f.<?= $vendor['vendor_fax'] ?></td></tr>
		<tr><td colspan="3"><hr /></td></tr>
	</table>
	<!-- Order Terms -->	
	<table class="terms">
		<tr><td>Order Discount: %<?= $order['order_discount'] ?></td><td></td></tr>	
		<tr><td>Order Ship Date: <?= $order['order_shipDate'] ?></td><td></td></tr>
		<tr><td>Freight: <?= $order['order_frgt01'] ?></td><td></td></tr>
		<tr><td>Order Terms: <?= $order['order_frgt02'] ?></td><td></td></tr>
		<tr><td>Order Comments: <?= $order['order_comments'] ?></td><td></td></tr>
		<tr><td colspan="2"><hr /></td></tr>
	</table>
	<table class="order">
		<tr><td>Order</td><td>Sku</td><td>Description</td><td>Cost</td><td>Extension</td></tr>
		<tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
	<?php } } ?>
	</table>
	<br />
	<table class="order">
	    <tr class="print">
	        <td align="right">Order Total <?= number_format($totalOrder,2) ?></td>
	    </tr>
	</table>
	</div>
	<script defer="defer" type="text/javascript" src="js/viewOrder.js"></script>	
</body>
</html>