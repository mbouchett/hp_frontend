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
  	@$alert = $_REQUEST['alert'];
  	@$year = $_REQUEST['year'];
  	if(!$year) $year = $_POST['year'];
  	if(!$year) $year = date('Y'); 	
  	
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
	//Get budgets
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * 
			  FROM `otb_budget`
			  WHERE `ob_year`='.$year.' 
			  ORDER BY `ob_month`,`area_ID`';
	$result = mysqli_query($db, $sql);
	if($result) {
		$amtCount = mysqli_num_rows($result);
 
		//Store the Results To A Local Array
		for($i=0; $i<$amtCount; $i++){
			$amt[$i] = mysqli_fetch_assoc($result);
			$totalBudget = $totalBudget + $amt[$i]['ob_amt'];
		}
	}
	mysqli_close($db);
	$firstFloorTotal = 0;
	$secondFloorTotal = 0;
	$lowerLevelTotal = 0;
	$mezzanineTotal = 0;
	
		// ******************* Get budget data *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	// 1st Floor
	$sql = 'SELECT * FROM `otb_budget` WHERE `ob_year`='.$year.' AND `area_ID`=1 ORDER BY `ob_month`';
	$result = mysqli_query($db, $sql);
	if($result) {
		$count = mysqli_num_rows($result);
		for($i=0; $i<$count; $i++){ $budget1[$i] = mysqli_fetch_assoc($result); }
	}
	// 2nd Floor
	$sql = 'SELECT * FROM `otb_budget` WHERE `ob_year`='.$year.' AND `area_ID`=2 ORDER BY `ob_month`';
	$result = mysqli_query($db, $sql);
	if($result) {
		$count = mysqli_num_rows($result);
		for($i=0; $i<$count; $i++){ $budget2[$i] = mysqli_fetch_assoc($result); }
	}
	// Mezz
	$sql = 'SELECT * FROM `otb_budget` WHERE `ob_year`='.$year.' AND `area_ID`=3 ORDER BY `ob_month`';
	$result = mysqli_query($db, $sql);
	if($result) {
		$count = mysqli_num_rows($result);
		for($i=0; $i<$count; $i++){ $budget3[$i] = mysqli_fetch_assoc($result); }
	}	
	// Holders
	$sql = 'SELECT * FROM `otb_budget` WHERE `ob_year`='.$year.' AND `area_ID`=4 ORDER BY `ob_month`';
	$result = mysqli_query($db, $sql);
	if($result) {
		$count = mysqli_num_rows($result);
		for($i=0; $i<$count; $i++){ $budget4[$i] = mysqli_fetch_assoc($result); }
	}
	mysqli_close($db);
	
	// ******************* Get purchases per/month *******************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	//1st Floor
	for($i = 0; $i < 12; $i++) {
		$l = $i+1;
		$key = $year."-".($l);
		if(strlen(($l)) < 2) $key = $year."-0".$l;
		$sql = 'SELECT `otb_amt` FROM `otb` WHERE `otb_ship_date` LIKE "'.$key.'%" AND `area_ID`=1 ORDER BY `otb_ship_date`';
		$result = mysqli_query($db, $sql);
		if($result) {
			$count = mysqli_num_rows($result);
			for($ii=0; $ii<$count; $ii++){
				$pruchase = mysqli_fetch_assoc($result);
				$mp1[$i] = $mp1[$i] + $pruchase['otb_amt'];
			}
		}
	}
	//2nd Floor
	for($i = 0; $i < 12; $i++) {
		$l = $i+1;
		$key = $year."-".($l);
		if(strlen(($l)) < 2) $key = $year."-0".$l;
		$sql = 'SELECT `otb_amt` FROM `otb` WHERE `otb_ship_date` LIKE "'.$key.'%" AND `area_ID`=2 ORDER BY `otb_ship_date`';
		$result = mysqli_query($db, $sql);
		if($result) {
			$count = mysqli_num_rows($result);
			for($ii=0; $ii<$count; $ii++){
				$pruchase = mysqli_fetch_assoc($result);
				$mp2[$i] = $mp2[$i] + $pruchase['otb_amt'];
			}
		}
	}	
	//mezz Floor
	for($i = 0; $i < 12; $i++) {
		$l = $i+1;
		$key = $year."-".($l);
		if(strlen(($l)) < 2) $key = $year."-0".$l;
		$sql = 'SELECT `otb_amt` FROM `otb` WHERE `otb_ship_date` LIKE "'.$key.'%" AND `area_ID`=3 ORDER BY `otb_ship_date`';
		$result = mysqli_query($db, $sql);
		if($result) {
			$count = mysqli_num_rows($result);
			for($ii=0; $ii<$count; $ii++){
				$pruchase = mysqli_fetch_assoc($result);
				$mp3[$i] = $mp3[$i] + $pruchase['otb_amt'];
			}
		}
	}
	//holders Floor
	for($i = 0; $i < 12; $i++) {
		$l = $i+1;
		$key = $year."-".($l);
		if(strlen(($l)) < 2) $key = $year."-0".$l;
		$sql = 'SELECT `otb_amt` FROM `otb` WHERE `otb_ship_date` LIKE "'.$key.'%" AND `area_ID`=4 ORDER BY `otb_ship_date`';
		$result = mysqli_query($db, $sql);
		if($result) {
			$count = mysqli_num_rows($result);
			for($ii=0; $ii<$count; $ii++){
				$pruchase = mysqli_fetch_assoc($result);
				$mp4[$i] = $mp4[$i] + $pruchase['otb_amt'];
			}
		}
	}	
	mysqli_close($db);	
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/enterBudget.css" type="text/css" />
	<title>Edit Budget</title>
	
    <style>
        .border td {
            border-color: black;   
            border-style: solid;
            border-width: 1px;   
            font-size: 12px  
        }  
        .top {
            vertical-align: top;        
        }  
        .black{
            background-color: black;
            width: 2px;        
        }
    </style>
