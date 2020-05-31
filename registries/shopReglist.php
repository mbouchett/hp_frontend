<?php
	/* Homeport Website Front Page
		Mark/Francois Bouchett 2019
		http://www.homeportonline.com/items.php
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
	$regCust = safeString($_REQUEST['cust']);
	
	@$selectedPage = $_REQUEST[page];           //What page are we currently on
    if(!$selectedPage) $selectedPage = 1;       //if none selected then page 1 
    $DISP = 24;                                  //How many items per page
    $TABS = 5;                                  //How Many Tabs
    $nav = 1;                                   // Navigation enabled by default
	
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
	$today = date('Y-m-d');
	
	// Look up reg cust
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);	
	$sql  = 'SELECT *  FROM `web_cust` WHERE `wc_ID` = '.$regCust;
	$result = mysqli_query($db, $sql);
	if($result) {
		$wc = mysqli_fetch_assoc($result);
	}else {
		header('location: ../index.php');
		die;
	}
	
	//Get funded items
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);	
	$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, `items`.`item_retail`, `items`.`item_pic`,                                  `items`.`item_qty`, 
	               `web_reg`.`reg_ID`,`web_reg`.`reg_qty`, `web_reg`.`reg_fund`, `web_reg`.`reg_fundAmt` 
	        FROM `web_reg` 
	        LEFT JOIN `items` USING (`item_ID`) 
	        WHERE `wc_ID`='.$regCust.' AND `reg_fund` > 0 
	        ORDER BY `reg_ID` DESC';
	$result = mysqli_query($db, $sql);      
	mysqli_close($db);
	$fundCount = mysqli_num_rows($result);
	for($i=0; $i < $fundCount; $i++){
		$fund[$i] = mysqli_fetch_assoc($result);
		$fund[$i]['balance'] = $fund[$i]['item_retail'] - $fund[$i]['reg_fundAmt'];
		$fund[$i]['fundPercent'] = ceil(($fund[$i]['reg_fundAmt']/$fund[$i]['item_retail']) * 100);
	}
	
	//Get The remainder of the registry items
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, `items`.`item_retail`, `items`.`item_pic`, `items`.`item_qty`, 
	               `web_reg`.`reg_ID`,`web_reg`.`reg_qty`, `reg_recQty`, `web_reg`.`reg_fund`, `web_reg`.`reg_fundAmt` 
	        FROM `web_reg` 
	        LEFT JOIN `items` USING (`item_ID`) 
	        WHERE `wc_ID`='.$regCust.' AND `reg_fund` = 0
	        ORDER BY `reg_ID` DESC';
	$result = mysqli_query($db, $sql); 
	mysqli_close($db);
	$all = mysqli_num_rows($result);

	//Get yourself a page of items
	$offset = ($selectedPage - 1) * $DISP;
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, `items`.`item_retail`, `items`.`item_pic`, `items`.`item_qty`,
	               `web_reg`.`reg_ID`,`web_reg`.`reg_qty`, `reg_recQty`, `web_reg`.`reg_fund`, `web_reg`.`reg_fundAmt` 
	        FROM `web_reg` 
	        LEFT JOIN `items` USING (`item_ID`) 
	        WHERE `wc_ID`='.$regCust.' AND `reg_fund` = 0
	        ORDER BY `reg_ID` DESC 
            LIMIT '.$offset.', '.$DISP;
	$result = mysqli_query($db, $sql);  
	mysqli_close($db);
	$itemCount = mysqli_num_rows($result);
	
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i=0; $i<$itemCount; $i++){
	   $item[$i] = mysqli_fetch_assoc($result);
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
		<title>Homeport - Shop Registry</title>
		<link rel="SHORTCUT ICON" href="../images/icon.ico">
		<meta name="description=" content="
			Located on Burlington's pedestrian only Church Street, 
			Homeport has three and a half floors of everything you want for your home. 
			From kitchen gadgets to floor lamps, placemats to sofas, and candles to shower curtains, 
			we probably have what you need, even if you didn't know you needed it!"/>
         
        <!--these two links needs to be placed at the top of every page--> 
        <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> 
        <link rel="stylesheet" href="../icons/all.css" type="text/css">
        
        <link rel="stylesheet" href="css/registryItems.css" type="text/css" />
        <script type="text/javascript" src="js/shopReglist.js" ></script>
	</head>
	<body>
	
	<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
        <!--Page Content goes here-->
        <div class="pagecontainer">
            <div class="navbar">
                Viewing Registry Items for &quot;<?= $wc['wc_fname'] ?> & <?= $wc['wc_spouse_fn'] ?>&quot;
            </div>
            <!--***************************** funded item begins here ***************************** -->
            <?php if($fundCount > 0) { ?>
            <div class="fundtitle">
                <i class="fa fa-hand-holding-usd"></i>&nbsp;Crowd Funded Registry Items<br>
                <div class="subtitle">Big things can happen when everyone pitches in!</div>
            </div>
            <?php for($i = 0; $i < $fundCount; $i++) { 
			$progBar = ($fund[$i]['fundPercent'] < 4)? 4 :  $fund[$i]['fundPercent'];   
			$fpercent =  $fund[$i]['fundPercent'];    
            ?>
            <div class="funditemcontainer">
                <div class="fundimgcontainer"><img alt="Item Image" src="<?= resolve($fund[$i]['item_pic']) ?>"></div>
                <div class="link">
                    <span class="desclink"><?= $fund[$i]['item_desc'] ?></span>
                </div>
                <div class="options">
                    <div class="price black">
                        <div>Total:</div>
                        <div><?= number_format($fund[$i]['item_retail'],2) ?></div>
                    </div>
                    <div class="price">
                        <div>Bal:</div>
                        <div><?= number_format($fund[$i]['balance'],2) ?></div>
                        <input type="hidden" name="bal" value="<?= $fund[$i]['balance'] ?>" />
                    </div>
                    <?php if($fund[$i]['balance'] > 0) { ?>
                    <a href="../cart/processAddToCart.php?item=<?= $fund[$i]['item_ID'] ?>&amt=<?= $fund[$i]['balance'] ?>&reg=<?= $fund[$i]['reg_ID'] ?>&cust=<?= $regCust ?>" class="fundbtn">Pay Off Balance</a>
                    <input type="text" placeholder="Or Pitch In!" name="pitchIn">
                    <a class="fundbtn" onclick="contribute(<?= $fund[$i]['item_ID'] ?>, <?= $fund[$i]['reg_ID'] ?>, <?= $i ?>, <?= $regCust ?>)">Contribute</a>
                    <?php }else { ?>
                    <div class="paid">All Paid!</div>
                    <?php } ?>
                </div>
                <div class="progressbarcontainer">
                    <div class="progressbar" style="width: <?= $progBar ?>%; background-color: hsl(<?= $fpercent ?>,100%,46%)" >
                    	<?= $fund[$i]['fundPercent'] ?>%
                    </div>
                </div>
            </div>
            <?php } }?>
            <!-- ***************************** funded items end here ***************************** -->

            <!-- ***************************** This is the upper navigation bar ***************************** -->
            <?php if($all > 0) { ?>
			<div class="navbar">
			    <?php if($nav) { ?>
			    <a class="navbtn" href="shopReglist.php?cust=<?= $regCust ?>&page=1" ><i class="fa fa-angle-double-left"></i>...</a>
			    <?php } ?>
			    
			    <?php for($i = $tabpos; $i < ($tabpos+$TABS); $i++) {  
			          $class = "pagebtn";
			          if($selectedPage == ($i+1)) $class = "pagebtn select" ;
			    ?>
                <a class="<?= $class ?>" href="shopReglist.php?cust=<?= $regCust ?>&page=<?= ($i+1) ?>"><?= ($i + 1) ?></a>
                <?php } ?>
                <?php if($pages > $TABS && $i < $pages ) { ?>
                <a class="navbtn" href="shopReglist.php?cust=<?= $regCust ?>&page=<?= $pages ?>" >...<?= $pages ?></a>
                <?php } ?>                
            </div>
            
            <!-- ***************************** Qulified items appear here ***************************** -->
            <div class="itemcontainer">
                <?php for($i = 0; $i < $itemCount; $i++) { 
                    @$class = ($item[$i]['liked']) ? "fa fa-heart" : "far fa-heart";
                    @$title = ($item[$i]['liked']) ? "Un-Like This Item" : "Like This Item!";
                    @$href = ($item[$i]['liked']) ? "processUnlike" : "processAddToLikes";
                ?>
                <div class="item">
                    <img src="<?= resolve($item[$i]['item_pic']) ?>" alt="<?= $item[$i]['item_desc'] ?>">
                    <div class="pricetag"> 
                            <?= number_format($item[$i]['item_retail'],2) ?>
                    </div>
                    <div class="itemdescription"><?= stripslashes($item[$i]['item_desc']) ?></div>
                    <?php if(($item[$i]['reg_qty'] - $item[$i]['reg_recQty']) > 0) { ?>
                    <div class="itemquans">
                        <div class="quandesired bold">QTY: <?= $item[$i]['reg_qty']-$item[$i]['reg_recQty'] ?></div>
						<?php if(($item[$i]['reg_qty'] - $item[$i]['reg_recQty']) > 1) { ?>                     
                        <input placeholder="QTY" type="text" name="qty">
                        <?php }else { ?>
                        <input placeholder="QTY" type="hidden" name="qty" value="1">
                        <?php } ?>
                    </div>
                    <div class="itembtns">
                        <a onclick="addToCart(<?= $item[$i]['item_ID'] ?>, <?= $item[$i]['reg_ID'] ?>, <?= $i ?>, <?= $regCust ?>)" class="addtocartbtn"><i class="fa fa-gift"></i>&nbsp;Add to Cart</a><!--visibility:hidden should be toggled based on quantaties and text field-->
                    </div>
                    <?php }else { ?>
                    <div class="itemquans">
                        <div class="quandesired bold">&nbsp;</div>
                    </div>
                    
                    <input placeholder="QTY" type="hidden" name="qty" value="1">
                    <a class="purchasedbtn">Purchased!</a>
                    
                    <?php } ?>
                </div>
                <?php } ?>
            </div>

            <!-- ***************************** This is the lower navigation bar ***************************** -->
			<div class="navbar">
			    <?php if($nav) { ?>
			    <a class="navbtn" href="shopReglist.php?cust=<?= $regCust ?>&page=1" ><i class="fa fa-angle-double-left"></i>...</a>
			    <?php } ?>
			    
			    <?php for($i = $tabpos; $i < ($tabpos+$TABS); $i++) {  
			          $class = "pagebtn";
			          if($selectedPage == ($i+1)) $class = "pagebtn select" ;
			    ?>
                <a class="<?= $class ?>" href="shopReglist.php?cust=<?= $regCust ?>&page=<?= ($i+1) ?>"><?= ($i + 1) ?></a>
                <?php } ?>
                <?php if($pages > $TABS && $i < $pages ) { ?>
                <a class="navbtn" href="shopReglist.php?cust=<?= $regCust ?>&page=<?= $pages ?>" >...<?= $pages ?></a>
                <?php } ?>                
            </div>
            <?php } ?>
        </div>
        <!-- ***************************** Page Content Ends Here ***************************** -->
        
        <!--Department overlay Starts here-->
        <?php include '../z_sub/z_overlay.php'; ?>
        
        <!--Everthing For the Footer begins Here-->
        <?php include '../z_sub/z_footer.php'; ?>
	</body>
</html>