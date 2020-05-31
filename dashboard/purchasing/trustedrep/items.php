<?php
//items.php 2018/01
// Vendor Catalog Edit Workspace
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['repnum'])){
		header('Location: index.php');
		die;
  	}

if(!$vendor_ID) $vendor_ID = $_REQUEST['vendor_ID'];
$sort = ($_REQUEST['sort']) ?  $_REQUEST['sort'] : 'S';

unset($message);
@$message=$_REQUEST['message'];
unset($focus);
if(substr($message, 0, 10)=="Item Added") $focus="setFocus()";

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
if($sort == 'D') {
	$sql = 'SELECT * 
			  FROM `items` 
			  LEFT JOIN `items_hist` USING (`item_ID`)
			  WHERE `items`.`vendor_ID` = '.$vendor['vendor_ID']."
			  ORDER BY `item_desc`";
}else {
	$sql = 'SELECT * 
			  FROM `items` 
			  LEFT JOIN `items_hist` USING (`item_ID`)
			  WHERE `items`.`vendor_ID` = '.$vendor['vendor_ID']."
			  ORDER BY `item_sku`";
}
$result = mysqli_query($db, $sql);

$num_results = 0;
if($result) $num_results = mysqli_num_rows($result);

mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
}
	
$itemcount=count($items);

?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $vendor['vendor_name'] ?> - (<?= $itemcount ?>)</title>
	<link href="../css/items.css" rel="stylesheet" type="text/css" />
    <link href="../../icons/all.css" rel="stylesheet" type="text/css" />
</head>
<body onload="<?= $focus ?>" >
<div onclick="pop_clear()" id="screen" class="blackout"></div>
<div class="optionMenu">
	<a class="optionBtn" href="companySelect.php">Exit to Vendor List <i class="fas fa-external-link-alt"></i></a>
</div>
	<!-- Status Message -->
	<?php if($message){?><br /><?=$message?><?php  }?>	
