<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/contact.php
*/

	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";

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
@$email = $_REQUEST['email'];
@$alert = $_REQUEST['alert'];

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
<title>Homeport Sign In</title>
    <!--the following two stylesheets need to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="webfonts/fonts.css" type="text/css" />
    <link rel="stylesheet" href="icons/all.css" type="text/css">
    
    <link rel="stylesheet" href="css/contact.css" type="text/css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body>

	<!--This Is the Banner copy this into any page that need a header-->
    <?php include 'z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle">Contact Homeport!</div>
        <div class="contactinfo"><a href="https://goo.gl/maps/Qn1piCjdYL82">Homeport 52 Church Street Burlington, Vermont 05401</a></div>
        <div class="contactinfo"><a href="tel:802-863-4644">Phone: &#40;802&#41;-863-4644</a></div>
        <div class="contactinfo">Fax: &#40;802&#41;-660-0525</div>
        <div class="contactform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions">*Please Fill All Fields</div>
            <?php } ?>
            <form id="contacthomeport" action="processContact.php" method="post" name="contacthomeport">
			        <div class="g-recaptcha" data-sitekey="6LeXlP4UAAAAANreY8vYDGtsYLPJTZm2ZE8fH-Kd"></div>
                <input placeholder="*First Name" id="fname" type="text" name="fname">
                <input placeholder="*Last Name" id="lname" type="text" name="lname">		
                <input placeholder="*Email" id="email" type="text" name="email">
                <textarea class="messagebox" placeholder="*Message" id="message" type="text" name="message"></textarea>
                <button class="contactbtn" onclick="checkForm(event);"><i class="fa fa-envelope"></i>&nbsp;Submit Message</button>  
            </form>
        </div>
        <div class="bottomlinks">
            <a href="index.php">Exit</a>
        </div>
    </div>
    
    <!--Department overlay Starts here-->
    <?php include 'z_overlay.php'; ?>
</body>
</html>