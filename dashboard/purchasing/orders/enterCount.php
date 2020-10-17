<?php
//enterCount.php 2018/01
// enter a vendor count worksheet
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
function getWeek(){
	$seconds = time();
	//echo "Seconds since 01/01/1970 ->".$seconds."<br>";
	$minutes = floor($seconds/60);
	//echo "Minutes since 01/01/1970 ->".$minutes."<br>";
	$hours = floor($minutes/60);
	//echo "Hours since 01/01/1970 ->".$hours."<br>";
	$days = floor($hours/24)-4;
	//echo "Days since 01/01/1970 ->".$days."<br>";
	$weeks = floor($days/7);
	//echo "Hours since 01/01/1970 ->".$weeks."<br>";
	$currentWeek = (($weeks-1) % 8) + 1;
	//echo "Current week ->".$currentWeek."<br>";
	return $currentWeek;
}
$override = 0;
$override = $_REQUEST['override'];
$vendor_ID = $_REQUEST['vendor_ID'];
if(!$vendor_ID) $vendor_ID = 516;

$today = date("F d, Y");

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$vendor_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);

if($result) {
	$vendor = mysqli_fetch_assoc($result);
}else{
	echo "Vendor Not Found";
	die;
}

// load vendor catalog into array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `items` 
		  LEFT JOIN `items_hist` USING (`item_ID`)
        LEFT JOIN `departments` USING (`dept_ID`)
		  WHERE `items`.`vendor_ID` = '.$vendor['vendor_ID']."
		  ORDER BY `dept_belongs_to`, `dept_ID`, `item_desc`";
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
	$items[$i]['ext'] = $items[$i]['item_cost'] * $items[$i]['item_tempOQ'];
	$totalOrder += $items[$i]['ext'];
}
	
$itemcount=count($items);

?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $vendor['vendor_name'] ?> Order</title>
	<link href="css/enterCount.css" rel="stylesheet" type="text/css" />
</head>
<body onload="focus()">
<form action="processEnterCount.php" method="post">
<table class="count">
	<tr>
		<td class="menu" onclick="clearEntries();">Clear Count</td>
		<td class="menu"><button style="width: 120px;" type="submit" name="submit" value="Save Count">Save Count</button></td>
		<td class="menu"><button style="width: 130px;" type="submit" name="submit" value="Preview Order">Preview Order</button></td>
		<td class="menu">
		<?php if($vendor['vendor_group'] == getWeek()){ ?>
			<button onclick="return areYouSure();" style="width: 120px; background-color: #00bb00; color: #ffffff" 
			type="submit" name="submit" value="Cycle Order">
			Process Count/Order</button>
		<?php } ?>		
		</td>
		<td class="menu" title="On Hand Quantities Will Be Ignored">
			<button onclick="return areYouSure();" style="width: 120px; background-color: #8888dd;" type="submit" name="submit" value="OC Order">Place Off Cycle Order</button>
		</td>	
		<td class="menu"><button style="width: 120px;" type="submit" name="submit" value="Exit">Exit</button></td>
	</tr>
</table>

<table class="count">
    <tr>
        <th onclick="tman()"><?= $vendor['vendor_name'] ?></th>
        <th>Order Worksheet</th>
        <th><?= $today ?></th>
    </tr>
    <tr><td colspan="4"><hr width="960" size="12" noshade="noshade"/></td></tr>
</table>

