<?php
//previewOrder.php 2018/01
// enter a vendor count worksheet
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$vendor_ID = $_REQUEST['vendor_ID'];
$po = "1007654";

$today = date("F d, Y");
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$selfmail=$useremail;

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$vendor_ID;//Create The Search Query
$result = mysqli_query($db, $sql);          //Initiate The Query
mysqli_close($db);                          //Close The Connection

if($result) {
	$vendor = mysqli_fetch_assoc($result);//Get The Record
}else{
	echo "Vendor Not Found";
	die;
}

// load vendor catalog into array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `items`
		  WHERE `items`.`vendor_ID` = '.$vendor['vendor_ID']." AND `items`.`item_tempOQ` > 0 
		  ORDER BY `dept_ID`, `item_desc`";
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
	$items[$i]['ext'] = $items[$i]['item_cost'] * $items[$i]['item_tempOQ'];
	$totalOrder += $items[$i]['ext'];
}
$itemcount=count($items);

// parse out category breakdown
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $result = mysqli_query($db, "SELECT * FROM departments ORDER BY dept_ID");          //Initiate The Query
    $depCount=mysqli_num_rows($result);             //Count The Query Matches
    mysqli_close($db);                              //Close The Connection
    //Store the Results To A Local Array
    for($i=0; $i<$depCount; $i++){                  //Iniate The Loop
      $row=mysqli_fetch_assoc($result);             //Fetch The Current Record
      $deps[$i]=$row;                               //Save The Record To The Array
      $deps[$i]['total']=0;
    }
for($i=0; $i<$depCount; $i++){
    for($ii=0; $ii < $itemcount; $ii++){
        if($deps[$i]['dept_ID'] == $items[$ii]['dept_ID']){
        $deps[$i]['total'] =  $deps[$i]['total'] + ($items[$ii]['item_cost'] * $items[$ii]['item_tempOQ']*((100-$order['discount'])/100));
        }
    }
}

$pages=ceil($itemcount/25);
$page=1;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?= $vendor['vendor_name'] ?> Order Preview</title>
	<link href="css/previewOrder.css" rel="stylesheet" type="text/css" />
