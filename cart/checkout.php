<?php
/* Contact form
	Mark/Francois Bouchett 2019
	checkout.php
*/

	// ******************* Database Credentials *******************
	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/_unMash.php";
	
	// ************************* Functions ************************
	function safeString($s) {
		$safeString = filter_var( $s, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		return $safeString;
	}

	// ****************** initializes variables *******************
	$loggedIn = 0;					// Is the user logged in
	$cartCount =  0;				// items in user's cart
	$payCount = 0;					// number of available payment options
	$addrCount = 0;					// number of available shipping addresses
	$checked = "";					// applies a check to a box or radio
    $subTotal = 0;					// order subtotal of items
    $tax = 0;						// 7% tax on the subtotal
    $total = 0;						// total to be charged to the customer's card
    @$shipping = $_REQUEST['shipping'];	// Shipping estimate from previous screen
    $zone = -1;						// to recalculate shipping
    $gcOnly = 1;					// is this a gift card only order
    $gcIncl = 0;					// is a gift card included in the purchase
    @$l1 = ($_REQUEST['l1']) ? $_REQUEST['l1'] : "";
    @$l2 = ($_REQUEST['l2']) ? $_REQUEST['l2'] : "";
    @$zip = $_REQUEST['zip'];		// zip code to base shipping on
	@$alert = $_REQUEST['alert'];	// message or alert for user
	$gcValue = 0;					// gift card dollar value to be applied to order
	@$promoCode = strtoupper(safeString($_REQUEST['code']));
	                                // promo discount or dollar code
	$discount = 0;					// actual dollar value of the discount from code
	$gcBalance = 0;					// gift card balance after application if any
	$discPercent = 0;				// discount percent from a promo code
	@$giftCard = $_REQUEST['card']; // Gift Card Applied
	$TAX = 0.07;					// Tax Rate as a Constant
	$today = date('Y-m-d');			// Today's date 
	@$w = ($_REQUEST['w']) ? $_REQUEST['w'] : 0;
	@$z = ($_REQUEST['z']) ? $_REQUEST['z'] : -1;
	@$gcAttempt = (isset($_COOKIE['gcAttempt'])) ? $_COOKIE['gcAttempt'] : 0;
	$cartTotItems = 0;
	
	// ********** checks to see if the user is logged in **********
	if(isset($_COOKIE['c_ID'])) $loggedIn = 1; // Is a user logged in
	if(!$loggedIn){
		header('location: ../account/signIn.php?branch=cart');
		die;
	}
	
	// ******************* Gets The Cart Count ********************
	
	if(isset($_COOKIE['c_cart'])){
		$cart = unserialize($_COOKIE['c_cart']);
		$cartCount = count($cart);
		for(!$i = 0; $i < $cartCount; $i++) {
			$cartTotItems = $cartTotItems + $cart[$i]['qty'];
		}
	}
	
	function getShip($zip,$st) {
		global $db_user;
		global $db_pw;
		global $db_db;
		global $subTotal;
		global $gcOnly;
		$shipping = 0;
		// ******************** Get Shipping Estimate ******************** 
		$db1= new mysqli('localhost', $db_user, $db_pw, $db_db);
		if($zip && !$gcOnly) {
			$sql1 = 'SELECT * FROM `zipzone` WHERE `zip` LIKE "'.substr($zip,0,3).'"';
			$result1 = mysqli_query($db1, $sql1); 
			if($result1) {
				$rate = mysqli_fetch_assoc($result1);
			}else {
				$rate = -1;
			}
			$shipping = $subTotal * ($rate['zone']/10);
			if($shipping < 11.99) $shipping = 11.99;
		}elseif($zip && $gcOnly) {
			$shipping = 3.50;
		}		
		mysqli_close($db1);
		return $shipping;
	}
	
	//********************** Check Promo Code ***********************
	if($promoCode) {
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql  = 'SELECT *  FROM `promo` WHERE `promo_code` LIKE \''.$promoCode.'\'';
		$result = mysqli_query($db, $sql);
		@$promoCount = mysqli_num_rows($result);
		if($promoCount > 0) {
			$promo = mysqli_fetch_assoc($result);
			if($promo['promo_exp'] >= $today) {
				if(!$promo['promo_limit'] || $promo['promo_limit'] >=  $promo['promo_used']) {
					if($promo['promo_disc']) $discPercent = $promo['promo_disc'];
					if($promo['promo_dollar']) $discount = $promo['promo_dollar'];
					$used = $promo['promo_used'] + 1;
					$sql = "UPDATE `".$db_db."`.`promo` SET `promo_used` = '".$used."' WHERE `promo_ID` = '".$promo['promo_ID'];
					$result = mysqli_query($db, $sql);
				}
			}else {
				$alert = "Promo Code ".$promoCode." expired: ".$promo['promo_exp'];
			}
		}else {
			$alert = "Promo Code ".$promoCode." Not Found";
		}
		mysqli_close($db);
	}
	
	// ******************* Get gift card balance ******************
if($gcAttempt > 3) {
	//$alert = "Please Call the store For Further Assistance";
	unset($gc);
	//setcookie("gcAttempt", $gcAttempt, time() - (86400 * 30), "/"); // 86400 = 1 day
}else {
	$gcAttempt++;
	setcookie("gcAttempt", $gcAttempt, time() + (86400 * 30), "/"); // 86400 = 1 day
	
	if($giftCard) {
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql  = 'SELECT *  FROM `gc` WHERE `gc_num` LIKE \''.$giftCard.'\'';
		$result = mysqli_query($db, $sql);
		@$cardCount = mysqli_num_rows($result);
		if($cardCount > 0) {
			$gc = mysqli_fetch_assoc($result);
			if($gc['gc_balance'] > 0) {
					$gcValue = $gc['gc_balance'];
				}else {
					$alert = "This gift card has a zero balance";
				}
		}else {
			$alert = "Gift Card ".$giftCard." Not Found";	
		}
		
	}
}
	
	// ******************* Gets The Cart Count ********************
	if(isset($_COOKIE['c_cart'])){
		$cart = unserialize($_COOKIE['c_cart']);
		$cartCount = count($cart);
	}
	
	// ******************** Get and total cart ********************
	if(isset($_COOKIE['c_cart'])){
		$cart = unserialize($_COOKIE['c_cart']);
		$cartCount = count($cart);
		//get cart data
		$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
		for($i = 0; $i < $cartCount; $i++){
			$sql = 'SELECT `item_ID`, `item_desc`,`item_retail`,`item_pic`,`item_sku`,`vendor_ID` 
	        FROM `items` 
	        WHERE `item_ID`='.$cart[$i]['item'];
	    	$result = mysqli_query($db, $sql); 
	    	$item = mysqli_fetch_assoc($result);
	    	$cart[$i]['desc'] = stripcslashes($item['item_desc']);
	    	$cart[$i]['retail'] = $item['item_retail'];
	    	$cart[$i]['pic'] = $item['item_pic'];
	    	$subTotal = $subTotal + ($cart[$i]['amt'] * $cart[$i]['qty']);
	    	if(substr($cart[$i]['desc'], -8) != "(No Tax)") {
	    		if($discPercent) {
	    			$discount = $discount + (($cart[$i]['amt'] * $cart[$i]['qty']) * ($discPercent/100));
	    			$tax = $tax + (($cart[$i]['amt'] * $cart[$i]['qty']) * ($discPercent/100)) * $TAX;
	    		}else {
	    			$tax = $tax + ($cart[$i]['amt'] * $cart[$i]['qty']) * $TAX;
	    		}
	    	}
	    	$l = substr($item['item_sku'],0,2);
	    	if($item['vendor_ID'] != 518 || $l != "GC") $gcOnly = 0;
	    	if($item['vendor_ID'] == 518 && $l == "GC") $gcIncl = 1;
		}
	}

	// ******************** get Payment Options *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `wm_ID`,`wm_card`,`wm_zip` FROM `web_method` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
	$result = mysqli_query($db, $sql);
	@$payCount = mysqli_num_rows($result);
	mysqli_close($db); 
	if($payCount){
		for($i=0; $i<$payCount; $i++){
			$pay[$i] = mysqli_fetch_assoc($result);
			$pay[$i]['shipping'] = getShip(unmash($pay[$i]['wm_zip']), $subTotal);
		}	
	}
	if($payCount < 0) {
		header('Location: ../account/usrEditPayment.php?branch=checkout');
		die;
	}	
	
	// ******************* get Shipping Options *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `wa_ID`,`wa_line1`, `wa_zip` FROM `web_addr` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
	$result = mysqli_query($db, $sql);
	$addrCount = mysqli_num_rows($result);
	mysqli_close($db); 
	if($addrCount){
		for($i=0; $i<$addrCount; $i++){
			$addr[$i] = mysqli_fetch_assoc($result);
			$addr[$i]['shipping'] = getShip($addr[$i]['wa_zip'], $subTotal);
		}	
	}
	
	// ********************** END Get Shipping Estimate **********************
	
	if($gcIncl && $discount){
		$discount = 0;
		$alert = "Discounts can not apply to purchases with Gift Cards";	
	}	
	if($z==-3 && $subTotal < 93){
		$shipping = 7.00;
	}
	if($z==-3 && $subTotal > 93) {
		$shipping = 0;
	}

	$total = $subTotal - $discount + $tax + $shipping;
	$postTotal = $total;
	
	if($giftCard) {
		if($gcValue >= $total) {
			$postTotal = 0;
			$gcBalance = $gcValue - $total;
			$gcAmt = $total;
		}else {
			$postTotal = $total - $gcValue;
			$gcBalance = 0;
			$gcAmt = $gcValue;
		}
		// update the gift card total
	}	
	if($zip & !$shipping) $shipping = getShip($zip, $subTotal);	
	
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
<title>Homeport Shopping Cart <?= $rate ?></title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
    <link rel="stylesheet" href="css/checkout.css" type="text/css" />
  	<script src="js/checkout.js"></script>
</head>
<body onload="window.scrollTo(0,<?= $w ?>);showNewCard();checkForm(0);" > 

	<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
    
<!-- ****************************** Checkout *****************************-->
        <div class="featuretitle">Checkout</div>
        <div class="checkoutform">
            <div class="ordersummary">
                <div class="summarytitle">Order Summary:</div>
                <div class="lineitem">
                    <div>Amount Before Tax:</div>
                    <div><?= number_format($subTotal,2) ?></div>
                </div>
                <?php if($discount > 0) { ?>
                <div class="disclineitem">
                    <div>Promo <span id="promoCode"><?= $promo['promo_code'] ?></span>:</div>
                    <div>-<?= number_format($discount,2) ?></div>
                </div>
                <?php }else { ?>
                	<span style="display: none;" id="promoCode"><?= @$promo['promo_code'] ?></span>
                <?php } ?>
                <div class="lineitem">
                    <div>Tax to be Collected:</div>
                    <div><?= number_format($tax,2) ?></div>
                </div>
                <div class="lineitem">
                    <div>Shipping:</div>
                    <div id="shipTot"><?= number_format($shipping,2) ?></div>
                </div>
                <div class="ordertotal">
                    <div>Order Total:</div>
                    <div><?= number_format($total,2) ?></div>
                </div>
				<?php if($gcValue > 0) { ?>
                <div class="gclineitem">
                    <div>Gift Card Balance:<span id="giftCardNum">&nbsp;<?= number_format($gcValue,2) ?></span></div>
                     <div class="chargeline">-<?= number_format($gcAmt,2) ?></div>
                </div>
                <?php }else { ?>
                	<span style="display: none;" id="giftCardNum"><?= @$giftCard ?></span>
                <?php } ?>
				<div class="finaltotal">
                    <div>Total:</div>
                    <div class="totalline"><?= number_format(@$postTotal,2) ?></div>
                </div>
                
<!-- ******************** Promo Code and Comment ******************** -->
				<?php if($gcAttempt < 200) { ?>
                <div class="delineator2">
                	<i class="fa fa-minus"></i>&nbsp;<i class="fa fa-percentage"></i>&nbsp;Promo Code&nbsp;&nbsp;or&nbsp;&nbsp;<i class="far fa-credit-card"></i>&nbsp;Homeport Gift Card
                </div>
                <div id="addPromoCode" class="radiotextfield2">
                	<input class="promocode" placeholder="Add Gift Card or Promo Code" id="cardCode" type="text" name="fname" maxlength="16"><a onclick="promo();" class="applybtn">Apply</a>
                </div>
                <?php } ?>
            </div>
            
<!-- ***************************** Alert ****************************** -->
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions">*Please Fill All Fields</div>
            <?php } ?>
            <form id="checkout" action="processCheckout.php" method="post" name="checkout">
            
