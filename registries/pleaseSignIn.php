<!DOCTYPE html>
<html>
<head>
<?php
/*  
Please Sign In Page
Mark/Francois Bouchett 2019
http://www.homeportonline.com/product.php
*/

// ******************* Database Credentials *******************

@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/functions/f_resolve.php";
    
$loggedIn = 0;
$cartCount =  0;
$recentCount = 0;
$likeCount = 0;
@$branch = $_REQUEST['branch'];
@$cust = $_REQUEST['cust'];
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
<meta charset="utf-8" />
<!--the following two stylesheets need to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" />
    <link rel="stylesheet" href="../icons/all.css" type="text/css">
    <link rel="stylesheet" href="css/pleaseSignIn.css" type="text/css" />

<title></title>
</head>
<body>
    <?php include '../z_sub/z_banner.php'; ?>
    <div id="createregcontainer">
        <div class="featuretitle">Welcome to Homeport!</div>
        <div class="checkforsigninform">
            <div class="featuretitle">Please...<br><a class="link" href="../account/signIn.php?branch=<?= $branch ?>&cust=<?= $cust ?>" >Sign In</a><br>
            or<br><a class="link" href="../account/newAccount.php?branch=<?= $branch ?>">Create an Account</a><br>To shop Registries and Wishlists!</div>
        </div>
    </div>
</body>
</html>