<?php
/*  Forgot password
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/forgotpw.php
*/
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/functions/f_resolve.php";

@$alert = $_REQUEST['alert'];


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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-8450012-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-8450012-2');
</script>

    <meta charset="utf-8" />
    <title>Forgot Password?</title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
    <link rel="stylesheet" href="css/forgotpw.css" type="text/css" />
</head>
<body>
    <?php include '../z_sub/z_banner.php'; ?>
    <div id="forgotcontainer">
        <div class="featuretitle">Oops! Forgot Your Password?</div>
        <div class="forgotform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions">No Problem, Just Enter Your Email</div>
            <?php } ?>
            <form action="processForgotpw.php" method="post">
            <input type="text" name="email" placeholder="Your Email Address">
            <button class="submitbtn" type="submit"><i class="fas fa-redo-alt"></i>&nbsp;Reset Password</button
            </form>
        </div>
    </div>
</body>
</html>