<!-- ************************** Shipping ************************** -->
                <div class="radiooptions"> 
                    
                	<!-- Hold For Pickup -->
                	<?php $checked =($z == -1) ? "checked" : "" ?>
                    <div class="delineator"><i class="fa fa-shipping-fast"></i>&nbsp;Choose Shipping</div> 
                    <div class="addbtncontainer">
                        <a class="addnewbtn" href="../account/usrEditAddress.php?branch=checkout"><i class="fa fa-plus"></i>&nbsp;Add a Ship To Address</a>
                    </div>
                    <label onclick="shipCalc(0,-1)" class="radiocontainer">Hold For Pickup
                        <input id="hold" type="radio" name="ship" value="-1" <?= $checked ?> >
                        <span class="radiocheckmark"></span>
                    </label>
                    
                	<!-- Local Delivery -->
                	<?php $checked =($z == -3) ? "checked" : "" ?>
                    <div class="submessage">Local deliveries for orders over 100 dollars are free</div>
                    <label onclick="shipCalc(0,-3)" class="radiocontainer">Delivery - Local Curbside *(Selected Zip Codes)
                        <input id="hold" type="radio" name="ship" value="-3" <?= $checked ?> >
                        <span class="radiocheckmark"></span>
                    </label>		
                    <input class="localdeliverybox" name="dAddress" placeholder="*Street number and name" />
                    <select class="customselect" name="dzip">
                    		<!-- Burlington -->
                    		<option value="05401" selected="selected" >05401 Burlington</option>
                    		<option value="05405" >05405 UVM</option>
                    		<!-- Colchester, Essex, South Burlington, Shelburne -->
                    		<option value="05403" >05403 South Burlington</option>
                    		<option value="05403" >05404 Winooski</option>
                    		<option value="05482" >05482 Shelburne</option>
                    		<option value="05408" >05408 New North End</option>
                    		<option value="05446" >05446 Colchester</option>
                    		<option value="05452" >05452 Essex &amp; Essex Junction</option>
                    </select>
                    
                    		
					<!-- Ship to billing address -->
					<?php $checked =($z == -2) ? "checked" : ""; ?>
					<?php if($payCount > 0) { ?>
                    <label id="ShipToBilling" onclick="shipCalc(<?= $pay[0]['shipping'] ?>,-2)" class="radiocontainer">Ship To Billing Address
                        <input id="bill" type="radio" name="ship" value="-2" <?= $checked?> data-shp="<?= $pay[0]['shipping'] ?>">
                        <span class="radiocheckmark"></span>
                    </label>
                    <?php } ?>
                    <!-- Ship To Address on File -->
                    <?php if($addrCount > 0) {  
                   			for($i = 0;$i < $addrCount; $i++) { 
							$checked = "";
							if(($i+1) == $z) $checked = "checked";                 			
                   			?>
                    <label onclick="shipCalc('<?= $addr[$i]['shipping'] ?>', <?= $i+1 ?>);" class="radiocontainer">Ship to <?= $addr[$i]['wa_line1'] ?>
                        <input type="radio" name="ship" value="<?= $addr[$i]['wa_ID'] ?>" <?=  $checked?>>
                        <span class="radiocheckmark"></span>
                    </label>
                    <?php } } ?>
                    
                    <!-- Ship To New Address -->
                    <?php if($z == -3) { 
							$checked = "checked";
							$style = 'style="display: flex;"';
						}else {
							$checked = "";
							$style = '';
						}                   
                    ?>
                    
                    
