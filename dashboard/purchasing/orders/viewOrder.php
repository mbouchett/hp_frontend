<?php
//viewOrder.php 2018/01
// enter a vendor count worksheet
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$order_ID = $_REQUEST['order_ID'];

$today = date("F d, Y");
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

unset($emailsuccess);
@$emailsuccess = $_REQUEST['success'];

$selfmail='<a href="emailOrder.php?po='.$order_ID.'&email='.$useremail.'" title="Click Here To Email This Order To Yourself" style="text-decoration: none; color: #000000">'.$useremail.'</a>';
if(@$selfsuccess){
    $selfmail='<a href="emailOrder.php?po='.$order_ID.'&email='.$useremail.'" title="Click Here To Email This Order To Yourself" style="text-decoration: none; color: #000000"><small>'.$useremail.'</small></a><small> (Email Successful)</small>';
}

//load order
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `orders` WHERE `order_ID`=".$order_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);
if($result) {
	$order = mysqli_fetch_assoc($result);//Get The Record
}else{
	echo "Problem Loading Order<br>";
   echo $sql."<br>";
   echo mysqli_error($db);
   die;
}

// load order items
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * 
		  FROM `order_items`
		  LEFT JOIN `items` USING (`item_ID`) 
		  LEFT JOIN `departments` USING (`dept_ID`) 
		  WHERE `order_items`.`order_ID`=".$order_ID. "  
		  ORDER BY `dept_belongs_to`,`dept_ID`";
$result = mysqli_query($db, $sql);	
if($result) {
	$num_results=mysqli_num_rows($result);	  
	//Store the Results To A Local Array
	for($i=0; $i<$num_results; $i++){
		$items[$i] = mysqli_fetch_assoc($result);
		$items[$i]['ext'] = ($items[$i]['item_cost'] * $items[$i]['oi_qty']) * ((100 - $order['order_discount'])/100);
		@$totalOrder += $items[$i]['ext'];
	}
	$itemcount=count($items);
}else {
	echo "Order Not Found...";
	die;
}

// save order total
$sql = "UPDATE `".$db_db."`.`orders`
    SET `order_total` = '".$totalOrder."'
    WHERE `order_ID` = '".$order_ID."';";
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Order Total Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$order['vendor_ID'];
$result = mysqli_query($db, $sql);
mysqli_close($db);

if($result) {
	$vendor = mysqli_fetch_assoc($result);//Get The Record
}else{
	header('Location: sentOrders.php?alert=Order Not Found');
	echo "Problem Loading Order<br>";
   	echo $sql."<br>";
   	echo mysqli_error($db);
   	die;
}

// parse out category breakdown
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $result = mysqli_query($db, "SELECT * FROM departments ORDER BY dept_ID");
    $depCount=mysqli_num_rows($result);
    mysqli_close($db);
    for($i=0; $i<$depCount; $i++){
      $deps[$i]=mysqli_fetch_assoc($result);
    }
//Create root categories
$ii = 0;
for($i=0; $i<$depCount; $i++){
	 if($deps[$i]['dept_ID'] == $deps[$i]['dept_belongs_to']) {
	 	$rDeps[$ii]['dept_ID'] = $deps[$i]['dept_ID'];
	 	$rDeps[$ii]['dept_name'] = $deps[$i]['dept_name'];
	 	$rDeps[$ii]['total'] = 0;
	 	$ii++;
	 }
}

$rDepCount = count($rDeps);

for($i=0; $i<$rDepCount; $i++){
	for($ii=0; $ii < $itemcount; $ii++){
		if($rDeps[$i]['dept_ID'] == $items[$ii]['dept_belongs_to']){
			@$rDeps[$i]['total'] =  $rDeps[$i]['total'] + ($items[$ii]['item_cost'] * $items[$ii]['oi_qty']*((100-$order['discount'])/100));
		}
   }
}

$pages=ceil($itemcount/24);
$page=1;

unset($emaillink);
if($vendor['vendor_email']){
    $emaillink='<a href="emailOrder.php?po='.$order_ID.'&email='.$vendor['vendor_email'].'" title="Click Here To Email This Order To The Rep" style="text-decoration: none; color: #000000">'.$vendor['vendor_email'].'</a>';
}
if($emailsuccess){
    $emaillink='<a href="emailOrder.php?po='.$order_ID.'&email='.$vendor['vendor_email'].'" title="Click Here To Email This Order To The Rep" style="text-decoration: none; color: #000000"><small>'.$vendor['vendor_email'].'</small></a><small> (Email Successful)</small>';
}

$po = $order_ID.$order['order_by'];
if($order['order_offCycle'] == 1) $po = $po."X";
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $vendor['vendor_name'] ?> Order</title>
	<link href="css/viewOrder.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/printOrder.css" rel="stylesheet" type="text/css" media="print" />
