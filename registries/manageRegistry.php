<?php
/* Access User Profile
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/index.php
*/
	@include "/home/homeportonline/crc/2018.php";

	
if(!isset($_COOKIE['c_ID'])){
	header('Location: ../index.php');
	die;	
}

// find out if user has a registry
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_cust` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
mysqli_close($db);
$cust=mysqli_fetch_assoc($result);

if(!$cust['wc_event_date']) {
	header('Location: createReg.php');
	die;	
}
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
	<link rel="SHORTCUT ICON" href="../images/icon.ico">
	<meta charset="utf-8" />
	<title>My Account: <?= $_COOKIE['c_name'] ?></title>
	    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
        <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
        <link rel="stylesheet" href="css/manageRegistry.css" type="text/css" />
</head>
<body>
<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="usermenucontainer">
        <div class="featuretitle"><?= $_COOKIE['c_name'] ?> Edit Your Registry!</div>
        
        <?php if($alert) { ?>
        <div><?= $alert ?></div>
        <?php } ?>
        
        <div class="usermenu">
            <a class="userbtn" href="../departments.php"><i class="fa fa-plus"></i>&nbsp;Add Items</a>
            <a class="userbtn" href="manageRegItems.php"><i class="fa fa-gift"></i>&nbsp;Manage Items</a>
            <a class="userbtn" href="regUpdateDetails.php"><i class="fa fa-users-cog"></i>&nbsp;Update Registry Details</a>
            <a class="userbtn" href="../registries/viewThankYou.php"><i class="fa fa-file-signature"></i>&nbsp;View Thank-You List</a> 
        </div>
        <div class="bottomlinks">
            <a href="../account/index.php"><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Back to Account</a>
        </div>
    </div>
        <?php include '../z_sub/z_overlay.php'; ?>

</body>
</html>