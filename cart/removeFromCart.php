<?php
//removeFromCart.php
//Mark Bouchett 2019

$index = $_REQUEST['index'];
$cart = unserialize($_COOKIE['c_cart']);
$cartCount = count($cart);
$x = 0;

if($cartCount == 1) {
	setcookie("c_cart", serialize($cart), time() - 3600, "/"); // 86400 = 1 day
}else{
	for($i = 0; $i < $cartCount; $i++) {
		if($i != $index) {
			$newCart[$x] = $cart[$i];
			$x++;
		}
	}
	setcookie("c_cart", serialize($newCart), time() + (86400 * 30), "/"); // 86400 = 1 day
}

header('location: index.php');
?>