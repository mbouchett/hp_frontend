<?php
    /*  
        Wishlist Display Page
    	Mark/Francois Bouchett 2019
    	http://www.homeportonline.com/registries/manageWishItems.php
    */

	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";

	
    $loggedIn = 0;
    $cartCount =0;
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
    
	//Get your wishlist
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, `items`.`item_retail`, `items`.`item_pic`, 
	               `web_wish`.`wish_ID`,`web_wish`.`wish_qty`, `web_wish`.`wish_fund`, `web_wish`.`wish_fundAmt` 
	        FROM `web_wish` 
	        LEFT JOIN `items` USING (`item_ID`) 
	        WHERE `wc_ID`='.$_COOKIE['c_ID'].'
	        ORDER BY `wish_ID` DESC';
	$result = mysqli_query($db, $sql);  
	if(!$result){
		echo "Update No Good!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	if($result) {    	
		$wwCount = mysqli_num_rows($result);  
		for($i = 0;$i < $wwCount; $i++) {
			$ww[$i] = mysqli_fetch_assoc($result);
			$ww[$i]['percent'] = ceil(($ww[$i]['wish_fundAmt'] / $ww[$i]['item_retail']) * 100);
		}
	}
	mysqli_close($db);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Homeport Shopping Cart</title>
    <!--the following two stylesheets need to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" />
    <link rel="stylesheet" href="../icons/all.css" type="text/css">
    <!--Stylesheet for this specific page-->
    <link rel="stylesheet" href="css/manageWishItems.css" type="text/css" />
    <script src="js/manageWishItems.js" ></script>
</head>
<body>
    <!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle"><i class="fa fa-birthday-cake"></i>&nbsp;Your Wishlist!</div>
        <div class="reglink"><a onclick="copy();">Copy Link</a></div>
        <div class="subfeaturetitle">*Just click the button above to copy your wishlist and paste to share with anyone!</div>
		<form id="pmwi" action="processManageWishItems.php" method="post">
        <div class="updatequancontainer"><a onclick="submit()" class="updatequan">Update Quantaties <i class="fa fa-redo"></i></a></div>
        <div class="cartlabels">
            <div class="cartlabeldesc">Desription</div>
            <div class="cartlabelprice">Price</div>
            <div class="cartlabelquan">Quantity</div>
        </div>
        <?php for($i = 0;$i < $wwCount; $i++) { ?>        
        <!--******Item Begins Here*******-->
        <div class="cartitemcontainer">
            <div class="imgcontainer"><img src="<?= resolve($ww[$i]['item_pic']) ?>" alt="<?= $ww[$i]['item_desc'] ?>"></div>
            <div class="link">
                <a class="desclink" href="../product.php?item=<?= $ww[$i]['item_ID'] ?>"><?= $ww[$i]['item_desc'] ?></a>
            </div>
            <div class="price"><?= number_format($ww[$i]['item_retail'],2) ?></div>
            <div class="options">
                <input name="qty[<?= $i ?>]" onkeyup="checkKey(event.key)" type="text" value="<?= $ww[$i]['wish_qty'] ?>">
                <a class="removebtn" href="processRemWish.php?id=<?= $ww[$i]['wish_ID'] ?>" title="Remove From Wishlist"><i class="fa fa-trash-alt"></i></a>
                <?php if($ww[$i]['item_retail'] > 99.99 && !$ww[$i]['wish_fund']) { ?>
                <a class="fundbtn" href="processFundItem.php?id=<?= $ww[$i]['wish_ID'] ?>" title="Crowd Fund This Item"><i class="far fa-square"></i>&nbsp;&nbsp;<i class="fa fa-hand-holding-usd"></i></a>
				<?php } ?>
				<?php if($ww[$i]['item_retail'] > 99.99 && $ww[$i]['wish_fund'] && $ww[$i]['wish_fundAmt'] == 0) { ?>
				<a class="fundbtnactive" href="processUnFundItem.php?id=<?= $ww[$i]['wish_ID'] ?>" title="This item is crown funded - Click to turn off"><i class="far fa-check-square"></i>&nbsp;&nbsp;<i class="fa fa-hand-holding-usd"></i></a>
				<?php  } ?>
				<?php if($ww[$i]['item_retail'] > 99.99 && $ww[$i]['wish_fund'] && $ww[$i]['wish_fundAmt'] > 0) { ?>
				<?= $ww[$i]['percent'] ?> % Funded
				<?php  } ?>
            </div>
        </div>
        <input type="hidden" name="id[<?= $i ?>]" value="<?= $ww[$i]['wish_ID'] ?>">
        <!--******Item Ends Here******-->
        <?php } ?>
        <div class="updatequancontainer"><a onclick="submit()" class="updatequan">Update Quantaties <i class="fa fa-redo"></i></a></div>
        </form>
    </div>
    
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
       
    <!--Everthing For the Footer begins Here-->
    <?php include '../z_sub/z_footer.php'; ?>
    <input style="visibility: hidden;" type="text" id="wishAddr" value="http://www.homeportonline.com/registries/shopWishlist.php?cust=<?= $_COOKIE['c_ID'] ?>" />
</body>
</html>