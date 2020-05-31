<?php
//items.php 2018/01
// Vendor Catalog Edit Workspace
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
@$vendor_ID = $_POST['vendor_ID'];

if(!$vendor_ID) $vendor_ID = $_REQUEST['vendor_ID'];
if(!$vendor_ID) $vendor_ID = 516;

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
$sql = 'SELECT * 
		  FROM `items` 
		  LEFT JOIN `items_hist` USING (`item_ID`)
        LEFT JOIN `departments` USING (`dept_ID`)
		  WHERE `items`.`vendor_ID` = '.$vendor['vendor_ID']."
		  ORDER BY `dept_belongs_to`, `dept_ID`, `item_desc`";
$result = mysqli_query($db, $sql);

$num_results = 0;
if($result) $num_results = mysqli_num_rows($result);

mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
}
	
$itemcount=count($items);

// load departments into array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `departments` ORDER BY `dept_name`";
$result = mysqli_query($db, $sql);
$depCount=mysqli_num_rows($result);
mysqli_close($db);

//Store the Results To A Local Array
for($i = 0; $i < $depCount; $i++){
	$depts[$i] = mysqli_fetch_assoc($result);
}

// *************** see if there are any pending wantlists ***************
//Open cust_items Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `cust_items` WHERE `vendor_ID`='.$vendor_ID;
$result = mysqli_query($db, $sql);
$num_res=mysqli_num_rows($result);
mysqli_close($db);

$ii = 0;
// get items that have not been ordered
for($i=0; $i<$num_res; $i++){ 
	$row=mysqli_fetch_assoc($result);
	if(!$row['ci_dateordered']){
		$wants[$ii] =  $row;
		$ii = $ii+1;
	}
}
@$wantcount=count($wants);

?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $vendor['vendor_name'] ?> - (<?= $itemcount ?>)</title>
	<link href="css/items.css" rel="stylesheet" type="text/css" />
    <link href="../../icons/all.css" rel="stylesheet" type="text/css" />
