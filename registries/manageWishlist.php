<?php
/* Access User Profile
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/index.php
*/
	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";


if(!isset($_COOKIE['c_ID'])){
	header('Location: ../index.php');
	die;	
}
$loggedIn = 0;
$cartCount =  0;
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
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="SHORTCUT ICON" href="../images/icon.ico">
	<meta charset="utf-8" />
	<title>My Account: <?= $_COOKIE['c_name'] ?></title>
	    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
        <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
        <link rel="stylesheet" href="css/manageWishlist.css" type="text/css" />
</head>
<body>
<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>

    <div id="usermenucontainer">
        <div class="featuretitle"><?= $_COOKIE['c_name'] ?> Edit Your Wishlist!</div>
        <div class="usermenu">
            <a class="userbtn" href="../departments.php"><i class="fa fa-plus"></i>&nbsp;Add Items</a>
            <a class="userbtn" href="manageWishItems.php"><i class="fa fa-gift"></i>&nbsp;Manage Items</a>
            <a class="userbtn" href="viewThankYou.php"><i class="fa fa-file-signature"></i>&nbsp;View Thank-You List</a> 
        </div>
        <div class="backlinks">
            <a href="../account/index.php"><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Back to Account</a>
        </div>
    </div>
        <?php include '../z_sub/z_overlay.php'; ?>

</body>
</html>