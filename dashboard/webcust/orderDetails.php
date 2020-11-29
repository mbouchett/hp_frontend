<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/contact.php
*/

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/_unMash.php";


// ****************** initializes variables *******************
$cartCount = 0;					// items in user's cart
$promoCode = "";				// promo discount or dollar code
$gcOnly = 1;					// is this a gift card only order
$gcIncl = 0;					// is a gift card included in the purchase
$subTotal = 0;					// order subtotal of items
$tax = 0;						// 7% tax on the subtotal
$total = 0;						// total to be charged to the customer's card
$discount = 0;
$gcValue = 0;					// gift card dollar value to be applied to order
$giftCard = 0;
$shipping = 0;					// Shipping Calculation
$TAX = 0.07;					// Tax Rate as a Constant
$discPercent = 0;				// discount percent from a promo code
$txtColor = "";					// highlighted status
$cartTotItems = 0;
$nameColor = 'ffffff';

$wo_ID = $_REQUEST['wo_ID'];

	function getStatus($s) {
		switch($s) {
			case 1:
				$stat = "Awaiting Items";
				break;
			case 2:
				$stat = "Order Canceled";
				break;
			case 3:
				$stat = "Items Awaiting Pickup";
				break;
			case 4:
				$stat = "Items Picked Up";
				break;
			case 5:
				$stat = "Order Shipped";
				break;
			case 6:
				$stat = "Payment Issue";
				break;
			case 7:
				$stat = "Closed";
				break;
			default:
				$stat = "Order Placed";
		}
		return $stat;
	}
	
	function getCust($reg_ID) {
		global $db_user, $db_pw, $db_db;
		$db2 = new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql = 'SELECT * FROM `web_reg` WHERE `reg_ID`='.$reg_ID;
		$result = mysqli_query($db2, $sql);
		$regCust = mysqli_fetch_assoc($result);
		$rc = $regCust['wc_ID'];
		return $rc;
	}

// ************* Get Order Info *************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_order` WHERE `wo_ID` = '.$wo_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);
$order = mysqli_fetch_assoc($result);
$order['stat'] = getStatus($order['wo_status']);

// ************* Get customer Info *************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_cust` WHERE `wc_ID` = '.$order['wc_ID'];
$result = mysqli_query($db, $sql);
mysqli_close($db);
$cust = mysqli_fetch_assoc($result);

// ************ Get promo code *************
if($order['promo_ID']) {
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `promo` WHERE `promo_ID` = '.$order['promo_ID'];
	$result = mysqli_query($db, $sql);
	mysqli_close($db);
	$promo = mysqli_fetch_assoc($result);
	$promoCode = $promo['promo_code'];
	if($promo['promo_disc']) $discPercent = $promo['promo_disc'];
	if($promo['promo_dollar']) $discount = $promo['promo_dollar'];
}

// ************ Get Order Items *************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `web_order_items` 
		  LEFT JOIN `items` USING (`item_ID`) 
		  LEFT JOIN `departments` USING (`dept_ID`) 
		  WHERE `wo_ID` = '.$wo_ID;
		  
$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Lookup Error!<br>";
		//echo $sql."<br>";
		//echo mysqli_error($db);
		die;
	}
$itemCount = mysqli_num_rows($result);
mysqli_close($db); 


//Store the Results To A Local Array
for($i=0; $i<$itemCount; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
	$ext = $items[$i]['wo_qty'] * $items[$i]['wo_amt'];
	$subTotal = $subTotal + $ext;
	if(substr($items[$i]['item_desc'], -8) != "(No Tax)") {
		$tax = $tax + ($ext * $TAX);
	}
	if(substr($items[$i]['item_desc'], -18) == "Gift Card (No Tax)"){
		$gcIncl = 1;	
	}else {
		$gcOnly = 0;	
	}
	if($items[$i]['reg_ID']) {
		$items[$i]['regCust'] = getCust($items[$i]['reg_ID']);
	}
}

// ************ Get Shipping Zip *************
if($order['wa_ID'] == -1) {  // Items will be placed on hold no shipping fee	
	$shipping = 0;
}else {
	$shipping = $order['wo_shipping'];
}

// ********** get shipping address ***********
if($order['wa_ID'] > 0) {
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `web_addr` WHERE `wa_ID` = '.$order['wa_ID'];
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Address Lookup Error!<br>";
		//echo $sql."<br>";
		//echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	$ship = mysqli_fetch_assoc($result);
}


// ********* Get Gift card Value ***********
if($order['wo_gc_charge']) $gcValue = $order['wo_gc_charge'];

if($discPercent){
	$discount = $subTotal * ($discPercent/100);
	$tax = ($subTotal - $discount) * $TAX;
}

$total = $subTotal - $discount + $tax +$shipping - $gcValue;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Order Details# <?= $order['wo_ID'] ?> <?= $order['wa_ID'] ?></title>
    <link rel="stylesheet" href="../../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
	<link rel="stylesheet" href="css/orderDetails.css" type="text/css" />