<!-- ************************** Payment ************************** -->
                    <div class="delineator topspace"><i class="fa fa-credit-card"></i>&nbsp;Choose Payment</div>
                    <!-- Charge To Card on File -->
                   	<?php if($payCount > 0) { 
                   			for($i = 0;$i < $payCount; $i++) { 
                   				$checked = "";
								if($i == 0) $checked = "checked";                   			
                   			?>
                    <label class="radiocontainer">Use card ending in ****<?= substr(unmash($pay[$i]['wm_card']),-4) ?>
                    	<input type="radio" name="card" value="<?= $pay[$i]['wm_ID'] ?>" <?= $checked ?> data-shp="<?= $pay[$i]['shipping'] ?>" >
                    	<span class="radiocheckmark"></span>
                    </label>
                    <?php } 
                    	$checked = "";
                    }else { 
							$checked = "checked";                  
                     } ?>
					<!-- Add A New Payment Method -->                     
                    <div class="addbtncontainer">
                        <a class="addnewbtn2" href="https://www.homeportonline.com/account/usrEditPayment.php?branch=checkout"><i class="fa fa-plus"></i>&nbsp;Add a Payment Method</a>
                    </div>
                    
                    <textarea class="messagebox" placeholder="Order Comments (Optional)" id="message" type="text" name="comment"></textarea>
                </div>                 
<!-- ************************** Confirm Button ************************** -->  
				<?php if($payCount > 0) { ?>        
                <button onclick="sendForm();" id="confirmationButton" class="reviewbtn" >Place Your Order&nbsp;<i class="fa fa-thumbs-up"></i></button>
                <?php } ?>
                <input type="hidden" name="discount" value="<?= $discount ?>">
                <?php if(@$gc['gc_ID']) { ?>
                <input type="hidden" name="gc_ID" value="<?= $gc['gc_ID'] ?>">
                <?php } ?>
                <input type="hidden" name="gc_amt" value="<?= $gcAmt ?>">
                <input type="hidden" name="gc_bal" value="<?= $gcBalance ?>">
                <?php if(@$promoCode) { ?>
                <input type="hidden" name="promo_ID" value="<?= $promo['promo_ID'] ?>">
                <?php } ?>
                <input type="hidden" name="cc_amt" value="<?= $postTotal ?>">
                <input type="hidden" name="gc_num" value="<?= @$giftCard ?>">
                <input type="hidden" name="shipping" value="<?= @$shipping ?>">
            </form>
        </div>
        <div class="bottomlinks">     
            <a href="../cart/index.php"><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Back to Cart</a>
        </div>
    </div>
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>