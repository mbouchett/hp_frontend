<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/contact.php
*/

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/functions/f_resolve.php";


// ******************* Initialize Variables *******************
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
if(isset($_COOKIE['c_ID'])){
	$loggedIn = 1; // Is a user logged in
}else {
	die;
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

// ******************* Gets The Cart Count ********************
	if(isset($_COOKIE['c_cart'])){
		$cart = unserialize($_COOKIE['c_cart']);
		$cartCount = count($cart);
	}
	
// ******************* Get registry Items *******************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_reg` WHERE `wc_ID`='.$_COOKIE['c_ID'];
$result = mysqli_query($db, $sql);
$regCount = mysqli_num_rows($result);
mysqli_close($db);
for($i=0; $i<$regCount; $i++){
	$reg[$i] = mysqli_fetch_assoc($result);
}

// ***************** Get registry purchases *****************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `wo_ID`, `item_ID`, `reg_ID`, `wo_qty`, `wo_amt`, `reg_ID`, 
			   `item_pic`, `item_desc`,
			   `web_order`.`wc_ID`, `web_order`.`wa_id`, `web_order`.`wo_date`, `web_order`.`wo_comment`, 
			   `wc_fname`, `wc_lname`
		FROM `web_order_items`
		LEFT JOIN `items` USING (`item_ID`) 
		LEFT JOIN `web_order` USING (`wo_ID`) 
		LEFT JOIN `web_cust` USING (`wc_ID`) 
		WHERE `reg_ID` > 0';
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$itemCount = mysqli_num_rows($result);
mysqli_close($db); 
//Store the Results To A Local Array
for($i=0; $i<$itemCount; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
	@$timestamp = strtotime($items[$i]['wo_date']);
	@$items[$i]['dat'] = date('F d, Y', $timestamp);
	@$items[$i]['good'] = 0;
}

// ************** filter all but this customer **************
for($i=0; $i<$itemCount; $i++){
	for($j=0; $j<$regCount; $j++){
		if($items[$i]['reg_ID'] == $reg[$j]['reg_ID']) @$items[$i]['good'] = 1;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Homeport Gift List</title>
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> 	<!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../icons/all.css" type="text/css"> 		<!--this needs to be placed anywhere icons are used-->
	<link rel="stylesheet" href="css/viewThankYou.css" type="text/css" />
    <script src="../js/deptOverlay.js"></script>
</head>
<body>

	<!--This Is the Banner copy this into any page that need a header-->
    <div class="hiddenforprint"><?php include '../z_sub/z_banner.php'; ?></div>
	
    <div id="container">
        <div class="featuretitle">Here's Your Registry Thank You list!</div>
		<div class="tylist">
			<div class="giftlabels">
				<div class="labelgiftgiver">Gift Giver!</div>
				<div class="labelgiftdesc">Desription</div>
			</div>
			<!--This is a full item and thank you description-->
			<?php 
				for($i = 0; $i < $itemCount; $i++) { 
					if($items[$i]['good']) {
			?>
			<div class="itemcontainer">
				<div class="giftgiverinfo">
					<div class="bold"><?= $items[$i]['wc_fname'] ?> <?= $items[$i]['wc_lname'] ?></div>
					<div><?= $items[$i]['wo_comment'] ?></div>
				</div>
				<div class="giftimage"><img src="<?= resolve($items[$i]['item_pic']) ?>" alt="<?= $items[$i]['item_desc'] ?>"></div>
				<div class="giftdesc">
					<div class="giftdate"><?= $items[$i]['dat'] ?></div>
					<div><?= $items[$i]['item_desc'] ?></div>
					<div class="quantitypurchased">Qty: <?= $items[$i]['wo_qty'] ?>(<?= number_format($items[$i]['wo_amt'],2) ?>)</div>
				</div>
       		</div>
       		<?php } } ?>
			<!--This is where the item ends-->
			<a class="printbtn hiddenforprint" onclick="window.print();return false;">Print Thank You List&nbsp;<i class="fa fa-print"></i></a>
		</div>
        <div class="bottomlinks hiddenforprint">     
            <a href="manageRegistry.php"><i class="fa fa-arrow-alt-circle-left"></i>&nbsp;Back to Manage Registry</a>
        </div>
    </div>
    
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>