</head>
<body>
	
    <div id="container">
    	<?php if($cust['wc_badActor']) $nameColor = 'ff2222'; ?>
        <div class="featuretitle" style="background-color: #<?= $nameColor ?>" ><?= $cust['wc_fname'] ?> <?= $cust['wc_lname'] ?> order!</div>
		<div class="invoice">
			<div class="ordernumber">Homeport Order Number: <?= $order['wo_ID'] ?>
			<form action="processAddTracking.php" method="post" >
				tr# <input type="text" name="track" value="<?= $order['wo_tracking'] ?>"><input type="submit" name="Add" value="Update">
				<input type="hidden" name="wo_ID" value="<?= $order['wo_ID'] ?>">
			</form>
			</div>
			<div class="invlabels">
				<div>&nbsp;&nbsp;I/S</div>
				<div>&nbsp;&nbsp;Item#</div>
				<div>&nbsp;&nbsp;Cat</div>
				<div class="invlabelquan">&nbsp;&nbsp;Qty</div>
				<div class="invlabeldesc">&nbsp;&nbsp;Desription</div>
				<div class="invlabelprice">Price</div>	
			</div>
			<!-- ************************* Item List ************************* -->
			<form action="processUpdateItemsInfo.php" method="post" >
			<?php for($i = 0; $i < $itemCount; $i++) { 
						$is = $items[$i]['wo_instock'] ? "checked" : "";	
			?>
			<div class="itemcontainer">
				<div><input type="checkbox" name="instock[<?= $i ?>]"  <?= $is ?> /></div>
				<div>
					<input style="width: 50px;" name="item_id[<?= $i ?>]" value="<?= $items[$i]['item_ID'] ?>" title="delete item# to remove item" />
					<input type="hidden" name="woi_id[<?= $i ?>]" value="<?= $items[$i]['woi_ID'] ?>" />
				</div>
				<div class="invquan"><?= $items[$i]['dept_belongs_to'] ?></div>
				<div class="invquan"><input style="width: 25px;" name="qty[<?= $i ?>]" value="<?= $items[$i]['wo_qty'] ?>" /></div>
				<?php if($items[$i]['wish_ID']) { ?>
				<div class="invdesc"><a href="../../product.php?item=<?= $items[$i]['item_ID'] ?>" ><?= $items[$i]['item_desc'] ?></a> (WL#<?= $items[$i]['wish_ID'] ?>)</div>
				<?php }elseif($items[$i]['reg_ID']) { ?>
				<div class="invdesc"><a href="../../product.php?item=<?= $items[$i]['item_ID'] ?>" ><?= $items[$i]['item_desc'] ?></a> (Reg# <a href="viewRegBuys.php?cust=<?= $items[$i]['regCust'] ?>" ><?= $items[$i]['regCust'] ?></a>)</div>	
				<?php }else { ?>
				<div class="invdesc"><a href="../../product.php?item=<?= $items[$i]['item_ID'] ?>" ><?= $items[$i]['item_desc'] ?></a></div>
				<?php } ?>
				<div class="invprice"><?= number_format($items[$i]['wo_amt'],2) ?></div>
       	 </div>
       	 <?php } ?>
       	 <input type="hidden" name="wo_id" value="<?= $wo_ID ?>" />
       	 <input type="submit" value="Save Item Changes">
       	 </form>
       		<!-- ************************** Totals *************************** -->
			<div class="bottomnotes">
				<div title="<?= $order['wm_ID'] ?>" class="orderinfo">
					<?= $cust['wc_fname'] ?> <?= $cust['wc_lname'] ?><br>
					<?= $cust['wc_email'] ?> <?= $cust['wc_phone'] ?><br>
					<?php if($order['wa_ID'] == -1) { ?>
                    Place Item On Hold
					<?php }elseif($order['wa_ID'] == -2) { ?>
					Ship to billing
					<?php }elseif($order['wa_ID'] == -3){ ?>
					Delivery:<br>
					<?= $order['wo_delivery'] ?>
					<?php }else { ?>
					Ship To: <br>
					<?= $ship['wa_line1'] ?><br>
					<?= $ship['wa_line2'] ?><br>
					<?= ucfirst(strtolower($ship['wa_city'])) ?>, <?= $ship['wa_state'] ?> <?= $ship['wa_zip'] ?>
					<?php } ?>
				</div>
				<div class="totalsummary">
					
					<div class="lineitem">
						<div>Amount Before Tax:</div>
						<div><?= $subTotal ?></div>
					</div>
					
					<!-- ***** Promo Code ***** -->
					<?php if($promoCode) {?>
					<div class="disclineitem">
						<div><?= $promoCode ?></div>
						<div>-<?= number_format($discount,2) ?></div>
					</div>
					<?php } ?>
					
					<div class="lineitem">
						<div>Tax to be Collected:</div>
						<div><?= number_format(@$tax,2) ?></div>
					</div>

					<div class="lineitem">
						<?php if($order['wa_ID'] == -1) { ?>
						<div>**Item/s On Hold At Store</div>
						<?php } ?>
						
						<?php if($order['wa_ID'] == -3) { ?>
						<div>Delivery Fee:</div>
							<?php if($shipping == 0) { ?>	<div id="shipTot">FREE</div>	<?php }else { ?>
							<div id="shipTot"><?= number_format(@$shipping,2) ?></div> <?php }?>
						<?php  } ?>

						<?php if($order['wa_ID'] == -2 || $order['wa_ID'] > 0) { ?>
						<div>Estimated Shipping:</div>
						<div id="shipTot"><?= number_format(@$shipping,2) ?></div>
						<?php } ?>
					</div>

					<div class="ordertotal">
						<div>Order Total:</div>
						<div><?= number_format(@$total,2) ?></div>
					</div>
					
					<!-- ***** Gift Card ***** -->
					<?php if($gcValue) {?>
					<div class="gclineitem">
						<div>Gift Card Applied:</div>
						<div>-<?= number_Format($gcValue,2) ?></div>
					</div>
					<?php } ?>
					<div class="finaltotal">
						<div>Sub Total:</div>
						<div class="totalline"><?= number_format(@$total,2) ?></div>
					</div>
				</div>
            </div>
            <?php if ($order['wo_comment']) {?>
                <!--Ifthere are order comments the show like this-->
                <div class="ordercomments"><span class="embolden">Order Comments:&nbsp;</span><?= $order['wo_comment'] ?></div>
            <?php } ?>
            <hr>
            
            	<?php $txtColor = "000000"; if($order['wo_status'] == 0) $txtColor = "00aa00"; ?>
            	<a style="color: #<?= $txtColor ?>;" href="processStatusUpdate.php?stat=0&wo_ID=<?= $order['wo_ID'] ?>" >Order Placed</a> |
            	<?php $txtColor = "000000"; if($order['wo_status'] == 1) $txtColor = "00ff00"; ?>
            	<a style="color: #<?= $txtColor ?>;" href="processStatusUpdate.php?stat=1&wo_ID=<?= $order['wo_ID'] ?>" >Awaiting Items</a> |
            	<?php $txtColor = "000000"; if($order['wo_status'] == 2) $txtColor = "00ff00"; ?>
            	<a style="color: #<?= $txtColor ?>;" href="processStatusUpdate.php?stat=2&wo_ID=<?= $order['wo_ID'] ?>" >Order Canceled</a><br>
            	<?php $txtColor = "000000"; if($order['wo_status'] == 3) $txtColor = "00ff00"; ?>
            	<a style="color: #<?= $txtColor ?>;" href="processStatusUpdate.php?stat=3&wo_ID=<?= $order['wo_ID'] ?>" >Items Awaiting Pickup</a> |
				<?php $txtColor = "000000"; if($order['wo_status'] == 4) $txtColor = "00ff00"; ?>            	
            	<a style="color: #<?= $txtColor ?>;" href="processStatusUpdate.php?stat=4&wo_ID=<?= $order['wo_ID'] ?>" >Items Picked Up</a> |
            	<?php $txtColor = "000000"; if($order['wo_status'] == 5) $txtColor = "00ff00"; ?>
            	<a style="color: #<?= $txtColor ?>;" href="processStatusUpdate.php?stat=5&wo_ID=<?= $order['wo_ID'] ?>" >Order Shipped</a> |
            	<?php $txtColor = "000000"; if($order['wo_status'] == 6) $txtColor = "00ff00"; ?>
            	<a style="color: #<?= $txtColor ?>;" href="processStatusUpdate.php?stat=6&wo_ID=<?= $order['wo_ID'] ?>" >Payment Issue</a>
            	<?php $txtColor = "000000"; if($order['wo_status'] == 7) $txtColor = "00ff00"; ?>
            	<a style="color: #<?= $txtColor ?>;" href="processStatusUpdate.php?stat=7&wo_ID=<?= $order['wo_ID'] ?>" >Closed</a>
            <br>
			<a class="printbtn hiddenforprint" onclick="window.print();return false;">Print Order Copy&nbsp;<i class="fa fa-print"></i></a>
		</div>
		<hr>
    	 <form action="processAddWebOrderItems.php" method="post" >
    	 	<div>Add item #<input style="width: 50px;" name="item_id" /> quantity <input style="width: 25px;" name="qty" /><input type="submit" value="Submit"></div>
    	 	<input type="hidden" name="wo_id" value="<?= $wo_ID ?>" />
    	 </form>
      <hr>
        <div class="bottomlinks hiddenforprint">     
            <a href="viewCustOrders.php">Exit</a>
        </div>
    </div>

</body>
</html>