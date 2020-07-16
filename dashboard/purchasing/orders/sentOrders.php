<?php
//sentOrders.php 2018/01
// enter a vendor count worksheet
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

header('Cache-Control: max-age=900');
@$nak = ($_REQUEST['nak']) ? "WHERE `order_akn` IS NULL" : "";
@$fs = $_REQUEST['fs'];
@$alert = $_REQUEST['alert'];

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

@$key = trim($_POST['key']);

//open order database and retrieve sent orders
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT *
		  FROM `orders`
		  LEFT JOIN `vendors` USING(`vendor_ID`)".
		  $nak."
		  ORDER BY `order_ID` DESC";
$result = mysqli_query($db, $sql);
$orderCount = mysqli_num_rows($result);
mysqli_close($db);

for($i = 0; $i<$orderCount; $i++){
    $ord[$i] = mysqli_fetch_assoc($result);
        $ord[$i]['po'] = $ord[$i]['order_ID'].$ord[$i]['order_by'];
        if($ord[$i]['order_offCycle']) $ord[$i]['po'] .= "X";
}

$ii=0;
if($key){
    for($i = 0; $i<$orderCount; $i++){
        if(stripos($ord[$i]['vendor_name'],$key) !== FALSE){
            $orders[$ii] = $ord[$i];
            $ii++;
        }
    }
} else{
    $orders = $ord;
}
$orderCount = count($orders);

?>
<!DOCTYPE html>
<html>
<head>
	<title>View Purchase Order</title>
	<link href="css/sentOrders.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if($alert) { ?>
    <div class="alert"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?= $alert ?></div>
    <?php }else { ?>
    <div class="instructions">Update your Info!</div>
<?php } ?>
<div class="title">Homeport Online</div>
<form action="sentOrders.php" method="post" >
<table class="menu">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Purchases Dashboard" onclick="parent.location='../index.php'" type="button"></td>
        <td class="dashcell"><input name="key" placeholder="Search Now Available" /></td>
    </tr>
</table>
</form>
<div class="filter">
Filter By:
	<ul>
		<li><a href="sentOrders.php?fs=1">Processed</a></li>
		<li><a href="sentOrders.php?fs=2">Sent</a></li>
		<li><a href="sentOrders.php?fs=3">Checkin</a></li>
		<li><a href="sentOrders.php?fs=4">Received</a></li>
		<li><a href="sentOrders.php?fs=5">Closed</a></li>
		<li><a href="sentOrders.php?nak=1">Not Acknowledged</a></li>
		<li><a href="sentOrders.php">No Filter</a></li>
	</ul>
</div>

<table class="menu">
    <tr ><td width="100">Purchase<br />Order #</td><td>Vendor Name</td><td>Order Date</td><td>Ship Date</td><td>Acknowledged</td><td>Total</td><td>Status</td></tr >
    <tr><td height="1" bgcolor="#000000" colspan="6"></td></tr>
    <?php
        for($i = 0; $i < $orderCount; $i++){
        	   if($orders[$i]['order_status'] == 1) {
        			$bgc = "#ffffb3"; // light yellow Processed
        			$status = "Processed";
        		}elseif($orders[$i]['order_status'] == 2) {
        			$bgc = "#b3ffb3"; // light yellow Green Sent
        			$status = "Sent";
     			}elseif($orders[$i]['order_status'] == 3) {
        			$bgc = "#e6b3ff"; // light purple Being Checked in
        			$status = "Checkin";
     			}elseif($orders[$i]['order_status'] == 4) {
        			$bgc = "#bf8040"; // light orange Fully or Partially Received
        			$status = "Received";
     			}elseif($orders[$i]['order_status'] == 5) {
        			$bgc = "#808080"; // light grey Considered closed by Accts. Payable
        			$status = "Closed";
     			}
    ?>
    <?php if(!$fs || $orders[$i]['order_status'] == $fs)     
    { 
		    	@$ordersTotal += $orders[$i]['order_total'];    
    ?>
    <tr class="print"><!-- All Pos + Filter -->
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order_ID=<?= $orders[$i]['order_ID'] ?>"><?= $orders[$i]['po'] ?></a></td>
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order_ID=<?= $orders[$i]['order_ID'] ?>"><?= $orders[$i]['vendor_name'] ?></a></td>
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order_ID=<?= $orders[$i]['order_ID'] ?>"><?= $orders[$i]['order_date'] ?></a></td>
        <td style="text-align: center"><a title="Click To View" style=" color: #000000; text-decoration: none; font-style: italic;" href="viewOrder.php?order_ID=<?= $orders[$i]['order_ID'] ?>"><?= $orders[$i]['order_shipDate'] ?></a></td>
        <td><?= $orders[$i]['order_akn'] ?></td>
		  <td><?= number_format($orders[$i]['order_total'],2) ?></td>
		  <td ondblclick="changeStat('<?= $ord[$i]['po'] ?>','<?= $orders[$i]['order_status'] ?>');" bgcolor="<?= $bgc ?>" ><?= $status ?></td>
    </tr >
    <tr><td height="1" bgcolor="#996633" colspan="6"></td></tr>
    <?php } }?>
    <tr><td colspan="5"><td><?= number_format($ordersTotal,2) ?></td><td></td></tr>
</table>

<table  class="menu">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Purchases Dashboard" onclick="parent.location='../index.php'" type="button"></td>
    </tr>
</table>
<script defer="defer" type="text/javascript" src="js/sentOrders.js"></script>
</body>

</html>