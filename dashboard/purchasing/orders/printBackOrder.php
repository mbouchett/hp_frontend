<?php
//printBackOrder.php 2018/01
// enter a vendor count worksheet
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$order_ID = $_REQUEST['order_ID'];
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

// Update the order as checkin printed
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `order_status` = 3
        WHERE `orders`.`order_ID` = ".$order_ID.";";
$result = mysqli_query($db, $sql);
mysqli_close($db); //close the connection

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
		  LEFT JOIN `items` USING (`item_ID`) 
		  LEFT JOIN `departments` USING (`dept_ID`) 
		  WHERE `order_items`.`order_ID`=".$order_ID." 
		  AND `order_items`.`oi_received` IS NULL";
$result = mysqli_query($db, $sql);	
$num_results=mysqli_num_rows($result);	  
//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
	$total += $items[$i]['oi_qty'];
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
$line=0;

//Open wantlist Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT *
        FROM `cust_items`
        LEFT JOIN `customers` USING (`cust_ID`)
        WHERE `vendor_ID`='.$vendor['vendor_ID'];
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
    echo "Search No Good!<br>";
    echo $sql."<br>";
    echo mysqli_error($db);
    die;
}
$wantcount=mysqli_num_rows($result);
mysqli_close($db);
$ii = 0;
for($i = 0; $i < $wantcount; $i++){
    $row=mysqli_fetch_assoc($result);
    if(!$row['ci_location']){
        $wants[$ii] =  $row;
        $ii = $ii+1;
    }
}
$wantcount=count($wants);

$po = $order_ID.$order['order_by'];
if($order['order_offCycle'] == 1) $po = $po."X";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Print <?= $vendor['vendor_name'] ?> Checkin</title>
  <link href="css/viewOrder.css" rel="stylesheet" type="text/css" />
</head>
<body >
	<!-- Order Header -->
	<table class="order">
		<tr><td>Purchase Order# <?= $po ?><br>Order Date: <?= $order['order_date'] ?></td><td></td><td>Page <?= $page ?> of  <?= $pages ?></td></tr>	
		<?php if($order['order_akn']){ ?><td colspan="2" title="<?= $order['order_akn'] ?>"><span style="color: #23A923; font-weight: bold">Acknowledged</span></td><?php } ?>
		<tr><td colspan="3" height="1" bgcolor="#767676"></td></tr>
		<tr>
			<td>From:</td>
			<td rowspan="8"><?php if($vendor['vendor_hti'] == 1){ ?><img src="../images/hti.jpg" alt="HTI" height="125px" /> <?php } ?></td>
			<td>For:</td>
		</tr>
		<tr>
			<td><b><span style="font-family: Arial; font-size: 24px"><a href="sentOrders.php" style="text-decoration: none; color: #000000">Homeport</a></span></b></td>
			<td><span style="font-size: 16px; font-weight: bold; background-color: #33AFF2; font-family: Arial"><?= $vendor['vendor_name'] ?> (<?= $vendor['vendor_rep'] ?>)</span></td>
		</tr>
		<tr><td>52 Church Street</td><td><?= $vendor['vendor_addr1'] ?></td></tr>
		<tr><td>Burlington, VT 05401</td><td><?= $vendor['vendor_addr2'] ?></td></tr>
		<tr><td></td><td><?= $vendor['vendor_addr3'] ?></td></tr>
		<tr><td>email: <?= $useremail ?></td><td><?= $vendor['vendor_email'] ?></td></tr>
		<tr><td>v(802) 863-4832, f(802) 660-0523</td><td>v.<?= $vendor['vendor_voice'] ?> - f.<?= $vendor['vendor_fax'] ?></td></tr>
		<tr><td colspan="3"><hr /></td></tr>
	</table>

<?php if($wantcount > 0 && !$message){ ?>
<table class="wantlist">
    <tr>
        <td colspan="4" style="font-weight: bold;" >
        There Are <?= $wantcount ?> Wantlists Associated With This Vendor
        </td>
    </tr>
        <?php for($i=0; $i< $wantcount; $i++){ ?>
    <tr>
        <td><?= $wants[$i]['ci_qty'] ?></td>
        <td><?= $wants[$i]['ci_sku'] ?></td>
        <td><?= $wants[$i]['ci_desc'] ?></td>
        <td><?= $wants[$i]['cust_name'] ?></td>
    </tr>
        <?php } ?>
</table>
<?php } ?>

	<!-- Order Items -->
	<table class="order">
		<tr><td>Received</td><td>Qty</td><td>Sku</td><td>Description</td><td>Cat</td><td style="text-align: right;">Retail</td></tr>
		<tr><td colspan="6" height="1" bgcolor="#767676"></td></tr>
		<?php for($i = 0; $i < $itemcount; $i++) { ?>
		<tr>
			<td class="items" style="width: 100px;"></td>
			<td class="items" style="width: 30px;"><?= $items[$i]['oi_qty'] ?></td>
			<td class="items"><?= $items[$i]['item_sku'] ?></td>
			<td class="items"><?= $items[$i]['item_desc'] ?></td>
			<td class="items">
	            <?php if($items[$i]['dept_belongs_to'] == $items[$i]['dept_ID']) { ?>
				<td class="items"><?= $items[$i]['dept_belongs_to'] ?></td>
	            <?php }else{ ?>
				<td class="items"><?= $items[$i]['dept_belongs_to'] ?>-<?= $items[$i]['dept_ID'] ?></td>
	            <?php } ?>			
			</td>
			<td class="items" style="text-align: right;"><?= number_format($items[$i]['item_retail'],2) ?></td>
		</tr>
		<tr><td colspan="6" height="1" bgcolor="#767676"></td></tr>
	<?php if($i > 0 && $i % 25 == 0) { $page++?>
	</table>
	<p class="breakhere">
	<!-- Order Header -->
	<table class="order">
		<tr><td>Purchase Order# <?= $po ?><br>Order Date: <?= $order['order_date'] ?></td><td></td><td>Page <?= $page ?> of  <?= $pages ?></td></tr>	
		<?php if($order['order_akn']){ ?><td colspan="2" title="<?= $order['order_akn'] ?>"><span style="color: #23A923; font-weight: bold">Acknowledged</span></td><?php } ?>
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
		<tr><td>email: <?= $useremail ?></td><td><?= $vendor['vendor_email'] ?></td></tr>
		<tr><td>v(802) 863-4832, f(802) 660-0523</td><td>v.<?= $vendor['vendor_voice'] ?> - f.<?= $vendor['vendor_fax'] ?></td></tr>
		<tr><td colspan="3"><hr /></td></tr>
	</table>
	<table class="order">
		<tr><td>Order</td><td>Sku</td><td>Description</td><td>Cost</td><td>Extension</td></tr>
		<tr><td colspan="6" height="1" bgcolor="#767676"></td></tr>
	<?php } } ?>
	</table>
	<br />
<table class="order">
    <tr>
        <td>Checked In By:</td><td>Approved By:</td><td>Date:</td><td align="right">Total Items <?= $total ?></td>
    </tr>
	<tr>
	<td colspan="4">
    <div style="margin-left: 120px">
    -------------------------------------------------------------------------------------------------------------------------<br />
    [ ] I put the wantlist items on hold and updated Customer Service&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ ] I attached the packing list<br />
    [ ] I put the items on the shelf and backstocked the extra<br />
    (Yes) (No) I attached an Exception Report &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Yes) (No) I created a Backorder<br />
    -------------------------------------------------------------------------------------------------------------------------
    </div>
    </td>
    </tr>
</table>    
</body>
</html>