
<?php
    /*  
        Cart Display Page
    	Mark/Francois Bouchett 2019
    	https://homeportonline.com/product.php
    */
	
	// ******************* Database Credentials *******************

	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";
	
	// ****************** initializes variables *******************
    $loggedIn = 0;
    $cartCount =  0;
    $relatedItems = 0;
    $liked = 0;
    $subTotal = 0;
    $tax = 0;
    $total = 0;
    $shipping = 0;
    $zone = -1;
    $gcOnly = 1;
    
    @$alert = $_REQUEST['alert'];
    
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
    
    // ******************** Get and total cart ********************
	if(isset($_COOKIE['c_cart'])){
		$cart = unserialize($_COOKIE['c_cart']);
		$cartCount = count($cart);
		//get cart data
		$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
		for($i = 0; $i < $cartCount; $i++){
			$sql = 'SELECT `item_ID`, `item_desc`,`item_retail`,`item_pic`,`item_sku`,`vendor_ID` 
	        FROM `items` 
	        WHERE `item_ID`='.$cart[$i]['item'];
	    	$result = mysqli_query($db, $sql); 
	    	$item = mysqli_fetch_assoc($result);
	    	$cart[$i]['desc'] = stripcslashes($item['item_desc']);
	    	if($cart[$i]['reg']) $cart[$i]['desc'] = $cart[$i]['desc'].'(Registry Item)';
	    	if($cart[$i]['wish']) $cart[$i]['desc'] = $cart[$i]['desc'].'(Wish Item)';
	    	if(!$cart[$i]['amt']) $cart[$i]['amt'] = $item['item_retail'];
	    	$cart[$i]['pic'] = $item['item_pic'];
	    	$subTotal = $subTotal + ($cart[$i]['amt'] * $cart[$i]['qty']);
	    	if(substr($cart[$i]['desc'], -8) != "(No Tax)") {
	    		$tax = $tax + ($cart[$i]['amt'] * $cart[$i]['qty']) * .07;
	    	}
	    	if($item['vendor_ID'] != 518 || substr($item['item_sku'],0,2) != "GC") $gcOnly = 0;
		}
	}
	$total = $subTotal + $tax;
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
<title>Homeport Shopping Cart</title>
    <!--the following two stylesheets need to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" />
    <link rel="stylesheet" href="../icons/all.css" type="text/css">
    <!--Stylesheet for this specific page-->
    <link rel="stylesheet" href="css/index.css" type="text/css" />
    <script src="js/index.js" ></script>
</head>
<body onload="window.scrollTo(0,<?= $w ?>)">
    <!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle"><i class="fa fa-shopping-cart"></i>&nbsp;Your Cart!</div>
        <?php if($cartCount > 0) { ?>
        <div class="subfeature"><i class="fa fa-cookie-bite"><b></i>&nbsp;Our Shopping Cart uses Cookies to work, please make sure Cookies are enabled.</b></div>
        <!-- <div class="subfeature"><i class="fa fa-truck"><b></i>&nbsp;*** Any orders placed now will processed after December 25th *** </b></div> -->
        <!-- <div class="subfeature"><i class="fa fa-holly-berry"><b></i>&nbsp;HAPPY HOLIDAYS!</b></div> -->
        <div class="cartlabels">
            <div class="cartlabeldesc">Desription</div>
            <div class="cartlabelprice">Price</div>
            <div class="cartlabelquan">Quantity</div>
        </div>
        <form id="pmwi" action="processCart.php" method="post">
        <?php for($i = 0;$i < $cartCount; $i++) { ?>  
        <!--******Item Begins Here*******-->
        <div class="cartitemcontainer">
            <div class="imgcontainer"><img src="<?= resolve($cart[$i]['pic']) ?>" alt="<?= $cart[$i]['desc'] ?>"></div>
            <div class="link">
                <a class="desclink" href="../product.php?item=<?= $cart[$i]['item'] ?>"><?= $cart[$i]['desc'] ?></a>
            </div>
            <div class="price"><?= number_format($cart[$i]['amt'],2) ?></div>
            
            <div class="options">
                <input class="qty" name="qty[<?= $i ?>]" onkeyup="checkKey(event,<?= $i ?>)" type="text" value="<?= $cart[$i]['qty'] ?>">
                <a class="removebtn" href="removeFromCart.php?index=<?= $i ?>" title="Remove From Cart"><i class="fa fa-trash-alt"></i></a>
            </div>
        </div>
        <!--******Item Ends Here******-->
		<?php } ?>
        <a class="updatequan" onclick="submit()">Update Quantities <i class="fa fa-redo"></i></a>
        </form>
        <div class="checkoutinfo"> 
            <div class="amounts">
                <div> Subtotal:</div>
                <div><?= number_format($subTotal,2) ?></div>
            </div>
            <div class="amounts">
                <div>Tax:</div>
                <div><?= number_format($tax,2) ?></div>
            </div>
        </div>

        <div class="checkoutinfo">    
            <div class="amounts red">
                <div>Total:</div>
                <div><?= number_format($total,2) ?></div>
            </div>
        </div>
        <div class="checkoutbtncont"><a class="checkoutbtn" href="https://www.homeportonline.com/cart/checkout.php"><!--<a class="checkoutbtn" href="checkout.php">-->Proceed to Checkout&nbsp;<i class="fa fa-arrow-right"></i></a></div>
    </div>
        <?php }else { ?>
            <div class="emptycartmsg">It&#39;s Empty... You Should <a href="../departments.php">Get Some Stuff</a></div>
		<?php } ?>
    </div>
    
    

    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
       
    <!--Everthing For the Footer begins Here-->
    <?php include '../z_sub/z_footer.php'; ?>
</body>
</html>