<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/contact.php
*/

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/_unMash.php";


// ****************** initializes variables *******************
$loggedIn = 0;					// Is the user logged in
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

$cartTotItems = 0;

// ********** checks to see if the user is logged in **********
if(isset($_COOKIE['c_ID'])) $loggedIn = 1;

// ******************* Gets The Cart Count ********************

if(isset($_COOKIE['c_cart'])){
	$cart = unserialize($_COOKIE['c_cart']);
	$cartCount = count($cart);
	for(!$i = 0; $i < $cartCount; $i++) {
		$cartTotItems = $cartTotItems + $cart[$i]['qty'];
	}
}

if(isset($_COOKIE['c_ID'])) {
	$loggedIn = 1; // Is a user logged in
}else {
	header('location: ../account/signIn.php');
}
$wo_ID = $_REQUEST['wo_ID'];

// ************* Get Order Info *************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_order` WHERE `wo_ID` = '.$wo_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);
$order = mysqli_fetch_assoc($result);

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
		  WHERE `wo_ID` = '.$wo_ID;
		  
$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Lookup Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
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
}

// ************ Get Shipping *************
if($order['wa_ID'] == -1) {  // Items will be placed on hold no shipping fee	
	$shipping = 0;
}else {
	$shipping = $order['wo_shipping'];
}

// ********* Get Gift card Value ***********
if($order['wo_gc_charge']) $gcValue = $order['wo_gc_charge'];

if($discPercent){
	$discount = $subTotal * ($discPercent/100);
	$tax = ($subTotal - $discount) * $TAX;
}
if($order['wa_ID'] == -3 && $subTotal < 100) $shipping = 7.00;
$st = $subTotal - $discount + $tax + $shipping;
$total = $subTotal - $discount + $tax + $shipping - $gcValue;

?>
<!DOCTYPE html>
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-8450012-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-8450012-2');
</script>

<meta charset="utf-8" />
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Confirm Order# <?= $order['wo_ID'] ?></title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
	<link rel="stylesheet" href="css/confirmation.css" type="text/css" />
    <script src="../js/deptOverlay.js"></script>
</head>
<body>

	<!--This Is the Banner copy this into any page that need a header-->
    <div class="hiddenforprint"><?php include '../z_sub/z_banner.php'; ?></div>
	
    <div id="container">
        <div class="featuretitle">Thanks for your order!</div>
		<div class="invoice">
			<div class="ordernumber">Homeport Order Number: <?= $order['wo_ID'] ?></div>
			<div class="invlabels">
				<div class="invlabelquan">Quantity</div>
				<div class="invlabeldesc">Desription</div>
				<div class="invlabelprice">Price</div>	
			</div>
			<!-- ************************* Item List ************************* -->
			<?php for($i = 0; $i < $itemCount; $i++) { ?>
			<div class="itemcontainer">
				<div class="invquan"><?= $items[$i]['wo_qty'] ?></div>
				<?php if($items[$i]['wish_ID']) { ?>
				<div class="invdesc"><?= $items[$i]['item_desc'] ?> (WL#<?= $items[$i]['wish_ID'] ?>)</div>
				<?php }elseif($items[$i]['reg_ID']) { ?>
				<div class="invdesc"><?= $items[$i]['item_desc'] ?> (Reg#<?= $items[$i]['reg_ID'] ?>)</div>	
				<?php }else { ?>
				<div class="invdesc"><?= $items[$i]['item_desc'] ?></div>
				<?php } ?>
				<div class="invprice"><?= number_format($items[$i]['wo_amt'],2) ?></div>
       		</div>
       		<?php } ?>
       		
       		<!-- ************************** Totals *************************** -->
			<div class="bottomnotes">
				<div class="orderinfo">
					*Please note, that your order will not be charged until the item\s are ready to ship or placed on hold.
					<?php if($order['wa_ID'] == -2) { ?>
					<hr>
                    ** Please await email confirming stock before picking up or call (802) 863-4644 for immediate confirmation.
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
						<div>Order Subtotal:</div>
						<div><?= number_format(@$st,2) ?></div>
					</div>
					<!-- ***** Gift Card ***** -->
					<?php if($gcValue) {?>
					<div class="gclineitem">
						<div>Gift Card Applied:</div>
						<div>-<?= number_Format($gcValue,2) ?></div>
					</div>
					<?php } ?>
					<div class="finaltotal">
						<div>Order Total:</div>
						<div class="totalline"><?= number_format(@$total,2) ?></div>
					</div>
				</div>
            </div>
            <?php if ($order['wo_comment']) {?>
                <!--Ifthere are order comments the show like this-->
                <div class="ordercomments"><span class="embolden">Order Comments:&nbsp;</span><?= $order['wo_comment'] ?></div>
            <?php } ?>
            
			<a class="printbtn hiddenforprint" onclick="window.print();return false;">Print Order Copy&nbsp;<i class="fa fa-print"></i></a>
		</div>
        <div class="bottomlinks hiddenforprint">     
            <a href="../index.php">Exit</a>
        </div>
    </div>
    
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>