<?php
	/* Homeport Process Checkout
		Mark/Francois Bouchett 2019
		processCheckout.php
	*/
	date_default_timezone_set('America/New_York');
	
	// ******************* Database Credentials *******************
	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/_mash.php";
	@require '../dashboard/cs/twilio-php-master/Twilio/autoload.php'; 
	
	// ************************* Functions ************************
	function safeString($s) {
		$safeString = filter_var( $s, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		return $safeString;
	}
	
	// ****************** initializes variables *******************
	$time = date("Y-m-d-H-i");
	$today = date("Y-m-d");
	$wc_ID = $_COOKIE['c_ID'];													// `web_cust`.`wc_ID`
	@$wm_ID = $_POST['card']; 													// #s = `web_method`.`wm_ID`
	$shipping = ($_POST['shipping']) ? $_POST['shipping'] : 0; 		// shipping amount
	$dAddress = ($_POST['dAddress']) ? $_POST['dAddress'] : "-"; 	// Delivery Address
	$dZip = ($_POST['dzip']) ? $_POST['dzip'] : "-"; 					// Delivery Zip 
	$delivery = $dAddress." - ".$dZip;
	$gc_amt = 0;	
	
	@$gc_ID = ($_POST['gc_ID']) ? $_POST['gc_ID'] : 0;
	if($gc_ID) {
		@$gc_amt = $_POST['gc_amt'];
		@$gc_bal = $_POST['gc_bal'];
		@$gc_num = $_POST['gc_num'];
	}
	
	@$cc_amt = ($_POST['cc_amt']) ? $_POST['cc_amt'] : 0;
	@$promo_ID = ($_POST['promo_ID']) ? $_POST['promo_ID'] : 0;
	@$wo_comment = safeString($_POST['comment']);
	@$wa_ID = $_POST['ship']; 		// -1=Hold, -2=Ship to Billing -3=Local Delivery
											// all positive #s = `web_addr`.`wa_ID`
	@$discount = $_POST['discount'];// The dollar amount to reduce the order by
	$cart = unserialize($_COOKIE['c_cart']); //$cart[$i]['item'], $cart[$i]['qty']
	$cartCount = count($cart);		// the number of items in the cart	
	
	/*
	echo "customer: ".$wc_ID."<br>";
	echo "method: ".$wm_ID."<br>";
	echo "shipping: ".$shipping."<br>";
	exit;
	*/
	
	// ************************ Handle Gift card ************************
	if($gc_ID) {
		$newBalance=number_format((float)$gc_bal,2);
		$subtract = number_format((float)$gc_amt,2);
		$add = 0;
		// Save The Transaction To the Log
		$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql = "INSERT INTO `".$db_db."`.`gcLog` (`gcLog_num`, `gcLog_date`, `gcLog_plus`, `gcLog_minus`, `gcLog_balance`, `gcLog_user`)
			  	VALUES ('$gc_num', '$time', '$add', '$subtract', '$newBalance', 'WebSale')";
		$result = mysqli_query($db, $sql);
		if(!$result) {
			echo "Update Gift Card Log Update Failed<br>";
			echo $sql."<br>";
			echo mysqli_error($db);
			die;
		}	

		// Save The Changes to the card
		$sql = "UPDATE `".$db_db."`.`gc` SET `gc_balance` = '".$newBalance."' WHERE `gc_ID`=".$gc_ID;
		$result = mysqli_query($db, $sql);
		if(!$result) {
			echo "Update Gift Card Failed<br>";
			echo $sql."<br>";
			echo mysqli_error($db);
			die;
		}
		mysqli_close($db);
	}
	
	// ************************** create order **************************
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$comment = mysqli_real_escape_string($db, $wo_comment);
	$comment = $wo_comment;
	$sql = "INSERT INTO `".$db_db."`.`web_order` (`wc_ID`, `wm_ID`, `wa_ID`, `gc_ID`, `promo_ID`, `wo_discount`, `wo_gc_charge`, `wo_cc_charge`, `wo_comment`, `wo_delivery`, `wo_shipping`)
	        	VALUES ('$wc_ID','$wm_ID', '$wa_ID', '$gc_ID', '$promo_ID' ,'$discount' ,'$gc_amt' ,'$cc_amt' ,'$comment', '$delivery', '$shipping')";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Order Process Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	$wo_ID = mysqli_insert_id($db); //Grab the web order ID
	mysqli_close($db);

	// *********************** Add Items To order ***********************
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i = 0; $i < $cartCount; $i++) {
		$a = $cart[$i]['item'];
		$b = $cart[$i]['qty'];
		$c = ($cart[$i]['reg']) ? $cart[$i]['reg'] : 0;
		$d = ($cart[$i]['wish']) ? $cart[$i]['wish'] : 0;
		$e = ($cart[$i]['amt']) ? $cart[$i]['amt'] : 0;
		$sql = "INSERT INTO `".$db_db."`.`web_order_items` (`wo_ID`, `item_ID`, `wo_qty`, `reg_ID`, `wish_ID`, `wo_amt`)
	        	VALUES ('$wo_ID','$a','$b', '$c', '$d', '$e')";
		$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
	}
	mysqli_close($db);
	// *********************** update wishlist ***********************
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i = 0; $i < $cartCount; $i++) {
		if($cart[$i]['wish']) {
			$sql = 'SELECT `wish_fund`, `wish_fundAmt`, `wish_qty`, `wish_recQty` 
				    FROM `web_wish` 
				    WHERE `wish_ID`='.$cart[$i]['wish'];
			$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
			$ww=mysqli_fetch_assoc($result);
			
			if($ww['wish_fund']) {
				$newAmt = $cart[$i]['amt'] + $ww['wish_fundAmt'];
				$sql = "UPDATE `".$db_db."`.`web_wish` 
			    SET `wish_fundAmt` = '".$newAmt."'
	            WHERE `wish_ID` = ".$cart[$i]['wish'];
				$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
			}else {
				$newQty = $cart[$i]['qty'] + $ww['wish_recQty'];
				if($newQty >= $ww['wish_rqty']) {
					$sql = "UPDATE `".$db_db."`.`web_wish` 
			    			SET `wish_recQty` = '".$newQty."',
			    				`wish_purch_date` = '".$today."'
	            			WHERE `wish_ID` = ".$cart[$i]['wish'];
					$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
				}else {
					$sql = "UPDATE `".$db_db."`.`web_wish` 
			    			SET `wish_recQty` = '".$newQty."'
	            			WHERE `wish_ID` = '".$cart[$i]['wish'];
					$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
				}
			}
				
		}
	}
	mysqli_close($db);
	
	// *********************** update registry ***********************
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i = 0; $i < $cartCount; $i++) {
		if($cart[$i]['reg']) {
			$sql = 'SELECT `reg_fund`, `reg_fundAmt`, `reg_qty`, `reg_recQty` 
				    FROM `web_reg` 
				    WHERE `reg_ID`='.$cart[$i]['reg'];
			$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
			$ww=mysqli_fetch_assoc($result);
			
			if($ww['reg_fund']) {
				$newAmt = $cart[$i]['amt'] + $ww['reg_fundAmt'];
				$sql = "UPDATE `".$db_db."`.`web_reg` 
			    SET `reg_fundAmt` = '".$newAmt."'
	            WHERE `reg_ID` = ".$cart[$i]['reg'];
				$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
			}else {
				$newQty = $cart[$i]['qty'] + $ww['reg_recQty'];
				if($newQty >= $ww['reg_rqty']) {
					$sql = "UPDATE `".$db_db."`.`web_reg` 
			    			SET `reg_recQty` = '".$newQty."',
			    				`reg_purch_date` = '".$today."'
	            			WHERE `reg_ID` = ".$cart[$i]['reg'];
					$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
				}else {
					$sql = "UPDATE `".$db_db."`.`web_reg` 
			    			SET `reg_recQty` = '".$newQty."',
	            			WHERE `reg_ID` = '".$cart[$i]['reg'];
					$result = mysqli_query($db, $sql);
		if(!$result){
			echo "No Good!<br>";
			echo $sql." - ".$i."<br>";
			echo mysqli_error($db);
			die;
		}
				}
			}
				
		}
	}
	mysqli_close($db);
	
	// *********************** Clear Cart Cookie ***********************
	unset($_COOKIE[c_cart]);
	setcookie('c_cart', '', time() - 3600, '/');
	
	// ********************* Send Text Notification *********************
	$text = "Online Order\n";
	$to = "+18023731035";

	// Use the REST API Client to make requests to the Twilio REST API
	use Twilio\Rest\Client;

	// Your Account SID and Auth Token from twilio.com/console
	$client = new Client($sid, $token);
	
	// Use the client to do fun stuff like send text messages!
	$client->messages->create(
	    // the number you'd like to send the message to
	    $to,
	    array(
	        // A Twilio phone number you purchased at twilio.com/console
	        'from' => '+18029921899',
	        // the body of the text message you'd like to send
	        'body' => $text
	    )
	);	
	// ***************** Navigate to confirmation page ******************
	header('location: confirmation.php?wo_ID='.$wo_ID);
	die;
    
    //sanitizes variable
    //$fixedvar = filter_var( $badvar, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
?>