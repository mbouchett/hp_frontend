<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/contact.php
*/

	
	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";
	
@$branch = $_REQUEST['branch'];
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

// ******************* get Shipping Options *******************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `wa_ID`,`wa_line1`, `wa_zip` FROM `web_addr` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
$addrCount = mysqli_num_rows($result);
mysqli_close($db); 
if($addrCount){
	for($i=0; $i<$addrCount; $i++){
		$addr[$i] = mysqli_fetch_assoc($result);
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
<title>Edit Address</title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
    <link rel="stylesheet" href="css/usrEditAddress.css" type="text/css" />
    <script src="js/addAddress.js"></script>
</head>
<body>

	<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle">Edit Shipping Address</div>
        
        <div class="editaddressform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions"><i class="fa fa-edit"></i>&nbsp;Edit or Add a Shipping Address</div>
            <?php } ?>
            <form id="form" action="processAddAddress.php" method="post" name="addPayment">
                <div class="paymentoptions">
                    <div class="delineator">Select an Address to Edit</div>
                    <?php for($i=0; $i<$addrCount; $i++){ ?>
                    <div class="savedaddress">
                        <div><i class="fa fa-address-book"></i>&nbsp;<?= $addr[$i]['wa_line1'] ?></div>
                        <a class="editbtn" href="editAddress.php?wa_ID=<?= $addr[$i]['wa_ID'] ?>">Edit</a>
                    </div>
                    <?php } ?>
                    
                    <div class="delineator">Add a Shipping Address.</div>
                    
                    <div class="addaddressfield">
                        <input class="newaddress1" placeholder="Shipping Street Address" id="line1" type="text" name="line1">
                        <input class="newaddress2" placeholder="(Apt, Suite, etc)" id="line2" type="text" name="line2">
                        <input class="newzip" placeholder="Zip Code" id="zip" type="text" name="zip">
                    </div>
                   
                </div>
                <button onclick="return validate();" class="addaddressbtn" type="submit"><i class="fa fa-plus"></i>&nbsp;Add New Address</button>
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