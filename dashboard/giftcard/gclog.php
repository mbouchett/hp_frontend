<?php
//swipe.php 2018/01
// Main Gift Card Interface
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$start = $_REQUEST['start'];
if(!$start) $start = 0;
$next = $start + 100;

//Load gift card log Into Array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `gcLog`
		  ORDER BY `gcLog_date` DESC
		  LIMIT '.$start.', 100' ;
$result = mysqli_query($db, $sql);
$gcCount=mysqli_num_rows($result);
mysqli_close($db);
for($i = 0; $i < $gcCount; $i++){
    $trans[$i] = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Homeport Gift Card Log</title>
		<style type="text/css">
			td {
				border: solid 1px black;
				padding: 4px;			
			}
		</style>
	</head>
	<body>
		Homeport Gift Card Log
		<table>
		<tr><td>Date & Time</td><td>Card Number</td><td>Balance</td><td>Redeemed</td><td>Issued</td><td>User</td></tr>
		<?php for($i = 0; $i < $gcCount; $i++) { ?>
		<tr>
			<td><?= $trans[$i]['gcLog_date'] ?></td>	
			<td><?= $trans[$i]['gcLog_num'] ?></td>
			<td><?= $trans[$i]['gcLog_balance'] ?></td>
			<td><?= $trans[$i]['gcLog_minus'] ?></td>
			<td><?= $trans[$i]['gcLog_plus'] ?></td>
			<td><?= $trans[$i]['gcLog_user'] ?></td>	
		</tr>
		<?php } ?>
		</table>
		<input value="More" onclick="parent.location='gclog.php?start=<?= $next ?>'" type="button"><input value="Exit" onclick="parent.location='gcDash.php'" type="button">
	</body>
</html>
