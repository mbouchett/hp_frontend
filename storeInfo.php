<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/storeInfo.php
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
    <!--these two links needs to be placed at the top of every page--> 
    <link rel="stylesheet" href="webfonts/fonts.css" type="text/css" /> 
    <link rel="stylesheet" href="icons/all.css" type="text/css">
    
    <link rel="stylesheet" href="css/storeInfo.css" type="text/css" />
    <link rel="stylesheet" href="css/accordion.css" type="text/css" />
    
</head>
<body>
    <!--This Is the Banner copy this into any page that need a header-->
    <?php include 'z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle"><i class="fa fa-question-circle"></i>&nbsp;FAQ and General Info&nbsp;<i class="fa fa-info-circle"></i></div>
        <a class="accordion"><i class="fa fa-exclamation-circle"></i>&nbsp;About Our Store!</a>
            <div class="panel">
                <p class="storestory">Homeport is a lifestyle and home furnishing store, offering a large range of products to suit your household needs. Located on Burlington's pedestrian-only Church Street, Homeport has four floors of everything you need for your home. The Bouchett’s have been on Church Street for over 30 years and currently have three generations working in their store. Early in their career they traveled the world to find unique items to carry and have supported those relationships ever since. Each department manager handpicks items for the store thus adding to the diversity of the products. They also travel the country to various trade shows to meet with specialty vendors in order to carry items not commonly available. Homeport has found the perfect niche in being an import store and supporting local businesses throughout Vermont, the country, and all over the world. Most of the items that you see in the store can be found on their website, however there are many products that come into their doors every week that are one of a kind.<br><br>

                <b>Some of the features of our store includes but is not limited to:</b>
                <br><br>
                    <ul class="storestory">
                        <li>Gift/Bridal Registry</li>
                        <li>Special Orders for Furniture, Upholstery and Wicker</li>
                        <li>Knife Sharpening by Appointment</li>
                        <li>Nespresso Demos</li>
                        <li>Sodastream Refills</li>
                        <li>Efficiency Vermont Program</li>
                        <li>Lamprecycle</li>
                    </ul>
                </p>
            </div>
        <a class="accordion"><i class="fa fa-info-circle"></i>&nbsp;Contact and Location</a>
            <div class="panel">
                <p><span class="contactinfo"><a href="https://goo.gl/maps/Qn1piCjdYL82">Homeport 52 Church Street Burlington, Vermont 05401</a></span></p>
                <div class="contactinfo"><a href="tel:802-863-4644">Phone: &#40;802&#41;-863-4644</a></div>
                <div class="contactinfo">Fax: &#40;802&#41;-660-0525</div>
                <p><a href="contact.php" class="emailbtn">Click to Email Homeport!</a></p>
            </div>
        <a class="accordion"><i class="fa fa-shipping-fast"></i>&nbsp;Do You Ship?</a>
            <div class="panel">
                <p> <span class="contactinfo">Yes We Do!</span></p>
                <p class="storestory">We can ship most of the items you see on the website within the continental US!</p>
                    <span class="contactinfo">***However***</span>
                <p class="storestory">
                    Most furniture and other large items are not available to ship at this time,
                    and should be purchased through the website only if pickup from our Brick and Mortar location is possible.
                </p>
            </div>
        <a class="accordion"><i class="fa fa-question-circle"></i>&nbsp;Other FAQ</a>
            <div class="panel">
                <p class="storestory">
                    <i class="fa fa-question-circle"></i>&nbsp;I've Seen something in the store that you don't have on the website, does that mean you don't have it anymore?
                    <ul class="storestory">
                        <li>
                            We carry many more items instore than we are able to put online, but if you call the store to notify us, we can usually make the item available in minutes!
                        </li>
                    </ul>
                </p>
            </div>
    <script src="js/accordion.js"></script><!--must always go AFTER accordion content-->
        <div class="bottomlinks">     
            <a href="index.php">Exit</a>
        </div>
    </div>
    <!--Page Content Ends Here-->
        
    <!--Department overlay Starts here-->
    <?php include 'z_overlay.php'; ?>   
</body>
</html>