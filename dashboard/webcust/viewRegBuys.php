<?php
/* Contact form
	Mark/Francois Bouchett 2019
	viewRegBuys.php
*/

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/functions/f_resolve.php";


// ******************* Initialize Variables *******************
$cartCount =  0;
$cartTotItems = 0;

@$email = $_REQUEST['email'];
@$alert = $_REQUEST['alert'];
@$cust = $_REQUEST['cust'];
	
// ******************* Get registry Items *******************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_reg` WHERE `wc_ID`='.$cust;
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
    <link rel="stylesheet" href="../../webfonts/fonts.css" type="text/css" /> 	<!--this needs to be placed anywhere the fonts are used-->
    <link rel="stylesheet" href="../../icons/all.css" type="text/css"> 		<!--this needs to be placed anywhere icons are used-->
	<link rel="stylesheet" href="css/viewThankYou.css" type="text/css" />
    <script src="../js/deptOverlay.js"></script>
</head>
<body>
	
    <div id="container">
        <div class="featuretitle">Registry Purchase list</div>
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
    </div>
    
</body>
</html>