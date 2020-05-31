<?php
/* Edit User Profile
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/usrEditPrifile.php
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
@$alert = $_REQUEST['alert'];

// Get User data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "Select * from `web_cust` WHERE `wc_ID` = ".$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);

// on query error
if(!$result){
	echo "User Load Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$user=mysqli_fetch_assoc($result);

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

	<link rel="SHORTCUT ICON" href="../images/icon.ico">
	<meta charset="utf-8" />
	<title>Profile Edit: <?= $user['wc_fname'] ?> </title>
        <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> <!--this needs to be placed anywhere the fonts are used-->
        <link rel="stylesheet" href="../icons/all.css" type="text/css"> <!--this needs to be placed anywhere icons are used-->
        <link rel="stylesheet" href="css/usrEditProfile.css" type="text/css" />
	<script src="js/usrEditProfile.js"></script> 
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
                <form id="usrEditProfile" action="processUsrEditProfile.php" method="post" name="usrEditProfile">
                   
                        
                        <input id="fname" type="text" name="fname" value="<?= $user['wc_fname'] ?>">
                        <input id="lname" type="text" name="lname" value="<?= $user['wc_lname'] ?>">
                        <input id="email" type="text" name="email" value="<?= $user['wc_email'] ?>">
                        <input id="phone" type="text" name="phone" value="<?= $user['wc_phone'] ?>" placeholder="Phone Number">
                        <a class="profilebtn" onclick="document.usrEditProfile.submit()"><i class="fa fa-save"></i>&nbsp;Save Changes</a>
                        <a class="profilebtn" href="changePassword.php"><i class="fa fa-key"></i>&nbsp;Change Password</a>   
                    <button hidden="" onclick="checkForm(event);"></button>
                        
                </form>
            </div>
        <div class="profilelinks">
	        <a href="index.php" ><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Return To Account</a>
        </div>
    </div>
    
</body>
</html>