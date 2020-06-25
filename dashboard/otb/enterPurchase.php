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
  	
  	// ******************* Variables *******************
  	
  	$today = date('Y-m-d');													// Current Date
  	$year = date('Y');														// Current Year
  	
  	@$alert = $_REQUEST['alert'];											// Request Alert
  	
  	@$floor = $_REQUEST['floor'];											// Request Current Floor
  	if(!$floor) $floor = $_POST['floor'];								    // Post Current Floor
  	
  	if(!$floor) {															// If no floor given return
  		header('location: ../');
  		die;
  	}
  	
  	@$currentMonth = $_REQUEST['currentMonth'];						// Request Current month for Itemized		
  	if(!$currentMonth) $currentMonth = $_POST['currentMonth'];  // Purchase list at bottom
  	if(!$currentMonth) $currentMonth = date('Y-m');					// Default to present Month	
  	
  	// ******************* Load Floor *******************
  	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
  	$sql = 'SELECT *  
			  FROM `areas`
			  WHERE `area_ID`='.$floor;
	$result = mysqli_query($db, $sql);
	$floorName = mysqli_fetch_assoc($result);
	
	// ******************* Load Departments *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `dept_ID`, `dept_name`  
			  FROM `departments`
			  WHERE `dept_ID` < 60 AND `area_ID`='.$floor.' 
			  ORDER BY `dept_ID`';
	$result = mysqli_query($db, $sql);
	$deptCount = mysqli_num_rows($result);
	mysqli_close($db); 
	//Store the Results To A Local Array
	for($i=0; $i<$deptCount; $i++){
		$dept[$i] = mysqli_fetch_assoc($result);
	} 
	
	// ******************* Load Vendors *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `vendor_ID`, `vendor_name`  
			  FROM `vendors`
			  ORDER BY `vendor_name`';
	$result = mysqli_query($db, $sql);
	$vendCount = mysqli_num_rows($result);
	mysqli_close($db); 
	//Store the Results To A Local Array
	for($i=0; $i<$vendCount; $i++){
		$vendor[$i] = mysqli_fetch_assoc($result);
	}
	
	// ******************* Get budget data *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * 
			  FROM `otb_budget`
			  WHERE `ob_year`='.$year.' AND `area_ID`='.$floor.'
			  ORDER BY `ob_month`';
	$result = mysqli_query($db, $sql);
	if($result) {
		$budgetCount = mysqli_num_rows($result);
		//Store the Results To A Local Array
		for($i=0; $i<$budgetCount; $i++){
			$budget[$i] = mysqli_fetch_assoc($result);
			$totalBudget = $totalBudget + $budget[$i]['ob_amt'];
		}
	}
	mysqli_close($db);
	
	// ******************* Get purchases per/month *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i = 0; $i < 12; $i++) {
		$l = $i+1;
		$key = $year."-".($l);
		if(strlen(($l)) < 2) $key = $year."-0".$l;
		$sql = 'SELECT `otb_amt` 
				  FROM `otb`
				  WHERE `otb_ship_date` LIKE "'.$key.'%" AND `area_ID`='.$floor.' 
				  ORDER BY `otb_ship_date`';
		$result = mysqli_query($db, $sql);
		if($result) {
			$purchaseCount = mysqli_num_rows($result);
			for($ii = 0; $ii < $purchaseCount; $ii++){
				$pruchase = mysqli_fetch_assoc($result);
				$monthPurchase[$i] = $monthPurchase[$i] + $pruchase['otb_amt'];
			}
		}
	}
	mysqli_close($db);
	
	// ******************* Get purchases List for Current month *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * 
			  FROM `otb`
			  LEFT JOIN `vendors` USING (`vendor_ID`)
	          LEFT JOIN `departments` USING (`dept_ID`)
			  WHERE `otb_ship_date` LIKE "'.$currentMonth.'%" AND `otb`.`area_ID`='.$floor.'
			  ORDER BY `otb_ship_date`';
	$result = mysqli_query($db, $sql);
	$poTot = 0;
	if($result) {
		$poCount = mysqli_num_rows($result);
		for($i=0; $i<$poCount; $i++){
			$po[$i] = mysqli_fetch_assoc($result);
			$poTot = $poTot + $po[$i]['otb_amt'];
		}
	}
	mysqli_close($db);
	
	// ******************* Get purchases month/cat *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i = 0; $i < 12; $i++) {
		$l = $i+1;
		$key = $year."-".($l);
		if(strlen(($l)) < 2) $key = $year."-0".$l;
		for($d=0; $d<$deptCount; $d++){
			$sql = 'SELECT SUM(`otb_amt`) as sum 
					FROM `otb` 
					WHERE `otb_ship_date` LIKE "'.$key.'%" 
					AND `dept_ID`='.$dept[$d]['dept_ID'];
			$result = mysqli_query($db, $sql);
			$row =  mysqli_fetch_assoc($result);
			$catAmt[$i][$d] = $row['sum'];
		}
	}
	mysqli_close($db);	//exit;
	for($d=0; $d<$deptCount; $d++){
		for($i = 0; $i < 12; $i++) {
			$dept[$d]['cat_tot'] = $dept[$d]['cat_tot'] + $catAmt[$i][$d];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/enterPurchase.css" type="text/css" />
	<title>Enter Purchase</title>
</head>
<body>
	<?php if($alert){ ?>
	<div class="alert"><?= $alert ?></div>
	<?php } ?>

	Enter <?= $floorName['area_name'] ?> Purchase:
	<form action="processEnterPurchase.php" method="post">
		<table>
			<tr>
				<td>Date</td><td>Department</td><td>Vendor</td><td>Amount</td><td>PO #</td><td>Ship Date</td><td>Comment</td>
			</tr>
			<tr>
				<td><input type="date" name="date" value="<?= $today ?>"></td>
				<td>
					<select name="dept">
						<?php for($i = 0; $i < $deptCount; $i++) { ?>
						<option value="<?= $dept[$i]['dept_ID'] ?>"><?= $dept[$i]['dept_ID'] ?>-<?= $dept[$i]['dept_name'] ?></option>		
						<?php } ?>			
					</select>
				</td>
				<td>
					<select name="vendor">
						<?php for($i = 0; $i < $vendCount; $i++) { ?>
						<option value="<?= $vendor[$i]['vendor_ID'] ?>"><?= $vendor[$i]['vendor_name'] ?></option>		
						<?php } ?>			
					</select>				
				</td>
				<td><input size="5" type="text" name="amount"></td>
				<td><input size="5" type="text" name="po"></td>
				<td><input type="date" name="shipDate" value="<?= $today ?>"></td>
				<td><input type="text" name="comment"></td>
			</tr>			
		</table>
		<input type="hidden" name="floor" value="<?= $floor ?>">	
		<input type="submit" value="Add Purchase">
	</form>
<hr>

<!-- Open To Buy By Month -->
Open To By:<br>


			<table class="numbers">
				<tr>
					<td>Month</td><td>Budget</td><td>Spent</td><td>Available</td>	
				</tr>
				<?php for($i = 0; $i < 12; $i++) { 
				$dateObj   = DateTime::createFromFormat('!m', ($i+1));
				$monthName = $dateObj->format('F');	
				$available = $budget[$i]['ob_amt'] - $monthPurchase[$i];
				$bg = "77ff77";
				$cf = 0;
				if($available <= 0) {
					$bg = "ff0000";
					if($i < 11) {
						$monthPurchase[$i+1] = $monthPurchase[$i+1] + abs($available);
						$monthPurchase[$i] = $monthPurchase[$i] - abs($available);
						$available = 0;
					}
				}
				$m = $i+1;
				$goMo = $year."-".$m;
				if(strlen($goMo) < 7)$goMo = $year."-0".$m;
				?>
				<tr>
					<td><a href="enterPurchase.php?floor=<?= $floor ?>&currentMonth=<?= $goMo ?>" ><?= $monthName ?></a></td>	
					<td><?= number_format($budget[$i]['ob_amt'],2) ?></td>
					<td><?= number_format($monthPurchase[$i],2) ?></td>
					<td bgcolor="<?= $bg ?>" ><?= number_format($available,2) ?></td>
				</tr>
				<?php } ?>
				<tr class="totals"><td colspan="4">Total <?= $area[$floor]['area_name'] ?> Budget for <?= $year ?> -> <?= $totalBudget ?></td></tr>
			</table>
			<table class="numbers">
			    <tr class="supersmall">
			    	<td></td>
			    	<?php for($i=0; $i<$deptCount; $i++){ ?>
			        <td style="text-align: center;"><?= $dept[$i]['dept_name'] ?></td>    
			    	<?php } ?>
			    </tr>    
			    <?php for($i = 0; $i < 12; $i++) { 
					$dateObj   = DateTime::createFromFormat('!m', ($i+1));
					$monthName = $dateObj->format('F');				    
			    ?>
			    <tr>
			    	<td><?= $monthName ?></td>
			    	<?php for($ii=0; $ii<$deptCount; $ii++){ ?>
			        <td><?= $catAmt[$i][$ii] ?></td>    
			    	<?php } ?>
			    </tr>
			    <?php } ?>
			    <tr>
			    	<td>Totals</td>
			    	<?php for($d=0; $d<$deptCount; $d++){ ?>
			        <td><?= number_format($dept[$d]['cat_tot'],2) ?></td>    
			    	<?php } ?>
			    </tr>
			</table>
<br>
<a href="index.php" ><-Return</a>

<!-- List of Purchases -->
<hr>	
<?php
	$theYear = substr($currentMonth,0,4);
	$nYear = $theYear;
	$pYear = $theYear;
	$theMonth = substr($currentMonth,5,2);
	$pMonth = $theMonth - 1;
	$nMonth = $theMonth + 1;
	if($pMonth < 1) {
		$pMonth = 12;
		$pYear = $theYear - 1;
	}
	if($nMonth > 12) {
		$nMonth = 1;
		$nYear = $theYear + 1;
	}
	$prevMonth = $pYear."-".$pMonth;
	$nextMonth = $nYear."-".$nMonth;
	if(strlen($pMonth) < 2) $prevMonth = $pYear."-0".$pMonth;
	if(strlen($nMonth) < 2) $nextMonth = $nYear."-0".$nMonth;
	$red = "";
	if($poTot > $budget[$i]['ob_amt']) $red = "ff0000"
?>
<span style="color: #<?= $red ?>" >Spent $<?= $poTot ?></span>
<a href="enterPurchase.php?floor=<?= $floor ?>&currentMonth=<?= $prevMonth ?>" ><-</a> 
Viewing: <?= $currentMonth ?> 
<a href="enterPurchase.php?floor=<?= $floor ?>&currentMonth=<?= $nextMonth ?>" >-></a><br>
<hr>
<table>
	<?php for($i=0; $i<$poCount; $i++){ ?>
	<tr>
		<td><?= $po[$i]['otb_ship_date'] ?></td>
		<td><?= $po[$i]['vendor_name'] ?></td>
		<td><?= $po[$i]['dept_name'] ?></td>
		<td><?= number_format($po[$i]['otb_amt'],2) ?></td>
		<td><a href="../purchasing/orders/viewOrder.php?order_ID=<?= substr($po[$i]['otb_po'],0,7)  ?>" ><?= $po[$i]['otb_po'] ?></a></td>
		<td><?= $po[$i]['otb_buyer'] ?></td>
		<td><?= $po[$i]['otb_comment'] ?></td>
		<?php
		if($_SESSION['username'] == "abouchett" || $_SESSION['username'] == "mbouchett" || $_SESSION['username'] == "francois" || $_SESSION['username'] == "bbouchett" || $_SESSION['username'] == "cnye") {
		?>
		<td><button onclick="deletePurch(<?= $po[$i]['otb_ID'] ?>, <?= $floor ?>);">Delete</button></td>
		<?php } ?>
	</tr>
	<?php } ?>
</table>	
<script defer="defer" type="text/javascript" src="js/enterPurchase.js"></script>
</body>
</html>