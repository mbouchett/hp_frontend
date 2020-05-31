<?php
/* Sign In To User Account
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/signIn.php
*/
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/functions/f_resolve.php";
@$email = $_REQUEST['email'];
@$alert = $_REQUEST['alert'];
@$item = $_REQUEST['item'];
@$branch = $_REQUEST['branch'];
@$cust = $_REQUEST['cust'];


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
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Homeport Sign In</title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="css/signIn.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
   
</head>
<body>
	<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>

        <!--This is where the Banner ends-->
    <div id="signincontainer">
        <div class="featuretitle">Sign In To Homeport!</div>
        <?php if($email) { ?>
        <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;An Account Already Exists For This Email Address</div>
        <?php } ?>
        <div class="signinform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions">*Enter Email and Password</div>
            <?php } ?>
            <form name="processSignIn" action="processSignIn.php" method="post">
            <div><input placeholder="Email" type="text" name="email" value="<?= $email ?>"></div>	
            <div><input placeholder="Password" type="password" name="pw"></div>		
            <input type="submit" value="Sign In">	
            <input type="hidden" name="item" value="<?= $item ?>">
            <input type="hidden" name="branch" value="<?= $branch ?>">
            <input type="hidden" name="cust" value="<?= $cust ?>">
            <button class="signinbtn" onclick="checkForm(event);"><i class="fa fa-sign-in-alt"></i>&nbsp;Login</button>
            </form>
        </div>
        <div class="signinlinks">
            <a href="newAccount.php">New to Homeport? Sign up!</a>
            <a href="forgotpw.php">Forgot password?</a>
        </div>
    </div>
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>