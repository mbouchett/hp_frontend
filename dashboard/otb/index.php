<?php
	//dashboard.php 2018/01
	// dashboard
	include "/home/homeportonline/crc/2018.php";
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
  	$today = date('Y-m-d');
  	$ponum = $_POST['ponum'];
    $year = date('Y');
  	
  	if($ponum) {
		// ******************* Get po List *******************
		$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
		$sql = 'SELECT * 
				  FROM `otb`
				  LEFT JOIN `vendors` USING (`vendor_ID`)
		          LEFT JOIN `departments` USING (`dept_ID`)
				  WHERE `otb_po` LIKE "'.$ponum.'%"';
		$result = mysqli_query($db, $sql);
		if(!$result){
			echo "Lookup Error!<br>";
			echo $sql."<br>";
			echo mysqli_error($db);
			die;
		}
		if($result) {
			$poCount = mysqli_num_rows($result);
			for($i=0; $i<$poCount; $i++){
				$po[$i] = mysqli_fetch_assoc($result);
			}
		}
	}
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
    <title>Open To Buy</title>
	<link rel="stylesheet" href="css/index.css" type="text/css" />

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
<table>
        <td class="top">
        	Budget to Date: <?= $today ?>
        	
        	<form name="select" action="enterPurchase.php" method="post">
        	Enter Order For:<br>
        	<select name="floor">
        		<option value="1" onclick="this.form.submit()" >First Floor</option>	
        		<option value="2" onclick="this.form.submit()" >Second Floor</option>	
        		<option value="3" onclick="this.form.submit()" >Lower Level</option>	
        		<option value="4" onclick="this.form.submit()" >Mezzanine</option>	
        	</select>
        	<input type="submit" value="Go">
        	</form>  
        </td>
    </table>
        <td>
            <table class="border">
            	<tr>
            		<th>Month</th>
            		<th colspan="3">1st Floor</th><td class="black"></td>
            		<th colspan="3">2nd Floor</th><td class="black"></td>
            		<th colspan="3">Lower Level</th><td class="black"></td>
            		<th colspan="3">Mezzanine</td>
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
            		<th><?= $monthName ?></th>
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
        </td>  
    

	<hr>
	<form action="index.php" method="post">
	Have I already Entered This PO <input type="text" name="ponum"> <input type="submit" value="Let's Find Out!">	
	</form>
	<hr>
	<?php if($ponum) { ?>
	<table>
		<?php for($i=0; $i<$poCount; $i++){ 
		$total = $total + $po[$i]['otb_amt'];		
		?>
		<tr>
			<td><?= $po[$i]['otb_ship_date'] ?></td>
			<td><?= $po[$i]['vendor_name'] ?></td>
			<td><?= $po[$i]['dept_name'] ?></td>
			<td><?= number_format($po[$i]['otb_amt'],2) ?></td>
			<td><a href="../purchasing/orders/viewOrder.php?order_ID=<?= substr($po[$i]['otb_po'],0,7)  ?>" ><?= $po[$i]['otb_po'] ?></a></td>
			<td><?= $po[$i]['otb_buyer'] ?></td>
			<td><?= $po[$i]['otb_comment'] ?></td>
		</tr>
		<?php } ?>
	</table>	
	Total: <?= $total ?>
	<hr>
	<?php } ?>
	<?php
	if($_SESSION['username'] == "abouchett" || $_SESSION['username'] == "mbouchett" || $_SESSION['username'] == "francois" || $_SESSION['username'] == "bbouchett") {
	?>
	<a href="editBudget.php">Edit Budget Year</a><br>
	<a href="enterBudget.php">Create Budget Year</a><br>
	
	<?php } ?>
	<a href="../" ><-Return</a>
</body>
</html>