<div class="tableContainer">
	<!-- Vendor Info -->
	<table width="800px">
		<tr ><td><?= $vendor['vendor_name'] ?></td><td>Group: <?= $vendor['vendor_group'] ?></td></tr>
		<tr><td><?= $vendor['vendor_addr1'] ?></td><td><?= $vendor['vendor_rep'] ?></td></tr>
		<tr><td><?= $vendor['vendor_addr2'] ?></td><td>Fax: <?= $vendor['vendor_fax'] ?></td></tr>
		<tr><td><?= $vendor['vendor_addr3'] ?></td><td>Voice: <?= $vendor['vendor_voice'] ?></td></tr>
		<tr><td><?= $vendor['vendor_email'] ?></td><td>Multiplier: <?= $vendor['vendor_multi'] ?></td></tr>
		<tr><td>Ship Method 1: <?= $vendor['vendor_ship1'] ?></td>
			 <td rowspan="2">
				<?php if($vendor['vendor_hti'] == 1){ ?>
				<img src="images/hti.jpg" alt="HTI" height="50px" />
            	<?php } ?>
			</td>
		</tr>
		<tr><td>Ship Method 2: <?= $vendor['vendor_ship2'] ?></td></tr>
		<tr><td colspan="2"><span onclick="visvend()">Note:</span> <?= $vendor['vendor_note'] ?></td></tr>
	<?php if($wantcount>0 && !$message){ ?>      
    <tr>
        <td colspan="2" style="font-family: Arial; font-size: 10px; color: #CC0000">
        Wantlists To Be Ordered: <br />
        <?php for($i=0; $i< $wantcount; $i++){ ?>
            <a target="_blank" href="../cs/csEdit.php?cust_ID=<?= $wants[$i]['cust_ID'] ?>"><?= $wants[$i]['ci_desc'] ?></a><br />
        <?php } ?>
        </td>
    </tr>       
	<?php } ?>
	</table>
	<form action="processItems.php" method="post" >
	<!-- record count and vendor_ID for processing -->
	<input type="hidden" name="multiplier" value="<?= $vendor['vendor_multi'] ?>" />
	<input type="hidden" name="recordcount" value="<?= $itemcount ?>" />
	<input type="hidden" name="vendor_ID" value="<?= $vendor_ID ?>" /> 
    <button class="saveBtn" type="submit" />Save Edits</button>
	
	<table>
		<tr>
			<td class="pic">Pic</td>
			<td class="sku"><a href="items.php?vendor_ID=<?= $vendor_ID ?>&sort=S" >SKU</a></td>
			<td class="desc"><a href="items.php?vendor_ID=<?= $vendor_ID ?>&sort=D" >Description</a></td>
			<td class="pack">Pack Qty</td>
			<td class="cost">Cost</td>
			<td class="retail">Sell Price</td>
			<td class="qty">On Hand</td>
		</tr>	
		<?php for($i=0; $i<$num_results; $i++){ ?>
		<tr>
			<td class="pic" onclick="pop(<?= $items[$i]['item_ID'] ?>)" >	
				<input type="hidden" name="vnd[<?= $i ?>]" value="<?= $items[$i]['vendor_ID'] ?>" />
				<input type="hidden" name="item_ID[<?= $i ?>]" value="<?= $items[$i]['item_ID'] ?>" />		
			<!-- <td class="pic" > -->
				<?php if($items[$i]['item_pic']) { ?>
            <a class="thumbnail" href="#thumb">
            <img style="max-height: 25px; max-width: 25px" border="0" src="<?= resolve($items[$i]['item_pic']) ?>" />
            <span><img src="<?= resolve($items[$i]['item_pic']) ?>"/></span>
            </a>
            <?php }else{ ?>
                <a onclick="pop(<?= $items[$i]['item_ID'] ?>)" ><img border="0" src="../images/add-button.jpg" /></a>
                <!-- <img border="0" src="images/add-button.jpg" /> -->
            <?php } ?>
			</td>
			<td class="sku" title="Deleting The Sku Will Delete The Item!">
				<input class="sku" name="sku[<?= $i ?>]" value="<?= strtoupper($items[$i]['item_sku']) ?>" />
				<input type="hidden" name="oldsku[<?= $i ?>]" value="<?= strtoupper($items[$i]['item_sku']) ?>">
			</td>
			<td class="desc">
				<input class="desc" name="desc[<?= $i ?>]" value="<?= stripslashes($items[$i]['item_desc']) ?>" />
			</td>
			<?php if(is_numeric($items[$i]['item_pack'])){ ?>
			<td class="pack"><input class="pack" name="pack[<?= $i ?>]" value="<?= $items[$i]['item_pack'] ?>"></td>
			<?php }else{ ?>
			<td class="pack">
				<?= $items[$i]['item_pack'] ?>
				<input type="hidden" class="pack" name="pack[<?= $i ?>]" value="<?= $items[$i]['item_pack'] ?>">
			</td>
			<?php } ?>
			<td class="cost"><input class="cost" name="cost[<?= $i ?>]" value="<?= number_format( $items[$i]['item_cost'],2) ?>" /></td>
			<td class="retail">
				<?= number_format( $items[$i]['item_retail'],2) ?>
				<input type="hidden" class="retail" name="retail[<?= $i ?>]" value="<?= number_format( $items[$i]['item_retail'],2) ?>"/>
			</td>
			<td class="qty"> <?= $items[$i]['item_qty'] ?></td>
		</tr>
		<?php } ?>
	</table>
	<button class="saveBtn" type="submit">Save Edits <i class="far fa-save"></i></button>
	</form>
</div>
	<br>
	<hr>
	<div class="optionMenu">
		<a class="optionBtn" href="companySelect.php">Exit to Vendor List <i class="fas fa-external-link-alt"></i></a>
	</div>

	<script defer="defer" type="text/javascript" src="../js/inventoryItems.js"></script>
</body>
</html>