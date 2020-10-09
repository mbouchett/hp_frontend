<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/storeInfo.php
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
<link rel="SHORTCUT ICON" href="images/icon.ico">
<title>Homeport Terms &amp; Conditions</title>
    <!--these two links needs to be placed at the top of every page--> 
    <link rel="stylesheet" href="webfonts/fonts.css" type="text/css" /> 
    <link rel="stylesheet" href="icons/all.css" type="text/css">
    
    <link rel="stylesheet" href="css/storeInfo.css" type="text/css" />
    <link rel="stylesheet" href="css/accordion.css" type="text/css" />
    
</head>
<body>
    <!--This Is the Banner copy this into any page that need a header-->
    <?php include 'z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle"><i class="fa fa-gift"></i>&nbsp;Contest/Giveaway Terms and Conditions&nbsp;<i class="fa fa-file-contract"></i></div>
        
		<a class="accordion"><i class="fa fa-info-circle"></i>&nbsp;How to Enter</a>
            <div class="panel">
                <p class="storestory">The contest or giveaway post on our social media will explain the entry procedure. There is no entry fee and no purchase necessary to enter. Only one entry will be accepted per person, multiple entries from the same person will be disqualified, unless explicitly stated otherwise in the Social Media post. By entering a contest or giveaway, you will not be eligible to receive any prizes awarded in any other contest or giveaway unless you enter each separately.</p>
            </div>
		<a class="accordion"><i class="fa fa-exclamation-circle"></i>&nbsp;Eligibility</a>
            <div class="panel">
                <p class="storestory"><b>If you participate in Homeport’s contests and giveaways you fully accept these general terms and conditions of Homeport LTD and you acknowledge that you fulfill all eligibility requirements.</b>

      
                <br><br>
                    <ul class="storestory">
                        <li>If you are under the age of 18, you will have to obtain the approval of your parents or legal guardians to enter to any contest or giveaway. Homeport may ask you, at any stage, to provide us with proof of age and/or identity and/or proof of such approval, if relevant. Homeport may exclude any participants who are not able to provide with such proof. Employees of Homeport are not eligible to participate.</li>
                        <li>Contest or giveaways shall start and close on the date specified on the Homeport Social Media posts. Entries after the closing date and time will not be allowed. Homeport reserves the right to disregard any entry considered to be rude, inflamitory or profane.</li>
                    </ul>
                </p>
            </div>
        
        <a class="accordion"><i class="fa fa-award"></i>&nbsp;Winning!</a>
			<div class="panel">		
				<p class="storestory">The winner will be chosen at random from all eligible entries. The winner will be notified by DM on Instagram or Facebook via our official Homeport account within five business days after the closing date of the contest or giveaway. If the winner cannot be contacted or does not claim the prize within 48 hours, Homeport reserves the right to withdraw the prize from the winner and pick a replacement winner. Homeport’s decision in respect of all matters to do with the contest or giveaway will be final and shall not be subject to review or appeal by any entrant or by any third party.
				</p>
			</div>
		<a class="accordion"><i class="fa fa-gift"></i>&nbsp;The Prize</a>
			<div class="panel">		
				<p class="storestory">The promotional prize shall be a Homeport product as indicated on the Homeport Social Media post. The prize is as stated and no cash or other alternatives will be offered. The prizes are not transferable. Prizes are subject to availability and we reserve the right to substitute any prize with another of equivalent value without giving notice.
				</p>
			</div>
        <a class="accordion"><i class="fa fa-question-circle"></i>&nbsp;More Questions, Contact Us!</a>
            <div class="panel">
                <p><span class="contactinfo"><a href="https://goo.gl/maps/Qn1piCjdYL82">Homeport 52 Church Street Burlington, Vermont 05401</a></span></p>
                <div class="contactinfo"><a href="tel:802-863-4644">Phone: &#40;802&#41;-863-4644</a></div>
                <div class="contactinfo">Fax: &#40;802&#41;-660-0525</div>
                <p><a href="contact.php" class="emailbtn">Click to Email Homeport!</a></p>
            </div>
    <script src="js/accordion.js"></script><!--must always go AFTER accordion content-->
        <div class="bottomlinks">     
            <a href="index.php">Exit</a>
        </div>
    </div>
    <!--Page Content Ends Here-->
        
    <!--Department overlay Starts here-->
    <?php include 'z_overlay.php'; ?>   
</body>
</html>