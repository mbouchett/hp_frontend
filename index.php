<?php
	/* Homeport Website Front Page 
		Mark/Francois Bouchett 2019
		http://www.homeportonline.com/index.php
	*/
	
	// ******************* Database Credentials *******************
	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";
	
	// ****************** initializes variables *******************
	$loggedIn = 0;
	$cartCount =  0;
	$recentCount = 0;
	$likeCount = 0;
	$today = date('Y-m-d');
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
	
	// ************* set up recently viewed Or Random *************
	unset($recent);
	if(@$_COOKIE['rv1']) $recent[0]['item_ID'] = $_COOKIE['rv1'];
	if(@$_COOKIE['rv2']) $recent[1]['item_ID'] = $_COOKIE['rv2'];
	if(@$_COOKIE['rv3']) $recent[2]['item_ID'] = $_COOKIE['rv3'];
	if(@$_COOKIE['rv4']) $recent[3]['item_ID'] = $_COOKIE['rv4'];
	@$recentCount = ($recent) ? count($recent) : 0;
	if($recentCount) {
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		for($i = 0; $i < $recentCount; $i++) {
			$sql = 'SELECT `item_ID`,`item_pic`, `item_desc` FROM `items` WHERE `item_ID`='.$recent[$i]['item_ID'];
			$result = mysqli_query($db, $sql);
			if($result) $recent[$i] =  mysqli_fetch_assoc($result);
		}
		mysqli_close($db);
	}else {
		// if no recently viewed items get 4 random ones	
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql = 'SELECT `item_ID`,`item_pic`, `item_desc` FROM `items` WHERE `item_pic` IS NOT NULL ORDER BY RAND() LIMIT 4';
		$result = mysqli_query($db, $sql);
		$recentCount = mysqli_num_rows($result);
		mysqli_close($db); 
		//Store the Results To A Local Array
		for($i = 0; $i < 4; $i++){
			$recent[$i] = mysqli_fetch_assoc($result);
		}	
	}
	
	// ******************** set up sub features ********************
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `sub_feature` WHERE `sf_start` <= "'.$today.'" AND `sf_end` >= "'.$today.'"';
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Lookup Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	$subFeature = mysqli_fetch_assoc($result);	
	
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
        
        <link rel="stylesheet" href="css/index.css" type="text/css" />  
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window,document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		 fbq('init', '389900388326108'); 
		fbq('track', 'PageView');
		</script>
		<noscript>
		 <img height="1" width="1" 
		src="https://www.facebook.com/tr?id=389900388326108&ev=PageView
		&noscript=1"/>
		</noscript>
		<!-- End Facebook Pixel Code -->
		
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
    
        <!--Page Content goes here-->
        <div class="pagecontainer">
            <!--<div class="featuretitle">Can't wait for spring? Make your own damn rainbows!</div>-->
            <div class="featuretitle">Now Open to the Public!</div>
            <div class="featurecontainer">
                <!--This link should change for feature-->
                <!--<a href="search.php?key=supoon+spatula"><img src="images/feature.jpg" alt="Feature"></a>-->
                <a href="contact.php"><img src="images/feature.jpg" alt="Feature"></a>
            </div>
            
            <!-- ************************************************** Feature Items ************************************************** -->
            <div class="subtitle">Get Your Dad Something Nice!</div>
            <div class="subfeaturecontainer">
                <div class="subfeatureitem">
            		<?php if($subFeature['sf_start']) { ?> 
            		<a href="<?= $subFeature['sf_link1'] ?>" >
            			<img src="http://www.rockingbones.site/homeportonline/feature/<?= $subFeature['sf_f1'] ?>" alt="Feature"> 
            		</a>
            		<?php }else { ?>
                    <a href="product.php?item=83017" ><!--Find Vendor-->
            		<!--<a href="shopItems.php?dept=1029&keyName=Puzzles" > Find DEPT-->
                		<img src="images/subfeature1.jpg" alt="Store Front"> <?php } ?>
                	</a>
                </div>
                <div class="subfeatureitem">
            		<?php if($subFeature['sf_start']) { ?> 
            		<a href="<?= $subFeature['sf_link2'] ?>" >
            			<img src="http://www.rockingbones.site/homeportonline/feature/<?= $subFeature['sf_f2'] ?>" alt="Feature"> 
            		</a>
            		<?php }else { ?>
            		<a href="product.php?item=83017" ><!--Find Vendor-->
                		<img src="images/subfeature2.jpg" alt="Store Front"> <?php } ?>
                	</a>
                </div>
                <div class="subfeatureitem">
            		<?php if($subFeature['sf_start']) { ?> 
            		<a href="<?= $subFeature['sf_link3'] ?>" >
            			<img src="http://www.rockingbones.site/homeportonline/feature/<?= $subFeature['sf_f3'] ?>" alt="Feature"> 
            		</a>
            		<?php }else { ?>
                    <a href="https://homeportonline.com/search.php?key=father day" >
            		<!--<a href="search.php?key=puzzle" >Find By Search Key-->
                		<img src="images/subfeature3.jpg" alt="Store Front"> <?php } ?>
                	</a>
                </div>
                <div class="subfeatureitem">
            		<?php if($subFeature['sf_start']) { ?> 
            		<a href="<?= $subFeature['sf_link4'] ?>" >
            			<img src="http://www.rockingbones.site/homeportonline/feature/<?= $subFeature['sf_f4'] ?>" alt="Feature"> 
            		</a>
            		<?php }else { ?>
                    <a href="https://homeportonline.com/search.php?key=father day" >
                    
            		<!-- Specify vendor page <a href="vendorPage.php?vendor=1460&vendorName=Professor Puzzle" > -->
                    <!-- Specify Dept and keyname<a href="https://homeportonline.com/shopItems.php?dept=1027&keyName=Mothers%20Day%20Cards">-->
                		<img src="images/subfeature4.jpg" alt="Store Front"> <?php } ?>
                	</a>
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
			
			<!-- ************************************************** Liked Items ************************************************** -->
            <?php if($likeCount > 0) { ?>
            <div class="subtitle"><a href="#"><i class="fa fa-heart"></i>&nbsp;Your likes<span class="subtext">See All&nbsp;<i class="fa fa-arrow-right"></i></span></a></div>
            <div class="itemcontainer">
                <div class="item">
                        <img src="images/subfeature1.jpg" alt="Store Front">
                </div>
                <div class="item">
                        <img src="images/subfeature2.jpg" alt="Store Front">
                </div>
                <div class="item">
                        <img src="images/subfeature3.jpg" alt="Store Front">
                </div>
                <div class="item">
                        <img src="images/subfeature4.png" alt="Store Front">
                </div>
            </div>
            <?php } ?>
        </div>
        <!--Page Content Ends Here-->
        
        <!--Department overlay Starts here-->
        <?php include 'z_overlay.php'; ?>
        
        <!--Everthing For the Footer begins Here-->
        <?php include 'z_footer.php'; ?>
	</body>
</html>