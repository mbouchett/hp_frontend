<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/contact.php
*/

@include "/home/homeportonline/crc/2018.php";

// ************************* Functions ************************
function safeString($s) {
	$safeString = filter_var( $s, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	return $safeString;
}

@$searchName = safeString($_POST['name']);	
	
$loggedIn = 0;
$cartCount =  0;
$cartTotItems = 0;
$regCount = 0;

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

@$email = safeString($_REQUEST['email']);
@$alert = safeString($_REQUEST['alert']);

//Load Categories for banner
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `main_cats`';
$result = mysqli_query($db, $sql);
$catCount = mysqli_num_rows($result);
mysqli_close($db);
for($i=0; $i<$catCount; $i++){
	$cat[$i] = mysqli_fetch_assoc($result);
}

if($searchName) {
// ********************** Search For Registry ************************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * 
			  FROM `web_cust` 
			  WHERE `wc_event_date` IS NOT NULL 
			  ORDER BY `wc_event_date` DESC';
			  
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Lookup Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	$regCount = mysqli_num_rows($result);
	mysqli_close($db); 
	//Store the Results To A Local Array
	for($i=0; $i < $regCount; $i++){
		$cust[$i] = mysqli_fetch_assoc($result);
		$cust[$i]['couple'] = $cust[$i]['wc_fname']." ".$cust[$i]['wc_lname']." ".$cust[$i]['wc_spouse_fn']." ".$cust[$i]['wc_spouse_ln'];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Homeport Sign In</title>
    <!--these two links needs to be placed at the top of every page--> 
    <link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> 
    <link rel="stylesheet" href="../icons/all.css" type="text/css">
    
    <link rel="stylesheet" href="css/regSearch.css" type="text/css" />   
</head>
<body>
	
	<!--This Is the Banner copy this into any page that need a header-->
    <?php include '../z_sub/z_banner.php'; ?>
	
    <div id="container">
        <div class="featuretitle">Search For a Registry Couple</div>
        <div class="searchregform">
            <?php if($alert) { ?>
                <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
                <?php }else { ?>
                <div class="instructions">*Search by Name&#40;s&#41; or Date</div>
            <?php } ?>
            
            <form id="regSearch" action="regSearch.php" method="post" name="regNameSearch">
                <input class="searchnames" placeholder="Search By Name(s)" id="name" type="text" name="name">
                <!--  
                <div class="textfield">
                    <input class="regmonth" id="mm" type="text" name="eMonth" placeholder="MM" maxlength="2">
                    <input class="regdivider" type="text" placeholder="/" disabled>
                    <input class="regday" id="dd" type="text" name="eDay" placeholder="DD" maxlength="2">
                    <input class="regdivider" type="text" placeholder="/" disabled>
                    <input class="regyear" id="yy" type="text" name="eYear" placeholder="YYYY" maxlength="4">
                </div>-->
                <button class="submitbtn" onclick="document.getElementById('regSearch').submit();"><i class="fa fa-search"></i>&nbsp;Search For Registry</button>
            </form>
            <!--this bit Down only visible after search-->
            <?php if($regCount > 0) { ?>
            <div class="reglist">
            
                <div class="reglistlabels">
                    <div class="labelcouple">Names of Couple</div>
                    <div class="labeldate">Registry Date</div>
                </div>
<!--Actual List begins Here-->
				<?php for($i = 0; $i < $regCount; $i++) { 
					  if(strpos(strtolower($cust[$i]['couple']),strtolower($searchName)) !== false) {
				?>
                <a href="shopReglist.php?cust=<?= $cust[$i]['wc_ID'] ?>">
                    <div class="itemcontainer">
                        <div class="couplename"><?= $cust[$i]['wc_fname'] ?> <?= $cust[$i]['wc_lname'] ?> &amp; <?= $cust[$i]['wc_spouse_fn'] ?> <?= $cust[$i]['wc_spouse_ln'] ?></div>
                        <div class="regdate"><?= $cust[$i]['wc_event_date'] ?></div>
                    </div>    
                </a>   
                <?php } } ?>             
            </div>
            <?php } ?> 
        </div>
        <div class="bottomlinks">     
            <a href="../index.php">Exit</a>
        </div>
    </div>
    <!--Department overlay Starts here-->
    <?php include '../z_sub/z_overlay.php'; ?>
</body>
</html>