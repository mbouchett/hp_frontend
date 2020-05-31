<?php
// editAddress.php
    @include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";


$loggedIn = 0;
$cartCount =  0;
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
if(!isset($_COOKIE['c_ID'])){
	header('Location: ../account/signIn.php?branch=createReg');
	die;	
}

@$wa_ID = $_REQUEST['wa_ID'];
@$branch = $_REQUEST['branch'];
@$alert = $_REQUEST['alert'];

// get shipping addresses
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = 'SELECT *  FROM `web_addr` WHERE `wa_ID` = '.$wa_ID;
$result = mysqli_query($db, $sql);
$addr = mysqli_fetch_assoc($result); 	
mysqli_close($db);

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
<title>Edit Address</title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
    <link rel="stylesheet" href="css/editAddress.css" type="text/css" />
<script src="js/editAddress.js"></script>
</head>
<body>
    <!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle"><?= $addr['wa_line1'] ?></div>
        
        <div class="editaddressform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions"><i class="fa fa-edit"></i>&nbsp;Edit or Remove Shipping Address</div>
            <?php } ?>
            <form id="editaddress" action="processEditAddress.php" method="post" name="editAddress">
                <div class="paymentoptions">
                    
                    <div class="editaddressfield">
                        <input class="newaddress1" placeholder="Shipping Street Address" id="line1" type="text" name="line1" value="<?= $addr['wa_line1'] ?>">
                        <input class="newaddress2" placeholder="(Apt, Suite, etc)" id="line2" type="text" name="line2" value="<?= $addr['wa_line2'] ?>">
                        <input class="newzip" placeholder="Zip Code" id="zip" type="text" name="zip" value="<?= $addr['wa_zip'] ?>">
                    </div>
                   
                </div>
                <button class="saveaddressbtn" onclick="return validate();" type="submit"><i class="fa fa-save"></i>&nbsp;Save Address</button>
                <a href="processDeleteAddress.php?wa_ID=<?= $addr['wa_ID'] ?>" class="deleteaddressbtn" type="submit"><i class="fa fa-times"></i>&nbsp;Delete Address</a>
                <input type="hidden" name="branch" value="<?= $branch ?>">
	            <input type="hidden" name="wa_ID" value="<?= $wa_ID ?>">
            </form>
        </div>
        <div class="bottomlinks">     
            <a href="usrEditAddress.php"><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Back to Adresses</a>
        </div>
    </div>
    
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>