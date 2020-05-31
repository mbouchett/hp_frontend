<?php
// createReg.php

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";


// ****************** initializes variables *******************
$loggedIn = 0;
$cartCount =  0;
$recentCount = 0;
$likeCount = 0;	
@$z = ($_REQUEST['z']) ? $_REQUEST['z'] : -1;
$checked = "";
$naStyle = "";
	
$cartTotItems = 0;
	
// ********** checks to see if the user is logged in **********
if(isset($_COOKIE['c_ID'])) $loggedIn = 1;
if(!$loggedIn) {
	header('Location: ../account/signIn.php?branch=createReg');
	die;
}

// ******************* Gets The Cart Count ********************

if(isset($_COOKIE['c_cart'])){
    $cart = unserialize($_COOKIE['c_cart']);
    $cartCount = count($cart);
    for(!$i = 0; $i < $cartCount; $i++) {
        $cartTotItems = $cartTotItems + $cart[$i]['qty'];
    }
}

// ********** Does the user already have a registry ***********
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_cust` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
mysqli_close($db); 
$cust = mysqli_fetch_assoc($result);
if($cust['wc_event_date']) {
	header('location: manageRegistry.php');
}

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
    <meta charset="utf-8" />
    <title>Create Registry</title>
    <script src="js/createReg.js"></script>
    <!--these two links needs to be placed at the top of every page--> 
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> 
    <link rel="stylesheet" href="../icons/all.css" type="text/css">    
    <link rel="stylesheet" href="css/createReg.css" type="text/css" />
</head>
<body onload="loadCheck();">
    <?php include '../z_sub/z_banner.php'; ?>
    <div id="createregcontainer">
        <!--This Is the Banner copy this into any page that need a header-->
        <div class="featuretitle">Create Your Registry</div>
        <div class="createregform">
        
            <form action="processCreateReg.php" method="post">
                <div class="delineator"><i class="fa fa-address-card"></i>&nbsp;Registry Event Date and Contact Info</div>
                <div onkeyup="validate();" class="textfield">
                    <input class="regmonth" id="mm" type="text" name="eMonth" placeholder="MM" maxlength="2">
                    <input class="regdivider" type="text" placeholder="/" disabled>
                    <input class="regday" id="dd" type="text" name="eDay" placeholder="DD" maxlength="2">
                    <input class="regdivider" type="text" placeholder="/" disabled>
                    <input class="regyear" id="yyyy" type="text" name="eYear" placeholder="YYYY" maxlength="4">
                    <input class="regphone" id="phone" type="text" name="phone" placeholder="Phone Number" maxlength="15" value="<?= $cust['wc_phone'] ?>">
                </div>
                <div onkeyup="validate();" class="textfield">
                    <input class="regpartnerfn" id="fn" type="text" name="fn" placeholder="Partner First Name">
                    <input class="regpartnerln" id="ln" type="text" name="ln" placeholder="Partner Last Name">
                    
                </div>
                <div class="delineator2"><i class="fa fa-shipping-fast"></i>&nbsp;Shipping Address for gifts</div>
                
                   <!-- Ship To Address on File -->
                    <?php if($addrCount > 0) {  
                   			for($i = 0;$i < $addrCount; $i++) { 
							$checked = "";
							if(($i+1) == $z) $checked = "checked";                 			
                   			?>
                    <label onclick="shipCalc('<?= $addr[$i]['shipping'] ?>', <?= $i+1 ?>);" class="radiocontainer">Ship to <?= $addr[$i]['wa_line1'] ?>
                        <input type="radio" name="ship" value="<?= $addr[$i]['wa_ID'] ?>" <?=  $checked?>>
                        <span class="radiocheckmark"></span>
                    </label>
                    <?php } } ?>
                <?php $checked="";
                	  if($addrCount == 0 || $z == -2) $checked = "checked" ?>
                <label class="radiocontainer">Add Shipping Address
                    <input id="radio_addShip" type="radio" name="ship" <?= $checked ?>>
                    <span class="radiocheckmark"></span>
                </label>
                <div onkeyup="validate();" id="na01" class="textfield">
                    <input class="regaddress1" id="addr1" type="text" name="addr1" placeholder="Shipping Address">
                </div>
                <div onkeyup="validate();" id="na02" class="textfield">
                    <input class="regaddress2" id="addr2" type="text" name="addr2" placeholder="(Apt, Suite, etc)">
                    <input class="regzip" id="zip" type="text" name="zip" placeholder="Zip Code">
                </div>
            
                <button class="createregbtn" id="submit" type="submit"><i class="fa fa-glass-cheers"></i>&nbsp;Create Registry</button>
            </form>
        </div>
        <div class="bottomlinks">     
            <a href="../index.php"><i class="fa fa-arrow-circle-left"></i>&nbsp;Exit</a>
        </div>
    </div>
	<!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>