</head>
<body onload="<?= $focus ?>" >
<div onclick="pop_clear()" id="screen" class="blackout"></div>
<div class="optionMenu">
			<a class="optionBtn" href="printCount.php?vendor_ID=<?= $vendor_ID ?>" >Print Count <i class="fa fa-print"></i></a>
			<a class="optionBtn" href="mobileCount/enterMobileCount.php?vendor_ID=<?= $vendor_ID ?>" >Mobile Count <i class="fa fa-mobile-alt"></i></a>
			<a class="optionBtn" href="orders/enterCount.php?vendor_ID=<?= $vendor_ID ?>" >Enter Count <i class="fa fa-sort-numeric-down"></i></a>
            <a class="optionBtn" href="vendors/editVendor.php?vendor_ID=<?= $vendor_ID ?>" >Edit Vendor <i class="far fa-edit"></i></a>
			<a class="optionBtn" href="vendorSelect.php?direction=Work" ><i class="fa fa-arrow-left"></i> Back to Vendor Select</a>
			
			<a class="optionBtn" href="index.php">Exit to Purchasing Dashboard <i class="fas fa-external-link-alt"></i></a>
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
		<tr><td><?= $vendor['vendor_email'] ?></td><td>Multiplier: <input id="multi" name="multi" size="4" value="<?= $vendor['vendor_multi'] ?>" /></td></tr>
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
	<input type="hidden" name="recordcount" value="<?= $itemcount ?>" />
	<input type="hidden" name="vendor_ID" value="<?= $vendor_ID ?>" /> 
        <button class="saveBtn" type="submit" />Save Edits <i class="far fa-save"></i></button>
	
	<table>
		<tr>
			<td class="vnd">VND #</td>
			<td class="item_ID">ID</td>
			<td class="pic">Pic</td>
			<td class="sku">SKU</td>
			<td class="desc">Description</td>
			<td class="dept">Cat</td>
			<td class="pack">Pack</td>
			<td class="cost">Cost</td>
			<td class="retail">Sell Price</td>
			<td class="reg">Reg Price</td>
			<td class="qty">Qty</td>
			<td class="ppo">Last Order</td>
			<td class="details"></td>
		</tr>	
		<?php for($i=0; $i<$num_results; $i++){ 
					$hist = "[".$items[$i]['h1']."] [".$items[$i]['h2']."] [".$items[$i]['h3']."] [".$items[$i]['h4']."] [".
					$items[$i]['h5']."] [".$items[$i]['h6']."] [".$items[$i]['h7']."] [".$items[$i]['h8']."]";
					if(!$items[$i]['h1']) $items[$i]['h1'] = 0;
					if(!$items[$i]['h2']) $items[$i]['h2'] = 0;
					if(!$items[$i]['h3']) $items[$i]['h3'] = 0;
					if(!$items[$i]['h4']) $items[$i]['h4'] = 0;
					if(!$items[$i]['h5']) $items[$i]['h5'] = 0;
					if(!$items[$i]['h6']) $items[$i]['h6'] = 0;
					if(!$items[$i]['h7']) $items[$i]['h7'] = 0;
					if(!$items[$i]['h8']) $items[$i]['h8'] = 0;
                    $parent = $items[$i]['dept_belongs_to'].":";
		?>
		<tr>
			<td class="vnd"><input type="text" name="vnd[<?= $i ?>]" value="<?= $items[$i]['vendor_ID'] ?>" /></td>
			<td class="item_ID"><?= $items[$i]['item_ID'] ?><input type="hidden" name="item_ID[<?= $i ?>]" value="<?= $items[$i]['item_ID'] ?>" /></td>
			<td class="pic" onclick="pop(<?= $items[$i]['item_ID'] ?>)" >			
			<!-- <td class="pic" > -->
				<?php if($items[$i]['item_pic']) { ?>
            <a class="thumbnail" href="#thumb">
            <img style="max-height: 25px; max-width: 25px" border="0" src="<?= resolve($items[$i]['item_pic']) ?>" />
            <span><img src="<?= resolve($items[$i]['item_pic']) ?>"/></span>
            </a>
            <?php }else{ ?>
                <a onclick="pop(<?= $items[$i]['item_ID'] ?>)" ><img border="0" src="images/add-button.jpg" /></a>
                <!-- <img border="0" src="images/add-button.jpg" /> -->
            <?php } ?>
			</td>
			<td class="sku" title="Deleting The Sku Will Delete The Item!">
				<input class="sku" name="sku[<?= $i ?>]" value="<?= strtoupper($items[$i]['item_sku']) ?>" />
				<input type="hidden" name="oldsku[<?= $i ?>]" value="<?= strtoupper($items[$i]['item_sku']) ?>">
			</td>
			<td class="desc" title="<?= $hist ?>">
				<input class="desc" name="desc[<?= $i ?>]" value="<?= stripslashes($items[$i]['item_desc']) ?>" />
			</td>
			<td class="deptP" title="<?= $items[$i]['dept_name'] ?>"><?= $parent ?><input class="dept" name="dept[<?= $i ?>]" value="<?= $items[$i]['dept_ID'] ?>" /></td>
			<td class="pack"><input class="pack" name="pack[<?= $i ?>]" value="<?= $items[$i]['item_pack'] ?>" /></td>
			<td class="cost"><input ondblclick="retailCalc(this, <?= $i ?>)" class="cost" name="cost[<?= $i ?>]" value="<?= number_format( $items[$i]['item_cost'],2) ?>" /></td>
			<td class="retail"><input class="retail" name="retail[<?= $i ?>]" value="<?= number_format( $items[$i]['item_retail'],2) ?>" /></td>
			<td class="reg"><input class="reg" name="reg[<?= $i ?>]" value="<?= $items[$i]['item_regPrice'] ?>" /></td>
			<td class="qty" onclick="popHist(<?= $items[$i]['item_ID'] ?>,
														<?= $items[$i]['item_qty'] ?>,
														<?= $items[$i]['h1'] ?>,
														<?= $items[$i]['h2'] ?>,
														<?= $items[$i]['h3'] ?>,
														<?= $items[$i]['h4'] ?>,
														<?= $items[$i]['h5'] ?>,
														<?= $items[$i]['h6'] ?>,
														<?= $items[$i]['h7'] ?>,
														<?= $items[$i]['h8'] ?>);">
				<?= $items[$i]['item_qty'] ?>
			</td>
			<td class="ppo" title="[<?= $items[$i]['poq'] ?>] <?= $items[$i]['ppo'] ?> <?= $items[$i]['pdat'] ?>">
				<a href="orders/viewOrder.php?order_ID=<?= substr($items[$i]['lpo'],0,7) ?>" >[<?= $items[$i]['loq'] ?>] <?= $items[$i]['lpo'] ?><br><?= $items[$i]['ldat'] ?><a>
			</td>
			<?php $plusColor = ($items[$i]['item_details']) ? "55ff55" : "000000"; ?>
			<td title="<?= $items[$i]['item_details'] ?>" class="details" onclick="pop2(<?= $items[$i]['item_ID'] ?>,<?= $i ?>)" style="color: #<?= $plusColor ?> ;">+</td>		
		</tr>
		<?php } ?>
	</table>
	<button class="saveBtn" type="submit">Save Edits <i class="far fa-save"></i></button>
	</form>
