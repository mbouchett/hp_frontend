<?php
	//enterPurchase.php 2018/01
	// Log A Purchase
	include "/home/homeportonline/crc/2018.php";
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
  	$today = date('Y-m-d');
  	$alert = $_REQUEST['alert'];
  	
  	// Load Floors
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * 
			  FROM `areas` 
			  ORDER BY `area_ID`';
	$result = mysqli_query($db, $sql);
	$areaCount = mysqli_num_rows($result);
	mysqli_close($db); 
	//Store the Results To A Local Array
	for($i=0; $i<$areaCount; $i++){
		$area[$i] = mysqli_fetch_assoc($result);
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/enterBudget.css" type="text/css" />
	<title>Enter Budget</title>
</head>
<body>
	<?php if($alert){ ?>
	<div class="alert"><?= $alert ?></div>
	<?php } ?>
	Enter Budget:
	<form action="processEnterBudget.php" method="post">
		Year: <input size="2" type="text" name="year">
		<table border="1">
			<tr>
				<td>Month</td>
				<?php for($i = 0; $i < $areaCount; $i++) { ?>
				<td><?= $area[$i]['area_name'] ?></td>
				<?php } ?>
			</tr>
			<?php for($i = 1; $i <13; $i++) { 
			$dateObj   = DateTime::createFromFormat('!m', $i);
			$monthName = $dateObj->format('F');
			?>
			<tr>
				<td class="month"><?= $monthName ?></td>
				<?php for($ii = 0; $ii < $areaCount; $ii++) { ?>
				<td><input class="amt" type="text" name="amt[<?= $i ?>][<?= $ii ?>]" value="0.00" ></td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>
		<input type="submit" value="Save Budget">
	</form>
	<a href="index.php" ><-return</a>
</body>
</html>