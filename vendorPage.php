<?php
	/* Homeport Website Front Page
		Mark/Francois Bouchett 2019
		http://www.homeportonline.com/vendorPage.php
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
	$recentCount = 0;
	$likeCount = 0;
	@$vendor = safeString($_REQUEST['vendor']);
	@$vendorName = safeString($_REQUEST['vendorName']);
	
	@$selectedPage = safeString($_REQUEST[page]);//What page are we currently on
    if(!$selectedPage) $selectedPage = 1;       //if none selected then page 1 
    $DISP = 24;                                  //How many items per page
    $TABS = 5;                                  //How Many Tabs
    $nav = 1;                                   // Navigation enabled by default
	
	
	$today = date('Y-m-d');
	
	//set up recently viewed Or Random
	if($loggedIn) {
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql = 'SELECT * 
				  FROM `web_recent` 
				  WHERE `web_recent`.`wc_ID` = '.$_COOKIE['c_ID'].' 
				  ORDER BY `wr_date` DESC 
				  Limit 4';
		$result = mysqli_query($db, $sql);
		@$recentCount = mysqli_num_rows($result);
		mysqli_close($db); 
		//Store the Results To A Local Array
		for($i=0; $i<$recentCount; $i++){
			$recent[$i] = mysqli_fetch_assoc($result);
		}	
	}
	
	if(!$recentCount){
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql = 'SELECT * 
				  FROM `items` 
				  WHERE `item_pic` IS NOT NULL 
				  ORDER BY RAND() LIMIT 4';
		$result = mysqli_query($db, $sql);
		$randCount = mysqli_num_rows($result);
		mysqli_close($db); 
		//Store the Results To A Local Array
		for($i=0; $i<$randCount; $i++){
			$rand[$i] = mysqli_fetch_assoc($result);	
		}	
	}
	
	//Get your bad self some items
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, `items`.`item_retail`, 
				   `items`.`item_pic`, `items`.`item_regPrice`, `items`.`item_qty`, 
	               `departments`.`dept_belongs_to`  
	        FROM `items` 
	        LEFT JOIN `departments` USING (`dept_ID`) 
	        WHERE `vendor_ID`='.$vendor.' AND `item_pic` IS NOT NULL';
	$result = mysqli_query($db, $sql);      
	mysqli_close($db);
	$all = mysqli_num_rows($result);

	//Get yourself a page of items
	$offset = ($selectedPage - 1) * $DISP;
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `items`.`item_ID`, `items`.`item_sku`, `items`.`item_desc`, `items`.`item_retail`, 
				   `items`.`item_pic`, `items`.`item_regPrice`, `items`.`item_qty`, 
	               `departments`.`dept_belongs_to`  
	        FROM `items` 
	        LEFT JOIN `departments` USING (`dept_ID`) 
	        WHERE `vendor_ID`='.$vendor.' AND `item_pic` IS NOT NULL 
	        ORDER BY `item_qty` DESC  
           LIMIT '.$offset.', 24';
	$result = mysqli_query($db, $sql);  
	mysqli_close($db);
	$itemCount = mysqli_num_rows($result);
	
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i=0; $i<$itemCount; $i++){
	   $item[$i] = mysqli_fetch_assoc($result);	
	   // if logged in check if  liked
	    if($loggedIn) {
			$sql = 'SELECT * FROM `web_likes` WHERE `wc_ID`='.$_COOKIE['c_ID'].' AND `item_ID`='.$item[$i]['item_ID'];
    		$like_result = mysqli_query($db, $sql);
    		$count = mysqli_num_rows($like_result);
    		$item[$i]['liked'] = ($count > 0) ? TRUE : FALSE;
    	}
	}
	mysqli_close($db);
	
	// calculate pagey tabby stuff
	$pages = ceil($all/$DISP);
	if($pages < $TABS){ 
        $TABS = $pages;
        $nav = 0;
    }
    $tabpos = $selectedPage -3; //tab defaults to the middle tab
    if ($tabpos < 0) $tabpos = 0;
    if(($tabpos+5) > $pages) $tabpos = $pages - $TABS;
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

		<title>Homeport - Burlington Vermont</title>
		<link rel="SHORTCUT ICON" href="images/icon.ico">
		<meta name="description=" content="
			Located on Burlington's pedestrian only Church Street, 
			Homeport has three and a half floors of everything you want for your home. 
			From kitchen gadgets to floor lamps, placemats to sofas, and candles to shower curtains, 
			we probably have what you need, even if you didn't know you needed it!"/>
         
        <!--these two links needs to be placed at the top of every page--> 
        <link rel="stylesheet" href="webfonts/fonts.css" type="text/css" /> 
        <link rel="stylesheet" href="icons/all.css" type="text/css">
        
        <link rel="stylesheet" href="css/items.css" type="text/css" />
	</head>
	<body>
	
	<!--This Is the Banner copy this into any page that need a header-->
    <?php include 'z_banner.php'; ?>
        <!--Page Content goes here-->
        <div class="pagecontainer">

            
            <div class="navbar">
                Viewing Item Results for &quot;<?= $vendorName ?>&quot;</span>
            </div>
            
            <!-- This is the upper navigation bar -->
            <?php if($all > 0) { ?>
			<div class="navbar">
			    <?php if($nav) { ?>
			    <a class="navbtn" href="vendorPage.php?vendorName=<?= $vendorName ?>&vendor=<?= $vendor ?>&page=1" ><i class="fa fa-angle-double-left"></i>...</a>
			    <?php } ?>
			    
			    <?php for($i = $tabpos; $i < ($tabpos+$TABS); $i++) {  
			          $class = "pagebtn";
			          if($selectedPage == ($i+1)) $class = "pagebtn select" ;
			    ?>
                <a class="<?= $class ?>" href="vendorPage.php?vendorName=<?= $vendorName ?>&vendor=<?= $vendor ?>&page=<?= ($i+1) ?>"><?= ($i + 1) ?></a>
                <?php } ?>
                <?php if($pages > $TABS && $i < $pages ) { ?>
                <a class="navbtn" href="vendorPage.php?vendorName=<?= $vendorName ?>&vendor=<?= $vendor ?>&page=<?= $pages ?>" >...<?= $pages ?></a>
                <?php } ?>                
            </div>
            
            <!-- Qulified items appear here -->
            <div class="itemcontainer">
                <?php for($i = 0; $i < $itemCount; $i++) { 
                    @$class = ($item[$i]['liked']) ? "fa fa-heart" : "far fa-heart";
                    @$title = ($item[$i]['liked']) ? "Un-Like This Item" : "Like This Item!";
                    @$href = ($item[$i]['liked']) ? "processUnlike" : "processAddToLikes";
                ?>
                <div class="item">
                    <a href="account/<?= $href ?>.php?item=<?= $item[$i]['item_ID'] ?>" class="likebtn" title="<?= $title ?>"><i class="<?= $class ?>"></i></a>
                    <a class="productlink" href="product.php?item=<?= $item[$i]['item_ID'] ?>">
                        <img title="sku:<?= $item[$i]['item_sku'] ?> - ID:<?= $item[$i]['item_ID'] ?>" src="<?= resolve($item[$i]['item_pic']) ?>" alt="<?= $item[$i]['item_desc'] ?>">
                        <div class="pricetag">
                                <?php if($item[$i]['item_regPrice']) { ?>
                                <span class="regprice strike">Reg: <?=  number_format($item[$i]['item_regPrice'],2) ?></span><!-- Needs to include &nbsp; if blank -->
                                <?php }else { ?>
                                <span class="regprice">&nbsp;</span>
                                <?php } ?>
                                <?php if(!$item[$i]['item_qty']) { ?>
                                Out of Stock<!-- This appears if the item is out of stock -->
                                <?php }else{ ?>
                                <?= number_format($item[$i]['item_retail'],2) ?>
                                <?php } ?>
                        </div>
                        <div class="itemdescription"><?= stripslashes($item[$i]['item_desc']) ?></div>
                    </a>
                    <div class="itembtns">
                        <a class="addtocartbtn" href="cart/processAddToCart.php?item=<?= $item[$i]['item_ID'] ?>"><i class="fa fa-plus"></i>&nbsp;Add to Cart</a>
                        <a class="addtoregbtn" href="registries/processAddToReg.php?item=<?= $item[$i]['item_ID'] ?>"><i class="fa fa-gift"></i>&nbsp;Add to Registry</a>
                        <a class="addtowishbtn" href="registries/processAddToWish.php?item=<?= $item[$i]['item_ID'] ?>"><i class="fa fa-birthday-cake"></i>&nbsp;Add to Wishlist</a>
                    </div>
                </div>
                <?php } ?>
            </div>


            <?php } ?>
            <div class="navbar">
			    <?php if($nav) { ?>
			    <a class="navbtn" href="vendorPage.php?vendorName=<?= $vendorName ?>&vendor=<?= $vendor ?>&page=1" ><i class="fa fa-angle-double-left"></i>...</a>
			    <?php } ?>
			    
			    <?php for($i = $tabpos; $i < ($tabpos+$TABS); $i++) {  
			          $class = "pagebtn";
			          if($selectedPage == ($i+1)) $class = "pagebtn select" ;
			    ?>
                <a class="<?= $class ?>" href="vendorPage.php?vendorName=<?= $vendorName ?>&vendor=<?= $vendor ?>&page=<?= ($i+1) ?>"><?= ($i + 1) ?></a>
                <?php } ?>
                <?php if($pages > $TABS && $i < $pages ) { ?>
                <a class="navbtn" href="vendorPage.php?vendorName=<?= $vendorName ?>&vendor=<?= $vendor ?>&page=<?= $pages ?>" >...<?= $pages ?></a>
                <?php } ?>                
            </div>
        </div>
        <!--Page Content Ends Here-->
			
        <!--Department overlay Starts here-->
        <?php include 'z_overlay.php'; ?>
        
        <!--Everthing For the Footer begins Here-->
        <?php include 'z_footer.php'; ?>
	</body>
</html>