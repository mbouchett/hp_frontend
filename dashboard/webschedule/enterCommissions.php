<?php
// entercommissions.php
// mark bouchett 04/19/2019

date_default_timezone_set('America/New_York');
include "/home/homeportonline/crc/2018.php";

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: index.php');
	die;
}
// ********************* initialize variables **********************************
@$alert = $_REQUEST['alert'];
$day = date('Y-m-d');
$today = date('Y-m-d H:i');
@$ppPrev = $_REQUEST['ppPrev'];

// *************************** Load pay period start ***************************
$fp = fopen('pp.txt', "r");
  $pp = fgets($fp);
  $ppDays = fgets($fp);
fclose($fp);

// ***************** calculate current payperiod start *************************
while (strtotime($pp) < strtotime($today)){
    $pp = date('Y-m-d', strtotime($pp. ' + '.$ppDays.' days'));
}
$ppStart = date('Y-m-d', strtotime($pp. ' - '.$ppDays.' days'));
$ppEnd =  date('Y-m-d', strtotime($pp. ' - 1 second'));

// load commissioned sales people
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `resource_ID`,`resource_firstName`,`resource_lastName`  
	    	FROM `resource` 
			WHERE `resource_lastDay` IS NULL AND `resource_com` = 1 
			ORDER BY `resource_lastName`';
$result = mysqli_query($db, $sql);
$resCount = mysqli_num_rows($result);
mysqli_close($db); 
for($i=0; $i<$resCount; $i++){
	$res[$i] = mysqli_fetch_assoc($result);
	$res[$i]['nickName'] = $res[$i]['resource_firstName']." ".substr($res[$i]['resource_lastName'],0,1);
}
// set up variables for previous pay period
if($ppPrev){
    $ppStart = $ppPrev;
    $ppEnd = date('Y-m-d', strtotime($ppStart. ' + '.$ppDays.' days'));
    $ppEnd =  date('Y-m-d', strtotime($ppEnd. ' - 1 second'));
}

//prepare next pay period start
$ppNext = date('Y-m-d', strtotime($ppStart. ' + '.$ppDays.' days'));
if($ppNext == $pp) unset($ppNext);
	
// ************************ load commissions ***********************************
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT *  
		FROM `com` 
		LEFT JOIN `resource` USING(`resource_ID`) 
		WHERE `com_date` BETWEEN '".$ppStart."' AND '".$ppEnd."' 
        ORDER BY `resource_ID`, `com_date`";

$result = mysqli_query($db, $sql);
$comCount = mysqli_num_rows($result);
mysqli_close($db); 

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

