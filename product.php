<?php
    /*  
      Single Item Display Page
    	Mark/Francois Bouchett 2019
    	http://www.homeportonline.com/product.php
    */

	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";
	
	// ************************* Functions ************************
	function safeString($s) {
		@$safeString = filter_var( $s, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		return $safeString;
	}

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
    $relatedItems = [];
    $liked = 0;
    @$user = $_COOKIE['c_ID'];
    @$email = safeString($_REQUEST['email']);
    @$alert = safeString($_REQUEST['alert']);
    @$item_ID = safeString($_REQUEST['item']);
    
    
    @$back = ($_REQUEST['back']) ? safeString($_REQUEST['back']) : 1;


	// Is the item already in the recently viewed
	$re_recent = 0;    
    if($item_ID == @$_COOKIE['rv1']) $re_recent = 1;
    if($item_ID == @$_COOKIE['rv2']) $re_recent = 1;
    if($item_ID == @$_COOKIE['rv3']) $re_recent = 1;
    if($item_ID == @$_COOKIE['rv4']) $re_recent = 1;
    
    if(!$re_recent) {
	    //Update recently viewed
	    if(!isset($_COOKIE['rv1'])) {
	    	setcookie("rv1", $item_ID, time() + (86400 * 30), "/");
	    }elseif(!isset($_COOKIE['rv2'])) {
	    	setcookie("rv2", $item_ID, time() + (86400 * 30), "/");
	    }elseif(!isset($_COOKIE['rv3'])) {
	    	setcookie("rv3", $item_ID, time() + (86400 * 30), "/");
	    }elseif(!isset($_COOKIE['rv4'])) {
	    	setcookie("rv4", $item_ID, time() + (86400 * 30), "/");
	    }else {
	        setcookie("rv3", $_COOKIE['rv4'], time() + (86400 * 30), "/");
			setcookie("rv2", $_COOKIE['rv3'], time() + (86400 * 30), "/");
			setcookie("rv1", $_COOKIE['rv2'], time() + (86400 * 30), "/");
			setcookie("rv4", $item_ID, time() + (86400 * 30), "/");
	    }
    }

	//set up recently viewed Or Random
	unset($recent);
	if(@$_COOKIE['rv1']) $recent[0]['item_ID'] = $_COOKIE['rv1'];
	if(@$_COOKIE['rv2']) $recent[1]['item_ID'] = $_COOKIE['rv2'];
	if(@$_COOKIE['rv3']) $recent[2]['item_ID'] = $_COOKIE['rv3'];
	if(@$_COOKIE['rv4']) $recent[3]['item_ID'] = $_COOKIE['rv4'];
	@$recentCount = ($recent) ? count($recent) : 0;
	
	if($recentCount) {
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		for($i = 0; $i < $recentCount; $i++) {
			$sql = 'SELECT `item_ID`, `item_pic`, `item_desc` FROM `items` WHERE `item_ID`='.$recent[$i]['item_ID'];
			$result = mysqli_query($db, $sql);
			if($result) $recent[$i] =  mysqli_fetch_assoc($result);
		}
		mysqli_close($db);
	}else {
		// if no recently viewed items get 4 random ones	
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql = 'SELECT `item_ID`,`item_pic`, `item_desc` FROM `items` WHERE `item_pic` IS NOT NULL ORDER BY RAND() LIMIT 4';
		$result = mysqli_query($db, $sql);
		@$recentCount = mysqli_num_rows($result);
		mysqli_close($db); 
		//Store the Results To A Local Array
		for($i = 0; $i < 4; $i++){
			$recent[$i] = mysqli_fetch_assoc($result);
		}	
	}
    
	// is this item liked
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `web_likes` WHERE `wc_ID`='.$user.' AND `item_ID`='.$item_ID;
    $result = mysqli_query($db, $sql);
    if($result) $count = mysqli_num_rows($result);
    if(@$count > 0) $liked = 1;
    mysqli_close($db);
    
    //load the item data
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * 
	        FROM `items` 
	        LEFT JOIN `departments` USING (`dept_ID`) 
	        LEFT JOIN `vendors` USING (`vendor_ID`)
	        WHERE `item_ID` = '.$item_ID;
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Lookup Error1!<br>";
		//echo $sql."<br>";
		//echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	$item=mysqli_fetch_assoc($result);	
	$stockMessage = ($item['item_qty'])? "" : "This Item is Temporarily Out of Stock";
	
	//Load Categories for banner
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `main_cats`';
	$result = mysqli_query($db, $sql);
	$catCount = mysqli_num_rows($result);
	mysqli_close($db);
	for($i=0; $i<$catCount; $i++){
		$cat[$i] = mysqli_fetch_assoc($result);
	}
	
	//load 4 related items
	if(!$relatedItems) {
	    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	    $sql = 'SELECT `items`.`item_ID`, `items`.`item_pic`, 
	    			   `departments`.`dept_belongs_to`, `departments`.`dept_name`
	            FROM `items`
	            LEFT JOIN `departments` USING (`dept_ID`) 
	            WHERE `departments`.`dept_belongs_to` ='.$item['dept_belongs_to'].' AND `item_pic` IS NOT NULL 
	            ORDER BY RAND() LIMIT 4';
	    $result = mysqli_query($db, $sql);
    	if(!$result){
    		echo "Related Item Lookup Error!<br>";
    		//echo $sql."<br>";
    		//echo mysqli_error($db);
    		die;
    	}
	    $relatedCount = mysqli_num_rows($result);
	   mysqli_close($db);
	   for($i=0; $i<$relatedCount; $i++){
	       $relatedItems[$i] = mysqli_fetch_assoc($result);
	   }
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

<link rel="SHORTCUT ICON" href="images/icon.ico">
<title>Shop Homeport</title>
    <!--these two links needs to be placed at the top of every page--> 
    <link rel="stylesheet" href="webfonts/fonts.css" type="text/css" /> 
    <link rel="stylesheet" href="icons/all.css" type="text/css">
    
    <link rel="stylesheet" href="css/product.css" type="text/css" />
		<script type="text/javascript" >
		function cookieCheck() {
			if (navigator.cookieEnabled){
				return;
			} 

			// set and read cookie
			alert("Our Shopping Cart Requires Cookies to be enabled,\n Otherwise items will not transfer to checkout");
			return;
		}
		</script>
	</head>
	<body onload="cookieCheck();">
    <!--This Is the Banner copy this into any page that need a header-->
    <?php include 'z_banner.php'; ?>
	
    <div id="container">
        <div class="navbar">
			    <a class="navbtn" onclick="window.location(history.go(-<?= $back ?>))" ><i class="fa fa-angle-left"></i>&nbsp;Back to Browsing</a>
        </div>
        <div class="productcontainer">
            <div class="productimg">
                <img title="sku:<?= $item['item_sku'] ?> - ID:<?= $item['item_ID'] ?>" alt="Product Description" src="<?= resolve($item['item_pic']) ?>">
                <?php if(!$liked) { ?>
                <a href="account/processAddToLikes.php?item=<?= $item['item_ID'] ?>" class="likebtn" title="Like This Item!"><i class="far fa-heart"></i></a>
                <?php }else{ ?>
                <a href="account/processUnlike.php?item=<?= $item['item_ID'] ?>" class="likebtn" title="Unlike This Item!"><i class="fa fa-heart"></i></a>
                <?php } ?>
            </div>
            <div class="productdetails">
                <div class="productdesc">
                    <?= stripslashes($item['item_desc']) ?>
                </div>
                <div class="productcomp">
                    By <a href="vendorPage.php?vendor=<?= $item['vendor_ID'] ?>&vendorName=<?= $item['vendor_name'] ?>"><?= $item['vendor_name'] ?></a>
                </div>
                <div class="productprice"><?= number_format($item['item_retail'],2) ?>
                <?php if($item['item_regPrice']) { ?>
                		<span class="regprice">Reg: <?=  number_format($item['item_regPrice'],2) ?></span><!-- Needs to include &nbsp; if blank -->
                <?php } ?>
                </div>
                <?php if ($stockMessage) { ?>
                <div class="outofstock"><?= $stockMessage ?></div>
                <?php } ?>
                <div class="productbtns">
                    <a class="addtocartbtn" href="cart/processAddToCart.php?item=<?= $item['item_ID'] ?>"><span><i class="fa fa-plus"></i>&nbsp;Add to Cart</span></a>
                    <a class="addtoregbtn" href="registries/processAddToReg.php?item=<?= $item['item_ID'] ?>"><i class="fa fa-gift"></i>&nbsp;Add to Registry</a>
                    <a class="addtowishbtn" href="registries/processAddToWish.php?item=<?= $item['item_ID'] ?>"><i class="fa fa-birthday-cake"></i>&nbsp;Add to Wishlist</a>
                </div>
                <div class="productinfo">
                    <?php if($item['item_details']) { ?>
                    <div class="infotitle">
                        <i class="fa fa-info-circle"></i>&nbsp;Product Details:<br>
                    </div>
                    <!--Item Details info can go here-->
                    <?= stripslashes($item['item_details']) ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--dynamic links are here-->
        <div class="subtitle"><a href="shopItems.php?dept=<?= $item['dept_ID'] ?>&keyName=<?= $relatedItems[0]['dept_name'] ?>"><i class="far fa-clone"></i>&nbsp;Related Items<span class="subtext">See All&nbsp;<i class="fa fa-arrow-right"></i></span></a></div>
        <div class="itemcontainer">
            <div class="item">
                <a href="product.php?item=<?= $relatedItems[0]['item_ID'] ?>" ><img src="<?= resolve($relatedItems[0]['item_pic']) ?>" alt="Store Front"></a>
            </div>
            <div class="item">
                <a href="product.php?item=<?= $relatedItems[1]['item_ID'] ?>" ><img src="<?= resolve($relatedItems[1]['item_pic']) ?>" alt="Store Front"></a>
            </div>
            <div class="item">
                <a href="product.php?item=<?= $relatedItems[2]['item_ID'] ?>" ><img src="<?= resolve($relatedItems[2]['item_pic']) ?>" alt="Store Front"></a>
            </div>
            <div class="item">
                <a href="product.php?item=<?= $relatedItems[3]['item_ID'] ?>" ><img src="<?= resolve($relatedItems[3]['item_pic']) ?>" alt="Store Front"></a>
            </div>
        </div>
        
            <!-- ************************************************** Recently Viewed ************************************************** -->
            <?php if(@$_COOKIE['rv1']) { ?>
            <div class="subtitle"><i class="fa fa-eye"></i>&nbsp;Recently Viewed Items</div>
            <?php }else { ?>
            <div class="subtitle"><a href="departments.php"><i class="fa fa-eye"></i>&nbsp;Random Stuff<span class="subtext">See All&nbsp;<i class="fa fa-arrow-right"></i></span></a></div>
            <?php } ?>
            <div class="itemcontainer">
				<?php for($i = 0; $i < $recentCount; $i++) { ?>
                <div class="item">
					<a href="product.php?item=<?= $recent[$i]['item_ID'] ?>" title="<?= $recent[$i]['item_desc'] ?>">
                    	<img src="<?= resolve($recent[$i]['item_pic']) ?>" alt="<?= $recent[$i]['item_desc'] ?>">
                    </a>
                </div>
                <?php } ?>
            </div>   
        
    </div>
    <!--Department overlay Starts here-->
    <?php include 'z_overlay.php'; ?>
       
    <!--Everthing For the Footer begins Here-->
    <?php include 'z_footer.php'; ?>
</body>
</html>