</head>
<body>
	<!-- Order Header -->
	<table class="order">
		<tr><td>Purchase Order# <?= $po ?><br>Order Date: <?= $order['order_date'] ?></td><td></td><td style="text-align: right;">Page <?= $page ?> of  <?= $pages ?></td></tr>
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
		<tr><td>email: <?= $selfmail ?></td><td><?= $emaillink ?></td></tr>
		<tr><td>v(802) 863-4832, f(802) 660-0523</td><td>v.<?= $vendor['vendor_voice'] ?> - f.<?= $vendor['vendor_fax'] ?></td></tr>
		<tr><td colspan="3"><hr /></td></tr>
	</table>
	
	<form action="processViewOrder.php" method="post">
	<!-- Order Terms -->	
	<table class="terms">
		<tr><td>Order Discount: %<input type="text" name="disc" value="<?= $order['order_discount'] ?>"> </td><td class="button"><button>Save</button></td></tr>	
		<tr><td>Order Ship Date: <input type="text" name="shipDate" value="<?= $order['order_shipDate'] ?>"></td><td class="button"><button onclick="return checkIn(<?= $order_ID ?>);">Check In</button></td></tr>
		<tr><td>Freight:<input type="text" name="frgt01" value="<?= $order['order_frgt01'] ?>"> </td><td class="button"><button onclick="return bo(<?= $order_ID ?>);">B/O</button></td></tr>
		<tr><td>Order Terms:<input type="text" name="frgt02" value="<?= $order['order_frgt02'] ?>"> </td><td class="button"><button onclick="return faxed(<?= $order_ID ?>);">Faxed</button></td></tr>
		<tr><td>Order Comments:<input type="text" name="comment" value="<?= $order['order_comments'] ?>"> </td><td class="button"><button onclick="return exit();">Exit</button></td></tr>
		<tr><td colspan="2">Please Email Invoices To: homeportap@gmail.com</td></tr>		
		<tr><td colspan="2"><hr /></td></tr>
	</table>	
	
	<!-- Order Items -->
	<table class="order">
		<tr><td>Order <span onclick="receiveAll();">X</span></td><td>Sku</td><td>Description</td><td style="text-align: right;">Cost</td><td style="text-align: right;">Extension</td></tr>
		<tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
		<?php for($i = 0; $i < $itemcount; $i++) { ?>
		<tr>
			<td class="items" style="width: 130px;">
				<input type="hidden" name="oi_id[<?= $i ?>]" value="<?= $items[$i]['oi_id'] ?>">
				<?php if(!$items[$i]['oi_received']) { ?>
				<input title="Zero Here Removes the Item" style="width: 25px;" type="text" name="qty[<?= $i ?>]" value="<?= $items[$i]['oi_qty'] ?>">
				<span class="checkbox"><input class="cb" type="checkbox" name="recd[<?= $i ?>]">Received</span>
				<?php }else { ?>
				<input style="width: 25px;" type="hidden" name="qty[<?= $i ?>]" value="<?= $items[$i]['oi_qty'] ?>">
				<input  type="hidden" name="recd[<?= $i ?>]" value="0">
				(<?= $items[$i]['oi_qty'] ?>) 
				<?= $items[$i]['oi_received'] ?>
				<?php } ?>
			</td>
			<td class="items" title="Record #<?= $items[$i]['item_ID'] ?>"><?= $items[$i]['item_sku'] ?><input type="hidden" name="ID[<?= $i ?>]" value="<?= $items[$i]['item_ID'] ?>"></td>
			<td class="items"><?= stripslashes($items[$i]['item_desc']) ?></td>
			<td class="items" style="text-align: right;"><?= number_format($items[$i]['item_cost'],2) ?></td>
			<td class="items" style="text-align: right;"><?= number_format($items[$i]['ext'],2) ?></td>
		</tr>
		<tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
	<?php if($i > 0 && $i % 24 == 0) { $page++?>
	</table>
	<p class="breakhere">
	<!-- Order Header -->
	<table class="order">
		<tr><td>Purchase Order# <?= $po ?><br>Order Date: <?= $order['order_date'] ?></td><td></td><td style="text-align: right;">Page <?= $page ?> of  <?= $pages ?></td></tr>
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
	    <?php if($username){ ?>
	        <td>Logged [&nbsp;&nbsp;&nbsp;&nbsp;]
	        Faxed/emailed [
	        <?php if(@$order['emailed']){ ?>
	        &nbsp;&nbsp;X&nbsp;&nbsp;
	        <?php }else{ ?>
	        &nbsp;&nbsp;&nbsp;&nbsp;
	        <?php } ?>
	        ]
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buyer Signature:
	        </td>
	    <?php } ?>
	        <td align="right">Order Total <?= number_format($totalOrder,2) ?></td>
	    </tr>
	</table>
	<?php if($order['order_emailed']){ ?>
	<div class="sent"><img title="SENT: <?= $order['order_emailed'] ?>" alt="SENT: <?= $order['order_emailed'] ?>" src="../images/sent.png" /></div>
	<?php } ?>
	<input type="hidden" name="order_ID" value="<?= $order_ID ?>">
	</form>
	<br>
	<div class="summary">
	<table style="margin: auto; text-align: left; font-size: 10px;">
	<tr>
	<?php
	    $num=0;
	    for($i=0; $i<$rDepCount; $i++){
	        if($rDeps[$i]['total'] > 0){
	        ?>
	            <td style="width: 250px; border: 1px; border-style: solid">#<?= $rDeps[$i]['dept_ID'] ?> - <?= $rDeps[$i]['dept_name'] ?>: $<?= number_format($rDeps[$i]['total'],2) ?></td>
	            
	<?php 
		if(($i+1) % 4 == 0) echo "<tr /><tr>";
		} }?>
	</tr>
	</table>
	</div>
	<div class="add">
		<form action="processAddOrderItem.php" method="post">
		<table>
			<tr><td><hr></td></tr>	
			<tr><td>
				<input type="hidden" name="add_order_ID" value="<?= $order_ID ?>">
				Add Item(Record Number) 
				<input style="width: 150px; border: thin solid;" type="text" name="add_ID"> - Qty 
				<input style="width: 30px; border: thin solid;" type="text" name="add_qty">
				<input type="submit" value="Add Item To Order">
			</td></tr>
			<tr><td><hr></td></tr>
			<tr><td><input type="button" onclick="parent.location='ackOrder.php?order_ID=<?= $order['order_ID'] ?>'" value="Manual Acknowledgment" /></td></tr>
		</table>	
		</form>
	</div>
	<script defer="defer" type="text/javascript" src="js/viewOrder.js"></script>	
</body>
</html>