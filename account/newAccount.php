<?php
/* Create User Account
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/newAccount.php
*/
	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";

$loggedIn = 0;
$cartCount =  0;
if(isset($_COOKIE['c_ID'])) $loggedIn = 1; // Is a user logged in
@$email = $_REQUEST['email'];
@$alert = $_REQUEST['alert'];
@$branch = $_REQUEST['branch'];

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
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
    <link rel="stylesheet" href="../css/banner.css" type="text/css" /><!--this needs to be placed anywhere the Banner is-->
    <link rel="stylesheet" href="css/newAccount.css" type="text/css" />
    <link rel="stylesheet" href="../css/deptOverlay.css" type="text/css" />
    <script src="../js/deptOverlay.js"></script>
</head>
<body>
    <!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="acctcontainer">
        <div class="featuretitle">Create An Account!</div>
        <div class="acctform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions">*Please Fill All Fields</div>
            <?php } ?>
            <form id="newaccount" action="processNewAccount.php" method="post" name="newaccount">
                <input placeholder="*First Name" id="fname" type="text" name="fname">
                <input placeholder="*Last Name" id="lname" type="text" name="lname">		
                <input placeholder="*Email" id="email" type="text" name="email">
                <input placeholder="*Password" id="pw" type="password" name="pw">
                <input placeholder="*Re-type Password" id="pwv" type="password" name="pwv">
                <button class="acctbtn" onclick="checkForm(event);"><i class="fa fa-user-plus"></i>&nbsp;Create Account</button>  
                <input type="hidden" name="branch" value="<?= $branch ?>">
            </form>
        </div>
        <div class="acctlinks">
            <a href="signIn.php">I have an account - Sign In</a>
            <a href="../">Exit</a>
        </div>
    </div>
    
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>