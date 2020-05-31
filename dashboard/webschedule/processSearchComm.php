<?php
// processEnterCommissions.php
// mark bouchett 04/19/2019
date_default_timezone_set('America/New_York');
include "/home/homeportonline/crc/2018.php";

$name = $_POST['cust'];
$trans = $_POST['trans'];

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
if($name) {
	$sql = 'SELECT * 
			FROM `com` 
			LEFT JOIN `resource` USING(`resource_ID`)
			WHERE `com`.`com_cust` LIKE \'%'.$name.'%\'';
}elseif($trans) {
	$sql = 'SELECT * 
			FROM `com` 
			LEFT JOIN `resource` USING(`resource_ID`)
			WHERE `com`.`com_trans` LIKE \'%'.$trans.'%\'';	
}else {
	mysqli_close($db);
	header('location: enterCommissions.php?alert=At least 1 search key required: '.$now);
	die;
}
		
	$result = mysqli_query($db, $sql);
	$comCount = mysqli_num_rows($result);
	mysqli_close($db); 
	//Store the Results To A Local Array
	for($i=0; $i<$comCount; $i++){
		$com[$i] = mysqli_fetch_assoc($result);
		$com[$i]['nickName'] = $com[$i]['resource_firstName']." ".substr($com[$i]['resource_lastName'],0,1);
		switch($com[$i]['com_type']) {
			case 1:
				$com[$i]['typeName'] = "Regular";
				break;
			case 2:
				$com[$i]['typeName'] = "Discount";
				break;
			case 3:
				$com[$i]['typeName'] = "Protection";
				break;
			case 4:
				$com[$i]['typeName'] = "Spiff";
				break;
			default:
				$com[$i]['typeName'] = "???";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search Commissions</title>
<style>
	td{
		border-style: solid;
		border-color: black;
		border-width: 1px;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td>Date</td><td>Customer</td><td>Item</td><td>qty</td><td>Type</td><td>Amount</td><td>Transaction #</td><td>Sales Associate</td>
		</tr>
		<?php for($i=0; $i<$comCount; $i++){ ?>
		<tr>
			<td><?= $com[$i]['com_date'] ?></td>
			<td><?= $com[$i]['com_cust'] ?></td>
			<td><?= $com[$i]['com_desc'] ?></td>
			<td><?= $com[$i]['com_qty'] ?></td>
			<td><?= $com[$i]['typeName'] ?></td>
			<td style="text-align: right;"><?= number_format($com[$i]['com_amt'],2) ?></td>
			<td><?= $com[$i]['com_trans'] ?></td>
			<td><?= $com[$i]['nickName'] ?></td>
		</tr>
		<?php } ?>
	</table>
	<a href="enterCommissions.php" ><- Return</a>
</body>
</html>