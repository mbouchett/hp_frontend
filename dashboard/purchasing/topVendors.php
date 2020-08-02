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

// get vendor list
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `vendors`.`vendor_ID`,`vendors`.`vendor_name`,`vendors`.`vendor_hti`
		  FROM `vendors`";
$result = mysqli_query($db, $sql);
$vendorCount = mysqli_num_rows($result);
mysqli_close($db);

for($i = 0; $i<$vendorCount; $i++){
    $vnd[$i] = mysqli_fetch_assoc($result);
    $tottot = 0;
    for($ii = 0; $ii<$orderCount; $ii++){
    	if($vnd[$i]['vendor_ID'] == $ord[$ii]['vendor_ID']) {
    		$tottot = $tottot + $ord[$ii]['order_total'];
    	}
    }
    $vnd[$i]['volume'] = $tottot;
} 

usort($vnd, function($a, $b) {
    return $a['volume'] <=> $b['volume'];
});

?>
<!DOCTYPE html>
<html>
<head>
	<title>Vendors By Volume</title>
</head>
<body>
<table>
	<tr>
		<td>Vendor</td><td>Purchases</td><td>HTI</td>
	</tr>
	<?php for($i = $vendorCount-1; $i>-1; $i--){ ?>
	<tr>
		<td><?= $vnd[$i]['vendor_name'] ?></td><td style="text-align: left;"><?= number_format($vnd[$i]['volume'],2) ?></td><td><?= $vnd[$i]['vendor_hti'] ?></td>
	</tr>
	<?php } ?>
</table>
</body>

</html>