</div>
<div class="tableContainer">	
	<!-- Add Item Section -->
	Add a new item:
	<form action="processAddItems.php" method="post" />
	<table>
	    <tr><td>Sku</td><td>Description</td><td>Cat</td><td>Pack</td><td>Cost</td><td>Retail</td><td>Add Item</td></tr>
	    <tr>
	        <td width="125"><input onblur="checkSku()" id="theSku" size="19" name="isku" value="" /></td>
	        <td width="375"><input size="58" name="desc" value="" /></td>
	        <td width="40"><input id="deptAdd" onfocus="catPop()" onblur="catUnPop()" size="2" name="dept" value="" /></td>
	        <td width="40"><input id="pack" size="2" name="pack" value="" /></td>
	        <td width="60"><input id="cost" onblur="price()" style=" text-align: right" size="7" name="cost" value="" /></td>
	        <td width="60"><input id="retail" style=" text-align: right" size="7" name="retail" value="" /></td>
	        <td style="font-size: 14px; font-weight: bold; font-family: Arial" ><input style="font-weight: bold" class="dashbut" value="Add New Item Here" type="submit" /></td>
	    </tr>
	</table>
	<input type="hidden" name="vendor_ID" value="<?= $vendor_ID ?>" />
	</form>
    
</div>
	<br>
	<hr>
	<div class="optionMenu">
			<a class="optionBtn" href="printCount.php?vendor_ID=<?= $vendor_ID ?>" >Print Count <i class="fa fa-print"></i></a>
			<a class="optionBtn" href="mobileCount/enterMobileCount.php?vendor_ID=<?= $vendor_ID ?>" >Mobile Count <i class="fa fa-mobile-alt"></i></a>
			<a class="optionBtn" href="orders/enterCount.php?vendor_ID=<?= $vendor_ID ?>" >Enter Count <i class="fa fa-sort-numeric-down"></i></a>
            <a class="optionBtn" href="vendors/editVendor.php?vendor_ID=<?= $vendor_ID ?>" >Edit Vendor <i class="far fa-edit"></i></a>
			<a class="optionBtn" href="vendorSelect.php?direction=Work" ><i class="fa fa-arrow-left"></i> Back to Vendor Select</a>
			
			<a class="optionBtn" href="index.php">Exit to Purchasing Dashboard <i class="fas fa-external-link-alt"></i></a>
    </div>
	
	<!-- ============================= if the vendor has no items allow deletion========= -->
	
	<?php if($itemcount == 0) { // There are no items for this vendor?>
         <div class="delete" onclick=" return deleteVendor(<?= $vendor_ID ?>)"><input class="delete" name="" type="button" value="Delete Vendor" /></div>
	<?php } ?>
