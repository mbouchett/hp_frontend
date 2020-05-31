<?php
//processAddToCart.php
//Mark Bouchett 2019
@include "/home/homeportonline/crc/2018.php";

// ************************* Functions ************************
function safeString($s) {
	$safeString = filter_var( $s, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	return $safeString;
}
	
@$item = safeString($_REQUEST['item']);
@$qty =  ($_REQUEST['qty']) ? safeString($_REQUEST['qty']) : 1;
@$reg = ($_REQUEST['reg']) ? safeString($_REQUEST['reg']) : 0;
@$wish = ($_REQUEST['wish']) ? safeString($_REQUEST['wish']) : 0;
@$amt = ($_REQUEST['amt']) ? safeString($_REQUEST['amt']) : 0;
@$cust = ($_REQUEST['cust']) ? safeString($_REQUEST['cust']) : 0;
@$wcust = ($_REQUEST['wcust']) ? safeString($_REQUEST['wcust']) : 0;

@$back = ($_REQUEST['back']) ? safeString($_REQUEST['back']) : 2;
// Is the user logged in?
if(isset($_COOKIE['c_ID'])) $loggedIn = 1; // Is a user logged in

if($cust && !$loggedIn) {	
	header('location: ../registries/pleaseSignIn.php?branch=shopReg&cust='.$cust);
	die;
}

if($wcust && !$loggedIn) {	
	header('location: ../registries/pleaseSignIn.php?branch=shopWish&cust='.$wcust);
	die;
}
	
//look Up The Item Price
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `item_retail` FROM `items` WHERE `item_ID` = '.$item;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$itemPr=mysqli_fetch_assoc($result);

if(!$amt) $amt = $itemPr['item_retail'];



if(!isset($_COOKIE['c_cart'])){
	$cart[0]['item'] = $item;
	$cart[0]['qty'] = $qty;
	$cart[0]['reg'] = $reg;
	$cart[0]['wish'] = $wish;
	$cart[0]['amt'] = $amt;
	setcookie("c_cart", serialize($cart), time() + (86400 * 30), "/"); // 86400 = 1 day
	// recover this way
	// $cart = unserialize($_COOKIE['c_cart']);
	header('location: index.php');
	die;
}
$cart = unserialize($_COOKIE['c_cart']);
$cartCount = count($cart);

//see if item already in cart
for($i = 0; $i < $cartCount; $i++) {
	if($cart[$i]['item'] == $item) {
		$cart[$i]['qty'] = 	$cart[$i]['qty'] + 1;
		setcookie("c_cart", serialize($cart), time() + (86400 * 30), "/"); // 86400 = 1 day
		header('location: index.php');
		die;
	}
}

$cart[$cartCount]['item'] = $item;
$cart[$cartCount]['qty'] = $qty;
$cart[$cartCount]['reg'] = $reg;
$cart[$cartCount]['wish'] = $wish;
$cart[$cartCount]['amt'] = $amt;

setcookie("c_cart", serialize($cart), time() + (86400 * 30), "/"); // 86400 = 1 day
header('location: index.php');
die;
?>