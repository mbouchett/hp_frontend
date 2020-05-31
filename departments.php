<?php
/* Homeport Website Front Page
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/index.php
*/

	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";
	
	// ************************* Functions ************************
	function safeString($s) {
		@$safeString = filter_var( $s, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		return $safeString;
	}
	
    @$selectedDept = safeString($_REQUEST['selectedDept']);
    @$selectedSubDept = safeString($_REQUEST['selectedSubDept']);
    @$keyName = safeString($_REQUEST['keyName']);
    if(!$keyName) $keyName = "Departments";

    if($selectedDept) {
    	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    	$sql  = 'SELECT * 
    	         FROM `departments` 
    	         WHERE `dept_key`='.$selectedDept.' 
    	         ORDER BY `dept_ID` ASC';
    	$result = mysqli_query($db, $sql);
    	$catCount = mysqli_num_rows($result);
    	mysqli_close($db);
    	for($i=0; $i<$catCount; $i++){
    		$x = mysqli_fetch_assoc($result);
    		$depVars[$i]['id'] = $x['dept_ID'];
    		$depVars[$i]['name'] = $x['dept_name'];
    	}
    	$target = 'shopItems.php?dept=';       
    	
        // Let's Get some images for these departments
    	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    	for($i=0; $i<$catCount; $i++){
    	    $sql = 'SELECT *
    	            FROM `items`
    	            LEFT JOIN `departments` USING(`dept_ID`)
    	            WHERE `departments`.`dept_ID`='.$depVars[$i]['id'].' AND `item_pic` IS NOT NULL  
    	            ORDER BY RAND() LIMIT 1';
    	    $result = mysqli_query($db, $sql);
    	    $x = mysqli_fetch_assoc($result);
    	    $pic[$i]['pic'] = $x['item_pic'];
    	}
    	mysqli_close($db);    	
    }else{
    	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    	$sql  = 'SELECT * 
    	         FROM `main_cats` 
    	         ORDER BY `main_ID` ASC';
    	$result = mysqli_query($db, $sql);
    	$catCount = mysqli_num_rows($result);
    	mysqli_close($db);
    	for($i=0; $i<$catCount; $i++){
    		$x = mysqli_fetch_assoc($result);
    		$depVars[$i]['id'] = $x['main_ID'];
    		$depVars[$i]['name'] = $x['main_name'];
    	}
    	$target = 'departments.php?selectedDept=';
    	
        // Let's Get some images for these departments
    	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    	for($i=0; $i<$catCount; $i++){
    	    $sql = 'SELECT *
    	            FROM `items`
    	            LEFT JOIN `departments` USING(`dept_ID`)
    	            WHERE `departments`.`dept_key`='.$depVars[$i]['id'].' AND `item_pic` IS NOT NULL  
    	            ORDER BY RAND() LIMIT 1';
    	    $result = mysqli_query($db, $sql);
    	    $x = mysqli_fetch_assoc($result);
    	    $pic[$i]['pic'] = $x['item_pic'];
    	}
    	mysqli_close($db);
    }

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
    $recentCount = 0;
	$likeCount = 0;
  
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
        <link rel="stylesheet" href="webfonts/fonts.css" type="text/css" /> 
        <link rel="stylesheet" href="icons/all.css" type="text/css">
        
        <link rel="stylesheet" href="css/department.css" type="text/css" />  
	</head>
	<body>
	<!--This Is the Banner copy this into any page that need a header-->
    <?php include 'z_banner.php'; ?>
        <!--This is where the Banner ends-->
        <!--Page Content goes here-->
        <div class="pagecontainer">
            <div class="pagetitle"><?= $keyName ?>!</div>        
            <div class="itemcontainer">
                <?php for($i = 0; $i < $catCount; $i++) { ?>
                <div class="item">
                    <a href="<?= $target ?><?= $depVars[$i]['id'] ?>&keyName=<?= $depVars[$i]['name'] ?>" >
                        <img src="<?= resolve($pic[$i]['pic']) ?>" alt="Store Front">
                        <div class="deptlabel"><?= $depVars[$i]['name'] ?></div>
                    </a>
                </div>
                <?php } ?>
            </div>
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
                        <img src="images/subfeature4.jpg" alt="Store Front">
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