<?php
//processCart.php
//Mark Bouchett 2019

$qty = $_POST[qty];

if(!isset($_COOKIE['c_cart'])){
	header('location: index.php');
	die;
}

$cart = unserialize($_COOKIE['c_cart']);
$cartCount = count($cart);
	
for($i = 0;$i <$cartCount;$i++) {
	$cart[$i]['qty'] = $qty[$i];
}

setcookie("c_cart", serialize($cart), time() + (86400 * 30), "/"); // 86400 = 1 day

header('location: index.php');
die;
?>