</head>
<body>
<a href="enterCount.php?vendor_ID=<?= $vendor_ID ?>" ><--Return</a>
	<!-- Order Header -->
	<table class="order">
		<tr><td>Purchase Order# <?= $po ?><br>Order Date: <?= $today ?></td><td></td><td>Page <?= $page ?> of  <?= $pages ?></td></tr>	
		<tr><td colspan="3" height="1" bgcolor="#767676"></td></tr>
		<tr>
			<td>From:</td>
			<td rowspan="8"><?php if($vendor['vendor_hti'] == 1){ ?><img src="../images/hti.jpg" alt="HTI" height="125px" /> <?php } ?></td>
			<td>For:</td>
		</tr>
		<tr>
			<td><b><span style="font-family: Arial; font-size: 24px"><a href="sentOrders.php" style="text-decoration: none; color: #000000">Homeport</a></span></b></td>
			<td><span style="font-size: 16px; font-weight: bold; background-color: #FFFF33; font-family: Arial"><?= $vendor['vendor_name'] ?> (<?= $vendor['vendor_rep'] ?>)</span></td>
		</tr>
		<tr><td>52 Church Street</td><td><?= $vendor['vendor_addr1'] ?></td></tr>
		<tr><td>Burlington, VT 05401</td><td><?= $vendor['vendor_addr2'] ?></td></tr>
		<tr><td></td><td><?= $vendor['vendor_addr3'] ?></td></tr>
		<tr><td>email: <?= $selfmail ?></td><td><?= $emaillink ?></td></tr>
		<tr><td>v(802) 863-4832, f(802) 660-0523</td><td>v.<?= $vendor['vendor_voice'] ?> - f.<?= $vendor['vendor_fax'] ?></td></tr>
		<tr><td colspan="3"><hr /></td></tr>
	</table>
	<!-- Order Terms -->	
	<table class="order">
		<tr title="Preview Only: Can Be Changed once Processed"><td>Order Discount: </td><td></td></tr>	
		<tr title="Preview Only: Can Be Changed once Processed"><td>Order Ship Date: <?= $today ?></td><td></td></tr>
		<tr title="Preview Only: Can Be Changed once Processed"><td>Freight Instructions: </td><td></td></tr>
		<tr title="Preview Only: Can Be Changed once Processed"><td>Order Instructions: </td><td></td></tr>
		<tr title="Preview Only: Can Be Changed once Processed"><td>Order Comments: </td><td></td></tr>
		<tr><td colspan="2"><hr /></td></tr>
	</table>
	<!-- Order Items -->
	<table class="order">
		<tr><td>Order</td><td>Sku</td><td>Description</td><td>Cost</td><td>Extension</td></tr>
		<tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
		<?php for($i = 0; $i < $itemcount; $i++) { ?>
		<tr>
			<td class="items"><?= $items[$i]['item_tempOQ'] ?></td>
			<td class="items"><?= $items[$i]['item_sku'] ?></td>
			<td class="items"><?= $items[$i]['item_desc'] ?></td>
			<td class="items"><?= number_format($items[$i]['item_cost'],2) ?></td>
			<td class="items"><?= number_format($items[$i]['ext'],2) ?></td>
		</tr>
		<tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
	<?php if($i > 0 && $i % 25 == 0) { $page++?>
	</table>
	<p class="breakhere">
	<!-- Order Header -->
	<table class="order">
		<tr><td>Purchase Order# <?= $po ?><br>Order Date: <?= $today ?></td><td></td><td>Page <?= $page ?> of  <?= $pages ?></td></tr>	
		<tr><td colspan="3" height="1" bgcolor="#767676"></td></tr>
		<tr>
			<td>From:</td>
			<td rowspan="8"><?php if($vendor['vendor_hti'] == 1){ ?><img src="../images/hti.jpg" alt="HTI" height="125px" /> <?php } ?></td>
			<td>For:</td>
		</tr>
		<tr>
			<td><b><span style="font-family: Arial; font-size: 24px"><a href="sentOrders.php" style="text-decoration: none; color: #000000">Homeport</a></span></b></td>
			<td><span style="font-size: 16px; font-weight: bold; background-color: #FFFF33; font-family: Arial"><?= $vendor['vendor_name'] ?> (<?= $vendor['vendor_rep'] ?>)</span></td>
		</tr>
		<tr><td>52 Church Street</td><td><?= $vendor['vendor_addr1'] ?></td></tr>
		<tr><td>Burlington, VT 05401</td><td><?= $vendor['vendor_addr2'] ?></td></tr>
		<tr><td></td><td><?= $vendor['vendor_addr3'] ?></td></tr>
		<tr><td>email: <?= $selfmail ?></td><td><?= $emaillink ?></td></tr>
		<tr><td>v(802) 863-4832, f(802) 660-0523</td><td>v.<?= $vendor['vendor_voice'] ?> - f.<?= $vendor['vendor_fax'] ?></td></tr>
		<tr><td colspan="3"><hr /></td></tr>
	</table>
	<!-- Order Terms -->	
	<table class="order">
		<tr><td>Order Discount: </td><td></td></tr>	
		<tr><td>Order Ship Date: </td><td></td></tr>
		<tr><td>Freight Instructions: </td><td></td></tr>
		<tr><td>Order Instructions: </td><td></td></tr>
		<tr><td>Order Comments: </td><td></td></tr>
		<tr><td colspan="2"><hr /></td></tr>
	</table>
	<table class="order">
		<tr><td>Order</td><td>Sku</td><td>Description</td><td>Cost</td><td>Extension</td></tr>
		<tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
	<?php } } ?>
	</table>
	<br />
	<table class="order">
	    <tr class="print">
	    <?php if($username){ ?>
	        <td>Logged [&nbsp;&nbsp;&nbsp;&nbsp;]
	        Faxed/emailed [
	        <?php if($order['emailed']){ ?>
	        &nbsp;&nbsp;X&nbsp;&nbsp;
	        <?php }else{ ?>
	        &nbsp;&nbsp;&nbsp;&nbsp;
	        <?php } ?>
	        ]
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buyer Signature:
	        </td>
	    <?php } ?>
	        <td align="right">Order Total <?= number_format($totalOrder,2) ?></td>
	    </tr>
	</table>
	<br>
	<div class="summary">
	<?php
	    $num=0;
	    for($i=0; $i<$depCount; $i++){
	
	        if($deps[$i]['total'] > 0){
	           $num++;
	        ?>
	            #<?= $deps[$i]['dept_ID'] ?> - <?= $deps[$i]['dept_name'] ?>: $<?= number_format($deps[$i]['total'],2) ?>&nbsp;&nbsp; |&nbsp;&nbsp;
	<?php }
	    if($num > 0 && $num % 4 == 0) echo "<br />";
	}?>
	</div>	
	<a href="enterCount.php?vendor_ID=<?= $vendor_ID ?>" ><--Return</a>
</body>
</html>