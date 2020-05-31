<?php
// createReg.php
@include "/home/homeportonline/crc/2018.php";

$loggedIn = 0;
$cartCount =  0;
$recentCount = 0;
$likeCount = 0;
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

if(!isset($_COOKIE['c_ID'])){
	header('Location: ../account/signIn.php?branch=createReg');
	die;	
}
// get any shipping addresses
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = 'SELECT *  FROM `web_addr` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Addresses Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}else{ 
	$adCount = mysqli_num_rows($result);
	for($i = 0; $i < $adCount; $i++) {
		$ads[$i] = mysqli_fetch_assoc($result); 	
	}
}
mysqli_close($db);

// get registry details
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_cust` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$cust=mysqli_fetch_assoc($result);

// ******************* get Shipping Options *******************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `wa_ID`,`wa_line1`, `wa_zip` FROM `web_addr` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
$addrCount = mysqli_num_rows($result);
mysqli_close($db); 
if($addrCount){
	for($i=0; $i<$addrCount; $i++){
		$addr[$i] = mysqli_fetch_assoc($result);
		$addr[$i]['checked'] = "";
		if($addr[$i]['wa_ID'] == $cust['wa_ID']) $addr[$i]['checked'] = "checked";
	}	
}

// ******************* Gets The Cart Count ********************
	if(isset($_COOKIE['c_cart'])){
		$cart = unserialize($_COOKIE['c_cart']);
		$cartCount = count($cart);
	}
    if(isset($_COOKIE['c_ID'])) $loggedIn = 1; // Is a user logged in
        $today = date('Y-m-d');
        if(isset($_COOKIE['c_cart'])){
		$cart = unserialize($_COOKIE['c_cart']);
		$cartCount = count($cart);
	}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Update Registry</title>
<link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> 
<link rel="stylesheet" href="../icons/all.css" type="text/css">    
<link rel="stylesheet" href="css/regUpdateDetails.css" type="text/css" />
<script src="js/regUpdateDetails.js"></script>
</head>
<body onload="loadCheck();">
    <?php include '../z_sub/z_banner.php'; ?>
    <div id="createregcontainer">
        <div class="featuretitle">Update Your Registry</div>
        <?php if($alert) { ?>
        <div><?= $alert ?></div>
        <?php } ?>
        <div class="createregform">
            <form action="processRegUpdateDetails.php" method="post">
                <div class="delineator"><i class="fa fa-address-card"></i>&nbsp;Registry Event Date and Contact Info</div>
                    <div onkeyup="validate();" class="textfield">
                        <input class="regmonth" id="mm" type="text" name="eMonth" placeholder="MM" maxlength="2" value="<?= substr($cust['wc_event_date'],5,2) ?>">
                        <input class="regdivider" type="text" placeholder="/" disabled>
                        <input class="regday" id="dd" type="text" name="eDay" placeholder="DD" maxlength="2" value="<?= substr($cust['wc_event_date'],8,2) ?>">
                        <input class="regdivider" type="text" placeholder="/" disabled>
                        <input class="regyear" id="yyyy" type="text" name="eYear" placeholder="YYYY" maxlength="4" value="<?= substr($cust['wc_event_date'],0,4) ?>">
                        <input class="regphone" id="phone" type="text" name="phone" placeholder="Phone Number" value="<?= $cust['wc_phone'] ?>" maxlength="15">
                    </div>
                    <div class="textfield" onkeyup="validate();">
                        <input class="regpartnerfn"  id="fn" type="text" name="fn" placeholder="Partner First Name" value="<?= $cust['wc_spouse_fn'] ?>">
                        <input class="regpartnerln" id="ln" type="text" name="ln" placeholder="Partner Last Name" value="<?= $cust['wc_spouse_ln'] ?>"> 
                    </div>
                    
            <div id="addr">
            	<div class="delineator2"><i class="fa fa-shipping-fast"></i>&nbsp;Shipping Address for gifts</div>
                	<?php for($i = 0; $i < $addrCount; $i++) { ?>
                        <label onclick="loadCheck();" class="radiocontainer">Ship to <?= $ads[$i]['wa_line1'] ?> Address
                            <input type="radio" name="ship" value="<?= $ads[$i]['wa_ID'] ?>" <?= $addr[$i]['checked'] ?>>
                            <span class="radiocheckmark"></span>
                        </label>
                    <?php } ?>
                    <label onclick="loadCheck();" class="radiocontainer">Add Shipping Method
                        <input id="radio_addShip" type="radio" name="ship" value="-1">
                        <span class="radiocheckmark"></span>
                    </label>
                    <div id="na01" onkeyup="validate();" class="textfield">
                        <input class="regaddress1" id="addr1" onkeyup="validate();" type="text" name="addr1" placeholder="Shipping Address">
                    </div>
                    <div id="na02" onkeyup="validate();" class="textfield">
                        <input class="regaddress2" id="addr2" onkeyup="validate();" type="text" name="addr2" placeholder="(Apt, Suite, etc)">
                        <input class="regzip" id="zip" onkeyup="validate();" type="text" name="zip" placeholder="Zip Code">
                    </div>
            <input type="hidden" name="wa_ID" value="<?= $addr['wa_ID'] ?>">
            </div>
            <button class="createregbtn" id="submit" type="submit"><i class="fa fa-save"></i>&nbsp;Update Registry</button>
            </form>
        </div>
        <div class="bottomlinks">     
            <a href="manageRegistry.php"><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Back to Manage Registry</a>
        </div>
    </div>
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>