<table class="count">
    <tr><td>Last Counted: <?= $vendor['vendor_lastCount'] ?></td><td colspan="10" style="text-align: right;">Order Total $ <?= number_format($totalOrder,2)?></td></tr>
    <tr><td height="1" colspan="11" bgcolor="#767676"></td></tr>
    <tr class="print"> <!-- Titles -->
    	  <td>Pic</td>
        <td onclick="recalc()">Sku</td>
        <td>Description</td>
        <td>Cat</td>
        <td>Cost</td>
        <td>Retail</td>
        <td>Last Order Info</td>
        <td>Pack</td>
         <td>LOH</td>
        <td>O/H</td>
        <td>Order</td>
        <td>Ext</td>
    </tr>
    <tr><td height="1" colspan="11" bgcolor="#000000"></td></tr>
    <?php  for($i=0; $i<$itemcount; $i++){
            if(strlen($items[$i]['item_desc']) > 78){
                $items[$i]['item_desc'] = substr($items[$i]['item_desc'],0,78)."...";
            }
            $hist = "[".$items[$i]['h1']."] [".$items[$i]['h2']."] [".$items[$i]['h3']."] [".$items[$i]['h4']."] [".
					$items[$i]['h5']."] [".$items[$i]['h6']."] [".$items[$i]['h7']."] [".$items[$i]['h8']."]";
    ?>
	<tr >
		
		<td rowspan="2" class="pic" onclick="pop(<?= $items[$i]['item_ID'] ?>)" >			
		<!-- <td class="pic" > -->
			<?php if($items[$i]['item_pic']) { ?>
         <a class="thumbnail" href="#thumb">
         <img style="max-height: 25px; max-width: 25px" border="0" src="<?= resolve($items[$i]['item_pic']) ?>" />
         <span><img src="<?= resolve($items[$i]['item_pic']) ?>"/></span>
         </a>
         <?php }else{ ?>
             <a><img border="0" src="../images/nopic.jpg" /></a>
         <?php } ?>
		</td>		
		<td rowspan="2" class="print" >
			<?= $items[$i]['item_sku'] ?> 
			<input type="hidden" name="item_ID[<?= $i ?>]" value="<?= $items[$i]['item_ID'] ?>">
		</td>
		<td class="print" style="font-size: 12px"><?= $items[$i]['item_desc'] ?></td>
		<td class="print" rowspan="2" title="<?= $items[$i]['dept_name'] ?>" ><?= $items[$i]['dept_belongs_to'] ?>-<?= $items[$i]['dept_ID'] ?></td>
		<td class="print" rowspan="2" ><?= $items[$i]['item_cost'] ?></td>
		<td class="print" rowspan="2" ><?= $items[$i]['item_retail'] ?></td>
		<td class="print" style="font-size: 10px">[<?= $items[$i]['loq'] ?>] <?= $items[$i]['lpo'] ?> : <?= $items[$i]['ldat'] ?></td>
		<td class="print" rowspan="2" ><?= $items[$i]['item_pack'] ?></td>
		<td class="print" rowspan="2"><span style="color: red;" ><?= $items[$i]['item_qty'] ?></span></td>
		<!-- on Hand Column -->
		<td rowspan="2" >
			<input 
				onkeypress="return ohCatch(event,<?= ($i * 3 + 1) ?>);"
				class="oh" name="qty[<?= $i ?>]" value="<?= $items[$i]['item_tempOH'] ?>"
			>
		</td>
		<!-- On Order Column -->
		<td rowspan="2" >
			<input
				onkeypress="return oqCatch(event,<?= ($i * 3 + 2) ?>);" 
				class="oq" name="ord[<?= $i ?>]" value="<?= $items[$i]['item_tempOQ'] ?>"
			>
		</td>
		<!-- End Entry Columns -->
		<td rowspan="2" class="ext"><?= number_format($items[$i]['ext'],2) ?></td>
	</tr>
	<tr>
		<td class="print" style="font-size: 12px "> History:&nbsp;&nbsp;&nbsp; <?= $hist ?> </td>
		<td class="print" style="font-size: 10px ">[<?= $items[$i]['poq'] ?>] <?= $items[$i]['ppo'] ?> : <?= $items[$i]['pdat'] ?></td>
	</tr>
	<tr><td height="1" colspan="11" bgcolor="#767676"></td></tr>
	<?php  }?>
	<tr class="ext"><td colspan="11">Order Total $ <?= number_format($totalOrder,2)?></td></tr>
</table>
<input type="hidden" name="vendor_ID" value="<?=  $vendor_ID ?>">
<hr width="960" size="12" noshade="noshade"/>
<table class="count">
	<tr>
		<td class="menu" onclick="clearEntries();">Clear Count</td>
		<td class="menu"><button style="width: 120px;" type="submit" name="submit" value="Save Count">Save Count</button></td>
		<td class="menu"><button style="width: 130px;" type="submit" name="submit" value="Preview Order">Preview Order</button></td>
		<td class="menu">
		<?php if($vendor['vendor_group'] == getWeek() || $override == 1){ ?>
			<button onclick="return areYouSure();" style="width: 120px; background-color: #00bb00; color: #ffffff" 
			type="submit" name="submit" value="Cycle Order">
			Process Count/Order</button>
		<?php } ?>		
		</td>
		<td class="menu" title="On Hand Quantities Will Be Ignored">
			<button onclick="return areYouSure();" style="width: 120px; background-color: #8888dd;" type="submit" name="submit" value="OC Order">Place Off Cycle Order</button>
		</td>	
		<td class="menu"><button style="width: 120px;" type="submit" name="submit" value="Exit">Exit</button></td>
	</tr>
</table>
</form>
<a href="enterCount.php?vendor_ID=<?= $vendor_ID ?>&override=1">*</a>
<script defer="defer" type="text/javascript" src="js/enterCount.js"></script>
</body>
</html>