<?php
//addInventory.php 2018/02
// search the warehouse inventory
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
	header('Location: index.php');
	die;
}

//Establish Variables
$wi_ID=$_REQUEST['wi_ID'];
$addedQty = $_REQUEST['qty'];
$sku = $_POST['sku'];
$now = date('l jS \of F Y h:i:s A');

// ============================= If an item has been added =============================
if($wi_ID) {
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "SELECT * FROM `whseInv` WHERE `wi_ID`=".$wi_ID;
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Find Added Item Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	$invItem = mysqli_fetch_assoc($result);
	mysqli_close($db);
}

// =========================== If an item has been looked up ===========================
if($sku) {
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "SELECT a.`item_sku`, a.`item_retail`, a.`item_desc`, a.`item_pic`,
			  b.`vendor_name`
			  FROM `items` a 
			  LEFT JOIN `vendors` b 
			       USING (`vendor_ID`)
			  WHERE a.`item_sku` LIKE '".$sku."'";
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Find Sku Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	$find = mysqli_fetch_assoc($result);
	mysqli_close($db); 
}

//Load categories Into Array
$fp = fopen('data/categories.txt', "r");
// get the categories records and store them in the cats array
$i=0;
while (!feof($fp)) {
    $item= fgets($fp);
    $cats[$i] =trim($item);
    $i++;
    }
fclose($fp); 
sort($cats);
$catCount=count($cats);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Items</title>
	<link href="css/addInventory.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br /><br />
<div class="title">Add Items to Warehouse Inventory</div>
<hr>
<form action="addInventory.php" method="post">
	<input type="text" name="sku"><input name="button" type="submit" value="Find Sku" />
</form>
<hr>
<form id="addInv" action="processAddInventory.php" method="POST">
<table>
  <tr><td>Qty</td><td>Vendor</td><td>Sku</td><td>Price</td><td>Description</td><td>Location</td><td>Picture</td><td>Category</td></tr>
  <tr>
    <td><input class="data" id="qty" value="" name="qty"/></td>
    <td><input class="data" id="vendor" value="<?= $find['vendor_name'] ?>" name="vendor"/></td>
    <td><input class="data" id="sku" value="<?= $find['item_sku'] ?>" name="sku"</td>
    <td><input class="data" id="price" value="<?= number_format($find['item_retail'],2) ?>" name="price"/></td>
    <td><input class="data" id="desc" value="<?= $find['item_desc'] ?>" name="desc"</td>
    <td><input class="data" id="location" value="" name="location"/></td>
    <td><input class="data" id="pic" value="<?= $find['item_pic'] ?>" name="pic"/></td>
    <td><select name="dept" size="1">
    <?php for($i=0; $i<$catCount; $i++){
        $selected='';
        if(trim($cats[$i])==trim($x_category)) $selected='selected="selected"';
    ?>

    <option <?=$selected?> value="<?=$cats[$i]?>"><?=$cats[$i]?></option>

    <?php } ?>
    </select></td>
	</tr>
	<tr><td colspan="8"><hr></td></tr>
	<tr>
		<td colspan="8">
			<input type="button" onclick="processForm();" value="Add Items" />
			<input value="Return To Menu" onclick="parent.location='whDash.php'" type="button">
			<input value="Exit" onclick="parent.location='../'" type="button">
		</td>
	</tr>
</table>
</form>
<br /><br />
<?php
if($wi_ID){ ?>
    <table class="result">
      <tr><td>How Many</td><td>Vendor</td><td>Picture</td><td>Sku</td><td>Price</td><td>Description</td><td>Location</td><td>Department</td></tr>
      <tr>
        <td><?= $addedQty ?></td>
        <td><img height="150" border="0" src="<?=resolve($invItem['wi_pic'])?>" alt="No Picture"></td>
        <td><?= $invItem['vendor'] ?></div></td>
        <td><?= $invItem['wi_sku']?></div></td>
        <td><?= $invItem['wi_price']?></div></td>
        <td><?= $invItem['wi_desc']?></div></td>
		  <td><?= $invItem['wi_location']?></div></td>
		  <td><?= $invItem['wi_dept']?></div></td>
      </tr>
    </table>
<?php    } ?>
	<script defer="defer" type="text/javascript" src="js/addInventory.js"></script>
</body>

</html>