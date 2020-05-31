<?php
//enterMobileCount.php 2018/07
// enter a vendor count worksheet
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
  	
$vendor_ID = $_REQUEST['vendor_ID'];
if(!$vendor_ID) $vendor_ID = 516;

@$place = $_REQUEST['place'];
if(!$place) $place = 0;

$today = date("F d, Y");
$totalOrder = 0;

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
if($place == $itemcount) $place = 0;
if($place < 0 ) $place = ($itemcount - 1);

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/enterMobileCount.css" />
<title>Mobile Count</title>
</head>
<body>
    <div class="container">
    	<h3><b><?= $vendor['vendor_name'] ?></b> ---- Item: <b><?= $place+1 ?> of <?= $itemcount ?></b></h3><br>
    	<a href="allpics.php?vendor_ID=<?= $vendor_ID ?>"><img src="<?= resolve($items[$place]['item_pic']) ?>" alt="<?= $items[$place]['item_desc'] ?>"></a><br>
    	<h2>SKU &#35;:<b> <?= $items[$place]['item_sku'] ?></b></h2>
    	<h3><?= $items[$place]['item_desc'] ?></h3>
    	<h1>Retail: <?= $items[$place]['item_retail'] ?> - CAT:<b> <?= $items[$place]['dept_belongs_to'] ?></b> - Pack:<b> <?= $items[$place]['item_pack'] ?></b></h1>
    	<form action="processEnterMobileCount.php" method="post">
    		<div class="savebtn">
            <table>
    			<tr>
    				<td class="orange"><b>LOH</b></td>
    				<td class="blue"><b>Floor</b></td>
    				<td class="yellow"><b>Stock</b></td>
    				<td class="orange">Flag</td>
    			</tr>

    			<tr>
                    <td class="text2">
                        <?= $items[$place]['item_qty'] ?>
                    </td>
    				<td>
    					<input class="text" type="number" name="tempFL" value="<?= $items[$place]['item_tempFL']?>">
    				</td>
    				<td>
    					<input class="text" type="number" name="tempBS" value="<?= $items[$place]['item_tempBS']?>">
    				</td>
    				<td><button class="btn5"><i class="fa fa-flag"></i>&nbsp;<i class="fa fa-arrow-right"></i></button></td>
    			</tr>

    		</table>
            </div>
    		<input type="hidden" name="place" value="<?= $place ?>">
    		<input type="hidden" name="vendor_ID" value="<?= $vendor_ID ?>">
    		<input type="hidden" name="item_ID" value="<?= $items[$place]['item_ID'] ?>">
            <br>
            <button class="btn" type="submit" value="Save"><i class="fa fa-save"></i> SAVE <i class="fa fa-long-arrow-right"></i></button>

        </form>
        <br>
    	<button class="btn2" onclick="parent.location='enterMobileCount.php?vendor_ID=<?= $vendor_ID ?>&place=<?= ($place-1) ?>'"><i class="fa fa-long-arrow-left"></i> Back</button>
        <br>
        <button class="btn3" onclick="parent.location='enterMobileCount.php?vendor_ID=<?= $vendor_ID ?>&place=<?= ($place+1) ?>'">Skip <i class="fa fa-long-arrow-right"></i></button>
        <br>
        <a class="btn4" href="../items.php?vendor_ID=<?= $vendor_ID ?>"><i class="fa fa-reply"></i> Back to Vendor Page</a>

    </div>

        <br><br><br><br><br><br>

</body>
</html>