</head>
<body>
	<?php if($alert){ ?>
	<div class="alert"><?= $alert ?></div>
	<?php } ?>
	Edit Budget:<br>
	Year: <?= $year ?> Total Budget: $<?= number_format($totalBudget,2) ?>
	<form action="editBudget.php" method="post"><input type="text" name="year"><input type="submit" value="Change Year"></form>
	<form action="processEditBudget.php" method="post">
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
				<td>
					<input class="amt" type="text" name="amt[<?= ((($i-1)*4) + 0) ?>]" value="<?= number_format($amt[((($i-1)*4) + 0)]['ob_amt'],2)?>">
					<input type="hidden" name="id[<?= ((($i-1)*4) + 0) ?>]" value="<?= $amt[((($i-1)*4) + 0)]['ob_ID']?>">
					<?php $firstFloorTotal = $firstFloorTotal +  $amt[((($i-1)*4) + 0)]['ob_amt'] ?>
				</td>
				<td>
					<input class="amt" type="text" name="amt[<?= ((($i-1)*4) + 1) ?>]" value="<?= number_format($amt[((($i-1)*4) + 1)]['ob_amt'],2)?>">
					<input type="hidden" name="id[<?= ((($i-1)*4) + 1) ?>]" value="<?= $amt[((($i-1)*4) + 1)]['ob_ID']?>">
					<?php $secondFloorTotal = $secondFloorTotal +  $amt[((($i-1)*4) + 1)]['ob_amt'] ?>
				</td>
				<td>
					<input class="amt" type="text" name="amt[<?= ((($i-1)*4) + 2) ?>]" value="<?= number_format($amt[((($i-1)*4) + 2)]['ob_amt'],2)?>">
					<input type="hidden" name="id[<?= ((($i-1)*4) + 2) ?>]" value="<?= $amt[((($i-1)*4) + 2)]['ob_ID']?>">
					<?php $lowerLevelTotal = $lowerLevelTotal +  $amt[((($i-1)*4) + 2)]['ob_amt'] ?>
				</td>
				<td>
					<input class="amt" type="text" name="amt[<?= ((($i-1)*4) + 3) ?>]" value="<?= number_format($amt[((($i-1)*4) + 3)]['ob_amt'],2)?>">
					<input type="hidden" name="id[<?= ((($i-1)*4) + 3) ?>]" value="<?= $amt[((($i-1)*4) + 3)]['ob_ID']?>">
					<?php $mezzanineTotal = $mezzanineTotal +  $amt[((($i-1)*4) + 3)]['ob_amt'] ?>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td class="totals"><?= number_format($firstFloorTotal,2) ?></td>
				<td class="totals"><?= number_format($secondFloorTotal,2) ?></td>
				<td class="totals"><?= number_format($lowerLevelTotal,2) ?></td>
				<td class="totals"><?= number_format($mezzanineTotal,2) ?></td>			
			</tr>
		</table>
		<input type="hidden" name="year" value="<?= $year ?>">
		<input type="submit" value="Save Budget">
	</form>
	<table class="border">
    	<tr>
    		<td>Month</td>
    		<td colspan="3">1st Floor</td><td class="black"></td>
    		<td colspan="3">2nd Floor</td><td class="black"></td>
    		<td colspan="3">Lower Level</td><td class="black"></td>
    		<td colspan="3">Mezzanine</td>
    	</tr>
    	<?php for($i = 0; $i < 12; $i++) { 
    	$dateObj   = DateTime::createFromFormat('!m', ($i+1));
    	$monthName = $dateObj->format('F');	
        $av1 = $budget1[$i]['ob_amt'] - $mp1[$i];
        $av2 = $budget2[$i]['ob_amt'] - $mp2[$i];
        $av3 = $budget3[$i]['ob_amt'] - $mp3[$i];
        $av4 = $budget4[$i]['ob_amt'] - $mp4[$i];
        $bg1 = "77ff77";
        $bg2 = "77ff77";
        $bg3 = "77ff77";
        $bg4 = "77ff77";
        $cf1 = 0;
        $cf2 = 0;
        $cf3 = 0;
        $cf4 = 0;
        if($av1 <= 0) {
            $bg1 = "ff0000";
	        if($i < 11) {
		        $mp1[$i+1] = $mp1[$i+1] + abs($av1);
		        $mp1[$i] = $mp1[$i] - abs($av1);
		        $av1 = 0;
	        }
        }
        if($av2 <= 0) {
            $bg2 = "ff0000";
	        if($i < 11) {
		        $mp2[$i+1] = $mp2[$i+1] + abs($av2);
		        $mp2[$i] = $mp2[$i] - abs($av2);
		        $av2 = 0;
	        }
        }
        if($av3 <= 0) {
            $bg3 = "ff0000";
	        if($i < 11) {
		        $mp3[$i+1] = $mp3[$i+1] + abs($av3);
		        $mp3[$i] = $mp3[$i] - abs($av3);
		        $av3 = 0;
	        }
        }
        if($av4 <= 0) {
            $bg4 = "ff0000";
	        if($i < 11) {
		        $mp4[$i+1] = $mp4[$i+1] + abs($av4);
		        $mp4[$i] = $mp4[$i] - abs($av4);
		        $av4 = 0;
	        }
        }
    	?>
    	<tr>
    		<td><?= $monthName ?></td>
    		<td><?= number_format($budget1[$i]['ob_amt'],2) ?></td>
    		<td><?= number_format($mp1[$i],2) ?></td>
    		<td bgcolor="<?= $bg1 ?>" ><?= number_format($av1,2) ?></td>
    		<td class="black"></td>
    		<td><?= number_format($budget2[$i]['ob_amt'],2) ?></td>
    		<td><?= number_format($mp2[$i],2) ?></td>
    		<td bgcolor="<?= $bg2 ?>" ><?= number_format($av2,2) ?></td>
    		<td class="black"></td>
    		<td><?= number_format($budget3[$i]['ob_amt'],2) ?></td>
    		<td><?= number_format($mp3[$i],2) ?></td>
    		<td bgcolor="<?= $bg3 ?>" ><?= number_format($av3,2) ?></td>
    		<td class="black"></td>
    		<td><?= number_format($budget4[$i]['ob_amt'],2) ?></td>
    		<td><?= number_format($mp4[$i],2) ?></td>
    		<td bgcolor="<?= $bg4 ?>" ><?= number_format($av4,2) ?></td>
    	</tr>
    	<?php } ?>
    </table>   
	<a href="index.php" ><-return</a>
</body>
</html>