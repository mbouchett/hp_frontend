<?php
/* Edit User Profile
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/usrEditPrifile.php
*/
@include "/home/homeportonline/crc/2018.php";



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
	<title>Homeport Change Password</title>
	<script src="js/changePassword.js"></script>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
    <link rel="stylesheet" href="css/changePassword.css" type="text/css" />
</head>
<body>
    <?php include '../z_sub/z_banner.php'; ?>
    <div id="profilecontainer">
        <div class="featuretitle">Edit your user profile</div>
        <div class="profileform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions">Update your Info!</div>
            <?php } ?>
            <form action="processChangePassword.php" method="post">
                <input type="password" onkeyup="validate()" id="oldPW" name="oldPW" placeholder="Old Password">
                <input type="password" onkeyup="validate()" id="newPW" name="newPW" placeholder="New Password">
                <input type="password" onkeyup="validate()" id="rePW" name="rePW" placeholder="Re-Type New Password">
                <button class="profilebtn" id="savBut" type="submit" disabled><i class="fa fa-save"></i>&nbsp;Save Change</button>
            </form>
        </div>
        <div class="profilelinks">
	        <a href="usrEditProfile.php" ><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Back to Edit Profile</a>
        </div>
    </div>
</body>
</html>