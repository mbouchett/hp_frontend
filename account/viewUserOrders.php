<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/viewUserOrders.php
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
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
	    	FROM `web_order` 
			WHERE `wc_ID` = '.$_COOKIE['c_ID']."
			ORDER BY `wo_date` DESC";
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
	$orderCount = mysqli_num_rows($result);
	mysqli_close($db); 
	//Store the Results To A Local Array
	for($i=0; $i<$orderCount; $i++){
		$order[$i] = mysqli_fetch_assoc($result);
		switch($order[$i]['wo_status']) {
			case 1:
				$order[$i]['stat'] = "Awaiting Items";
				break;
			case 2:
				$order[$i]['stat'] = "Order Canceled";
				break;
			case 3:
				$order[$i]['stat'] = "Items Awaiting Pickup";
				break;
			case 4:
				$order[$i]['stat'] = "Items Picked Up";
				break;
			case 5:
				$order[$i]['stat'] = "Order Shipped";
				break;
			case 6:
				$order[$i]['stat'] = "Payment Issue";
				break;
			default:
				$order[$i]['stat'] = "Order Placed";
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

<meta charset="utf-8" />
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Homeport - Review Orders</title>
    <!--these two links needs to be placed at the top of every page--> 
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> 
    <link rel="stylesheet" href="../icons/all.css" type="text/css">
    
    <link rel="stylesheet" href="css/viewUserOrders.css" type="text/css" />   
</head>
<body>
	
	<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle">Here's a list of your orders!</div>
        <div class="searchregform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions">*Click to View Full Order</div>
            <?php } ?>
            
            <div class="reglist">
                <div class="listlabels">
                    <div class="labelnumber">Order Number</div>
                    <div class="labeldate">Order Date</div>
                    <div class="labelstatus">Status</div>
                </div>
<!--Actual List begins Here-->
                <?php for($i = 0; $i < $orderCount; $i++) { ?>
                    <div class="itemcontainer">
                        <div class="number"><a href="../cart/confirmation.php?wo_ID=<?= $order[$i]['wo_ID'] ?>">HP-<?= str_pad($order[$i]['wo_ID'],7,0,STR_PAD_LEFT) ?></a></div>
                        <div class="date"><a href="../cart/confirmation.php?wo_ID=<?= $order[$i]['wo_ID'] ?>"><?= substr($order[$i]['wo_date'],0,10) ?></a></div>
                        <div class="status"><?= $order[$i]['stat'] ?></div>
                    </div>    
                <?php } ?>
            </div>
        </div>
        <div class="bottomlinks">     
            <a href="index.php">Exit</a>
        </div>
    </div>
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>