<?php if($wantcount>0 && !$message){
        $wlm = "There Are ".$wantcount." Unordered Wantlists Associated With This Vendor\\n\\n";
        for($i=0; $i< $wantcount; $i++){
          @$wlm .= $wants[$i]['description'].'\\n';
        }
        echo '<script type="text/javascript"> alert("'.$wlm.'"); </script>';
} ?>	
	<!-- =============================save an image pop up=============================== -->
    <div id="pop" class="popup" onblur="pop_clear()">
      <form enctype="multipart/form-data" action="<?= $imageLocation ?>saveImage.php" method="post">
      Submit Empty To Delete Image
          <table>
            <tr>
              <td>
                  <span id="recspan"></span>
                  <input id="record" type="hidden" name="item_ID" value="" />
                  <input type="hidden" name="vendor_ID" value="<?= $vendor_ID?>" />
              </td>
            </tr>
            <!--<tr>
              <td>Image To Uplaod</td><td><input name="filename" type="file" size="50" /></td>
            </tr>-->
            <tr>
              <td>Url To Grab</td><td><input name="url" size="50" /></td>
            </tr>
            <tr>
              <td>Picture To Load</td><td><input type="file" name="pic" size="50" /></td>
            </tr>
            <tr><td align="center" colspan="2"><input type="submit" name="submit" value="Submit" /></td> </tr>
          </table>
      </form>
    </div>
    <!-- =============================Edit item on hand=============================== -->
    <div id="popHist" class="popup">	
    <form action="processUpdateHist.php" method="post">
    Edit Item Quantity And History:
    	<table class="popHist">
			<tr>
				<td>QTY</td><td>H1</td><td>H2</td><td>H3</td><td>H4</td><td>H5</td><td>H6</td><td>H7</td><td>H8</td>
			</tr> 
			<tr>
				<td><input type="text" id="hq" name="hq"></td>
				<td><input type="text" id="h1" name="h[0]"></td>
				<td><input type="text" id="h2" name="h[1]"></td>
				<td><input type="text" id="h3" name="h[2]"></td>
				<td><input type="text" id="h4" name="h[3]"></td>
				<td><input type="text" id="h5" name="h[4]"></td>
				<td><input type="text" id="h6" name="h[5]"></td>
				<td><input type="text" id="h7" name="h[6]"></td>
				<td><input type="text" id="h8" name="h[7]"></td>
			</tr>   	
    	</table> 
    	<input type="hidden" id="hist" name="hist_ID" value="">
    	<input type="hidden" id="vend" name="vendor_ID" value="<?= $vendor_ID ?>">
    	<input type="submit" value="Update History/On Hand Quantity">
    	</form>
    </div>
    
	<!--===============================Enter Item Details pop up===================================-->
	<div id="pop2" class="popup" >  
	<form enctype="multipart/form-data" action="processDetailsUpload.php" method="post">
		<table>
			<tr>
				<td>
					<span id="recspan2"></span>
					<input id="record2" type="hidden" name="item_ID" value="" />
					<input type="hidden" name="vendor_ID" value="<?= $vendor_ID ?>" />
				</td>
			</tr>
			<tr>
				<td>Details</td><td><textarea id="theDet" name="details" rows="4" cols="50"></textarea></td>
			</tr>
			<tr><td align="center" colspan="2"><input type="submit" name="submit" value="Submit" /></td></tr>
		</table>
	</form>
	</div>	
	
	<!--=================================Departments Pop Up=====================================-->
	<div id="departments">
	<table>
	<tr><td>Department Name</td></tr>
	<?php for($i=0; $i<$depCount; $i++){ ?>
	    <tr  onclick="putCat('<?= $depts[$i]['dept_ID'] ?>')">
	        <td>
	            <?= $depts[$i]['dept_name'] ?>
	        </td>
	    </tr>
	<?php } ?>
	</table>
	</div>	
	<script defer="defer" type="text/javascript" src="js/inventoryItems.js"></script>
</body>
</html>