// ************************ calculate commissions ***********************************
$pool = 0.00;
for($i = 0; $i < $resCount; $i++) {
	for($j=0; $j < $comCount; $j++) {
		if($com[$j]['resource_ID'] == $res[$i]['resource_ID'] && $com[$j]['com_type'] == 1){ 
			@$res[$i]['reg'] = $res[$i]['reg'] + ($com[$j]['com_amt'] * $com[$j]['com_qty']);
			$pool = $pool + ($com[$j]['com_amt'] * $com[$j]['com_qty'])*.035;
		}
		if($com[$j]['resource_ID'] == $res[$i]['resource_ID'] && $com[$j]['com_type'] == 2){ 
			@$res[$i]['dis'] = $res[$i]['dis'] + ($com[$j]['com_amt'] * $com[$j]['com_qty']);
			$pool = $pool + ($com[$j]['com_amt'] * $com[$j]['com_qty'])*.0175;
		}
		if($com[$j]['resource_ID'] == $res[$i]['resource_ID'] && $com[$j]['com_type'] == 3){ 
			$res[$i]['pro'] = $res[$i]['pro'] + ($com[$j]['com_amt'] * $com[$j]['com_qty']);
		}
		if($com[$j]['resource_ID'] == $res[$i]['resource_ID'] && $com[$j]['com_type'] == 4){ 
			$res[$i]['spiff'] = $res[$i]['spiff'] + ($com[$j]['com_amt'] * $com[$j]['com_qty']);
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Enter Commissions</title>
<style>
	td{
		border-style: solid;
		border-color: black;
		border-width: 1px;
	}
</style>
</head>
<body>
	Enter Commissions : Today: <?= $today ?>
	<hr width="50%">
	<?php if($alert) { ?>
	***** <?= $alert ?> ****
	<hr width="50%">
	<?php } ?>
	<form onkeyup="validate()" action="processEnterCommissions.php" method="post">
		<input id="name" type="text" name="cust" placeholder="Customer Name: Last, First"> 
		<input id="desc" type="text" name="desc" placeholder="Item Description">
		<input id="qty" type="text" name="qty" value="1" size="1">
		<select name="type">
			<option value="1" label="Regular" selected>Regular</option>	
			<option value="2" label="Discount" >Discount</option>
			<option value="3" label="Protection" >Protection</option>
			<option value="4" label="Spiff" >Spiff</option>
		</select>
		<input id="amt" type="text" name="amt" placeholder="Amount 0.00">
		<input id="trans" type="text" name="trans" placeholder="Transaction #: 0-00000">
		<input type="date" value="<?= $day ?>" name="date">
		<select name="emp">
			<?php for($i=0; $i<$resCount; $i++){ ?>
			<option value="<?= $res[$i]['resource_ID'] ?>" label="<?= $res[$i]['nickName'] ?>"><?= $res[$i]['nickName'] ?></option>
			<?php } ?>
		</select>
		<input id="submit" type="submit" value="Submit" disabled>
	</form>
	<hr>
	
	<div class="alignright">
      <span class="dashtitlemed">Pay Period Beginning: <?= $ppStart ?> ->
      Pay Period Ending: <?= $ppEnd ?><br>
      </span>
      <!-- Show the links to other pay periods -->
    <a class="dashbut" href="enterCommissions.php?ppPrev=<?= date('Y-m-d', strtotime($ppStart. ' - 14 days')) ?>"><span class="icontext">&larr;&nbsp;</span>Previous PP</a>
    <?php if(@$ppNext){ ?>

    <!-- Html Begins Here for the View Next if there's more-->
    &nbsp;&nbsp;&nbsp; <a class="dashbut" href="enterCommissions.php?ppPrev=<?= $ppNext ?>">Next PP<span class="icontext">&nbsp;&rarr;</span></a>
    <!-- Html Ends Here -->
    <?php } ?>
    </div>
    Pool = <?= number_format($pool,2) ?>
    <div style="display: inline; ">
    <table>
    	<tr><td>Associate</td><td>Regular</td><td>discount</td><td>Protection</td><td>Spiff</td><td>Pool Contribution</td><td>Pool Draw</td><td>Total Commission</td></tr>
	    <?php for($i = 0; $i < $resCount; $i++) { 
	    $contribution = $res[$i]['reg'] * 0.035 + $res[$i]['dis'] * 0.0175;
	    $poolDraw = $pool/$resCount;
	    @$totalComm = $contribution + $poolDraw + $res[$i]['pro'] + $res[$i]['draw'];
	    ?>
	    <tr>
	    	<td><?= $res[$i]['nickName'] ?></td>
	    	<td style="text-align: right;"><?= number_format($res[$i]['reg'],2) ?></td>
	    	<td style="text-align: right;"><?= number_format($res[$i]['dis'],2) ?></td>
	    	<td style="text-align: right;"><?= number_format(@$res[$i]['pro'],2) ?></td>
	    	<td style="text-align: right;"><?= number_format(@$res[$i]['spiff'],2) ?></td>
	    	<td style="text-align: right;"><?= number_format($contribution,2) ?></td>
	    	<td style="text-align: right;"><?= number_format($poolDraw,2) ?></td>
	    	<td style="text-align: right;"><?= number_format($totalComm,2) ?></td>
	    </tr>
	    <?php } ?>
    </table>

	<form action="processSearchComm.php" method="post">
		<input type="text" name="cust" placeholder="Search Customer Name"><br>
    	<input type="text" name="trans" placeholder="Search Transaction Number">
    	<input type="submit">
	</form>

    </div>
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
			<td><a onclick="deleteCom(<?= $com[$i]['com_ID'] ?>, '<?= $com[$i]['com_cust'] ?>', '<?= number_format($com[$i]['com_amt'],2) ?>', '<?= $com[$i]['com_trans'] ?>')" >Delete</a></td>
		</tr>
		<?php } ?>
	</table>
	<a href="scheduleDash.php" ><- Return</a>
	
	<script defer="defer" type="text/javascript" src="js/enterCommissions.js"></script>
</body>
</html>