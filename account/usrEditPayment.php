<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/usrEditPayment.php
*/

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/_unMash.php";


// ****************** initializes variables *******************
$loggedIn = 0;
$cartCount =  0;
@$branch = $_REQUEST['branch']; 
@$alert = $_REQUEST['alert'];
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

// ******************** get Payment Options *******************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `wm_ID`,`wm_card`,`wm_zip` FROM `web_method` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
@$payCount = mysqli_num_rows($result);
mysqli_close($db); 
if($payCount){
	for($i=0; $i<$payCount; $i++){
		$pay[$i] = mysqli_fetch_assoc($result);
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
<title>Edit Payment</title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
    <link rel="stylesheet" href="css/usrEditPayment.css" type="text/css" />
    <script src="js/usrEditPayment.js"></script>
</head>
<body>

	<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle">Edit Payment Options</div>
        
        <div class="editpaymentform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions"><i class="fa fa-edit"></i>&nbsp;Edit or Add Payment Methods</div>
            <?php } ?>
                <div class="paymentoptions">
                <?php if($payCount > 0) { ?>
                    <div class="delineator">Select a Payment Option to Edit</div>
                    <?php for($i = 0; $i < $payCount; $i++) { ?>
                    <div class="savedcard">
                        <div><i class="fa fa-credit-card"></i>&nbsp;Card Ending in ****<?= substr(unmash($pay[$i]['wm_card']),-4) ?></div>
                        <a class="editbtn" href="processDeleteCard.php?card=<?= $pay[$i]['wm_ID'] ?>">Delete</a>
                    </div>
                <?php } } ?>
                <form id="addPayment" action="processAddPayment.php" method="post" name="addPayment" onsubmit="return false;">
                    <div class="delineator">Add a new payment method.</div>
                    <div class="addpaymentfield"  onkeyup="checkForm();" onpaste="checkForm();" onmouseup="checkForm();">
                        <input class="newnumber" placeholder="*Card Number" id="cardNum" type="text" name="cardNum" maxlength="16"  onmouseout="checkForm();">
                        <input class="newmonth" id="mm" placeholder="*MONTH (MM)" type="text" maxlength="2" name="mm"  onmouseout="checkForm();">
                        <input class="newyear" id="yyyy" placeholder="*YEAR (YYYY)" type="text" maxlength="4" name="yyyy"  onmouseout="checkForm();">
                        <input class="newcvv2" id="cvv" placeholder="*CVV" type="text" maxlength="4" name="cvv"  onmouseout="checkForm();">
                    <div class="delineator2" onkeyup="checkForm();" onpaste="checkForm();" onmouseup="checkForm();">Billing Info</div>
                        <input class="phonenumber" placeholder="*Phone Number" id="phone" type="text" name="phone" onmouseout="checkForm();">
                        <input class="newaddress1" placeholder="*Billing Street Address" id="addr1" type="text" name="addr1" onmouseout="checkForm();">
                        <input class="newaddress2" placeholder="(Apt, Suite, etc)" id="addr2" type="text" name="addr2" onmouseout="checkForm();">
                        <input class="newcity" placeholder="*City" id="city" type="text" name="city" onmouseout="checkForm();">
                        <input class="newstate" placeholder="*State" id="state" type="text" name="state" onmouseout="checkForm();">
                        <input class="newzip" placeholder="*Zip Code" id="zip" type="text" name="zip" onmouseout="checkForm();">
                    </div>
                   
                </div>
                <button class="addpaymentbtn" id="addPmtBut" onclick="sendForm()" ><i class="fa fa-plus"></i>&nbsp;Add Payment Option</button>
                <input type="hidden" name="branch" value="<?= $branch ?>">
            </form>
        </div>
        <div class="bottomlinks">     
            <a href="index.php"><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Return To Account</a>
        </div>
    </div>
    
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>