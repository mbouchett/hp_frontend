<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/contact.php
*/

@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/_unMash.php";

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
@$alert = $_REQUEST['alert'];
$card = $_REQUEST['card'];

// ********************************************* look up card ********************************************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_method` WHERE `wc_ID` = '.$_COOKIE['c_ID'].' AND `wm_ID` = '.$card;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$card=mysqli_fetch_assoc($result);	
$exp = unmash($card['wm_expiry']);
$mm = substr($exp,0,2);
$yyyy = substr($exp,-4);

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
<title>Edit Payment</title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
    <link rel="stylesheet" href="css/editCard.css" type="text/css" />
</head>
<body>

	<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle">Edit Card Ending in ****<?= substr(unmash($card['wm_card']), -4) ?></div>
        
        <div class="editpaymentform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions"><i class="fa fa-edit"></i>&nbsp;Edit or Remove Payment Method</div>
            <?php } ?>
            <form id="addPayment" action="/processAddPayment.php" method="post" name="addPayment">
                <div class="paymentoptions">
                    <div class="addpaymentfield">
                        <input class="newnumber" id="card" value="****<?= substr(unmash($card['wm_card']), -4) ?>" type="text" name="card" maxlength="16" disabled>
                        <input class="newmonth" id="mm" placeholder="MM" type="text" maxlength="2" name="mm" value="<?= $mm ?>">
                        <input class="newdivider" type="text" placeholder="/" disabled>
                        <input class="newyear" id="yyy" placeholder="YYYY" type="text" maxlength="4" name="yyyy" value="<?= $yyyy ?>">
                        <input class="newcvv2" id="cvv" placeholder="CVV" type="text" maxlength="4" name="cvv" value="<?= unmash($card['wm_cvv']) ?>">
                    </div>
                    <div class="addpaymentfield">
                        <input class="newaddress1" placeholder="Billing Street Address" id="addr1" type="text" name="addr1" value="">
                        <input class="newaddress2" placeholder="(Apt, Suite, etc)" id="addr2" type="text" name="addr2" value="">
                        <input class="newzip" placeholder="Zip Code" id="zip" type="text" name="zip" value="">
                    </div>
                   
                </div>
                <button class="savepaymentbtn" type="submit"><i class="fa fa-save"></i>&nbsp;Save Changes</button>
                <button class="deletepaymentbtn" type="submit"><i class="fa fa-times"></i>&nbsp;Delete Payment Option</button>
            </form>
                
        </div>
        <div class="bottomlinks">     
            <a href="usrEditPayment.php"><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Back to Payment Methods</a>
        </div>
    </div>
    
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>