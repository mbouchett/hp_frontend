<?php
	//deptListing.php 2018/01
	// item list for vendor
	include "/home/homeportonline/crc/2018.php";

	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
	}
	$dept_ID = $_REQUEST['dept_ID'];
	
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * 
			  FROM `items` 
			  LEFT JOIN `vendors` USING (`vendor_ID`)
	          LEFT JOIN `departments` USING (`dept_ID`)
			  WHERE `items`.`dept_ID` = '.$dept_ID."
			  ORDER BY `vendor_name`, `item_desc`";
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
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Department Listing <?= $items[0]['dept_name'] ?> (<?= $itemCount ?>)</title>
	<style>
		td{
			border-width: 1px;
			border-color: black;
			border-bottom-style: solid;	
		}	
	</style>
</head>
<body>
	<span style="font-size: 23px">
		Department: <?= $items[0]['dept_name'] ?> (<?= $itemCount ?> Items)
	</span>
	<hr>
	<table>
		<tr>
			<td>Dept</td><td>Vendor</td><td>Sku</td><td>Description</td><td>Cost</td><td>Retail</td>
		</tr>
		<?php  for($i=0; $i<$itemCount; $i++){ ?>
		<tr>
			<td><input size="2" type="text" name="dept_ID" value="<?= $items[$i]['dept_ID'] ?>"></td>
			<td><?= $items[$i]['vendor_name'] ?></td>
			<td><?= $items[$i]['item_sku'] ?></td>
			<td><?= $items[$i]['item_desc'] ?></td>
			<td><?= number_format($items[$i]['item_cost'],2) ?></td>
			<td><?= number_format($items[$i]['item_retail'],2) ?></td>
		</tr>	
		<?php } ?>
	</table>
</body>
</html>