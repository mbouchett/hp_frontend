<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/contact.php
*/

	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";
	
	// ************************* Functions ************************
	function safeString($s) {
		@$safeString = filter_var( $s, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		return $safeString;
	}
	
$loggedIn = 0;
$cartCount =  0;
$cartTotItems = 0;

if(isset($_COOKIE['c_ID'])) $loggedIn = 1; // Is a user logged in

if(isset($_COOKIE['c_cart'])){
	$cart = unserialize($_COOKIE['c_cart']);
	$cartCount = count($cart);
	for(!$i = 0; $i < $cartCount; $i++) {
		$cartTotItems = $cartTotItems + $cart[$i]['qty'];
	}
}
@$email = safeString($_REQUEST['email']);
@$alert = safeString($_REQUEST['alert']);
@$gc = ($_POST['gc']) ? safeString($_POST['gc']) : 0;
@$gcAttempt = (isset($_COOKIE['gcAttempt'])) ? $_COOKIE['gcAttempt'] : 0;

if($gcAttempt > 3) {
	$alert = "Please Call the store For Further Assistance";
	unset($gc);
	//setcookie("gcAttempt", $gcAttempt, time() - (86400 * 30), "/"); // 86400 = 1 day
}else {
	if($gc) {
		$gcAttempt++;
		setcookie("gcAttempt", $gcAttempt, time() + (86400 * 30), "/"); // 86400 = 1 day
		
		$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql  = 'SELECT *  FROM `gc` WHERE `gc_num` LIKE \''.$gc.'\'';
		$result = mysqli_query($db, $sql);
		mysqli_close($db);
		$gc=mysqli_fetch_assoc($result);
	}
}

//Load Categories for banner
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `main_cats`';
$result = mysqli_query($db, $sql);
$catCount = mysqli_num_rows($result);
mysqli_close($db);
for($i=0; $i<$catCount; $i++){
	$cat[$i] = mysqli_fetch_assoc($result);
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
<link rel="SHORTCUT ICON" href="images/icon.ico">
<title>Homeport Gift Cards</title>
    <!--these two links needs to be placed at the top of every page--> 
    <link rel="stylesheet" href="webfonts/fonts.css" type="text/css" /> 
    <link rel="stylesheet" href="icons/all.css" type="text/css">
    
    <link rel="stylesheet" href="css/giftCard.css" type="text/css" />   
</head>
<body>
	
	<!--This Is the Banner copy this into any page that need a header-->
    <?php include 'z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle">Check Your Gift Card</div>
        <div class="cardform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
				<?php if($gc) { ?>
					<div class="instructions">Your Card Balance: <?= number_format($gc['gc_balance'],2) ?></div>
				<?php }else { ?>	
                <div class="instructions">*Enter Your 16 digit Card Number</div>
            <?php } } ?>
            
            <form id="checkgiftcard" action="giftCard.php" method="post" name="contacthomeport">
                <input placeholder="*Card Number" id="fname" type="text" name="gc" value="<?= @$gc['gc_num'] ?>">
                <button class="submitbtn" ><i class="fa fa-check"></i>&nbsp;Check Balance</button>  
            </form>
        </div>
    </div>
    <div id="cardcontainer">
        <div class="featuretitle">Purchase a Gift Card</div>
        <div class="giftcardcontainer">
            <div class="directions">Choose your amount!</div>
            <a class="giftcardlink" href="cart/processAddToCart.php?item=73846">$5</a>
            <a class="giftcardlink" href="cart/processAddToCart.php?item=73847">$10</a>
            <a class="giftcardlink" href="cart/processAddToCart.php?item=18833">$25</a>
            <a class="giftcardlink" href="cart/processAddToCart.php?item=18834">$50</a>
            <a class="giftcardlink" href="cart/processAddToCart.php?item=18836">$100</a>
            <a class="giftcardlink" href="cart/processAddToCart.php?item=18838">$200</a>
        </div>
        <div class="bottomlinks">     
            <a href="index.php">Exit</a>
        </div>
    </div>
        
    <!--Department overlay Starts here-->
    <?php include 'z_overlay.php'; ?>
    <?php include 'z_footer.php'; ?>
</body>
</html>