<?php
/* Access User Profile
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/index.php
*/
	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";


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
<head><!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-8450012-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-8450012-2');
</script>

	<link rel="SHORTCUT ICON" href="../images/icon.ico">
	<meta charset="utf-8" />
	<title>My Account: <?= $_COOKIE['c_name'] ?></title>
	    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
        <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
        <link rel="stylesheet" href="css/index.css" type="text/css" />
</head>
<body>
<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>

    <div id="usermenucontainer">
        <div class="featuretitle"><?= $_COOKIE['c_name'] ?> This Is Your Account!</div>
        <div class="usermenu">
            <a class="userbtn" href="../favorites.php"><i class="fa fa-heart"></i>&nbsp;Liked Items</a>
            <a class="userbtn" href="../registries/manageRegistry.php"><i class="fa fa-gift"></i>&nbsp;Your Registry</a>
            <a class="userbtn" href="../registries/manageWishlist.php"><i class="fa fa-birthday-cake"></i>&nbsp;Wish List</a>
            <a class="userbtn2" href="usrEditProfile.php"><i class="fa fa-user-edit"></i>&nbsp;Edit Profile</a>
            <a class="userbtn2" href="https://www.homeportonline.com/account/usrEditPayment.php"><i class="fa fa-credit-card"></i>&nbsp;Edit Payment</a>
            <a class="userbtn2" href="usrEditAddress.php"><i class="fa fa-address-card"></i>&nbsp;Edit Addresses</a>
            <a class="userbtn2" href="viewUserOrders.php"><i class="fa fa-list"></i>&nbsp;Your Orders</a>
            <a class="signoutbtn" href="usrSignOut.php"><i class="fa fa-sign-out-alt"></i>&nbsp;Sign Out</a>
            
        </div>
        
    </div>
        <?php include '../z_sub/z_overlay.php'; ?>

</body>
</html>