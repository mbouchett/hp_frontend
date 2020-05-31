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
$hasReg = 0;
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
if($loggedIn) {
	// see if user already has a registry
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql  = 'SELECT *  FROM `web_cust` WHERE `wc_ID` = '.$_COOKIE['c_ID'];
	$result = mysqli_query($db, $sql);
	mysqli_close($db);
	$cust = mysqli_fetch_assoc($result);
	if($cust['wc_event_date']) $hasReg = 1;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Homeport Sign In</title>
    <!--these two links needs to be placed at the top of every page--> 
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> 
    <link rel="stylesheet" href="../icons/all.css" type="text/css">
    
    <link rel="stylesheet" href="css/index.css" type="text/css" />
</head>
<body>
    <!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle">I want to...</div>
        <div class="options">
            <a class="optionbtn" href="regSearch.php"><i class="fa fa-search"></i>&nbsp;Find a Registry</a>
            <?php if(!$hasReg) { ?>
            <a class="optionbtn" href="createReg.php"><i class="fa fa-gift"></i>&nbsp;Create or Manage My Registry!</a>
            <?php }else { ?>
            <a href="manageRegistry.php" class="optionbtn"><i class="fa fa-cog"></i>&nbsp;Manage My Registry!</a>
            <?php } ?>
        </div>
        <div class="bottomlinks">     
            <a href="../index.php">Exit</a>
        </div>
    </div>
    
    </div>
    
    <!--Page Content Ends Here-->
        
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
        
    <!--Everthing For the Footer begins Here-->
    <?php include '../z_sub/z_footer.php'; ?>
</body>
</html>