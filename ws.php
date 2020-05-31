<?php
// ws.php 2018/01
// Search Items Database By: sku, description or vendor name
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";
$imageLocation = "http://www.rockingbones.site/homeportonline/";

date_default_timezone_set('America/New_York');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

//Grab The User's Search tearm
$searchKey = $_POST['searchKey'];
$sType = $_POST['sType'];
if(!$sType) $sType = "Search Description";

echo $sType;
//if no search term was entered skip it
if($searchKey){
	if($sType == "Search Vendor") {
		$condition = "`vendor_name` LIKE '%".$searchKey."%'";
	}
	
	if($sType == "Search SKU") {
		$condition = "`item_sku` LIKE '%".$searchKey."%'";
	}
	if($sType == "Search Description") {
		$keys = explode(" ", $searchKey);
		$condition = "";
		foreach($keys as $word){
			$condition .= " `item_desc` LIKE '%".$word."%' AND ";
		}
		$condition = substr($condition, 0, -4);         // gets rid of the last  %' OR
	}
    //search Item Database And Store It In A Local Array
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);

    $sql = "SELECT *
            FROM `items` 
            LEFT JOIN `items_hist` USING (`item_ID`) 
            LEFT JOIN `vendors` USING (`vendor_ID`)
            LEFT JOIN `departments` USING (`dept_ID`)
            WHERE " . $condition." 
            ORDER BY `vendor_name`, `item_desc`";
    $result = mysqli_query($db, $sql);
	// report error
	if(!$result){
		echo "Search No Good!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}else{
        $itemcount = mysqli_num_rows($result);
        for($i = 0; $i < $itemcount; $i++){
            $items[$i] = mysqli_fetch_assoc($result);
        }
    }
    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>

<head>

<link rel="shortcut icon" href="images/search.png" type="image/png">

<link rel="apple-touch-icon image_src" href="images/search.png">

  <link rel="stylesheet" type="text/css" href="css/ws.css" />
  <title>Search Results</title>
<script type="text/javascript">
function setFocus()
{
     document.getElementById("search").focus();
}
</script>
</head>

<body onload="setFocus()">
<!-- ------------------------ Search Form ------------------------ -->
<form action="ws.php" method="POST">
<table>
  <tr><td align="center">Enter Search Term</td></tr>
  <tr><td align="center"><input id="search" name="searchKey" value="<?= $searchKey ?>" /></td></tr>
  <tr><td align="center">
  			<input type="submit" name="sType" value="Search Description" /> 
  			<input type="submit" name="sType" value="Search Vendor" />
  			<input type="submit" name="sType" value="Search SKU" /> 			
  </td></tr>
</table>
</form>

<!-- ---------------------- Search Results ----------------------- -->
<?php if($itemcount==0){ ?>
<h1 align="center">No Results For This Search: <?= $searchKey ?></h1>
<?php }else{ ?>
<h3 align="center"><?= $itemcount ?> Results For This Search: <?= $searchKey ?></h3>
<table class="resultstable">
	<tr><td>Pic</td><td>Vendor</td><td>Sku</td><td>Description</td><td>Cat</td><td>Price</td><td>Last On Hand</td></tr>
    <?php for($i = 0; $i < $itemcount; $i++){ ?>
    <tr>
        <td>
            <?php if($items[$i]['item_pic']){ ?>
            <a class="thumbnail" href="#thumb">
            <img border="0" src="<?= resolve($items[$i]['item_pic']) ?>" height="25" />
            <span><img src="<?= resolve($items[$i]['item_pic']) ?>"/></span>
            </a>
            <?php } ?>
        </td>
        <td title="<?= $items[$i]['vendor_ID'] ?>"><?= $items[$i]['vendor_name'] ?></td>
        <td title="<?= $items[$i]['weight'] ?>"><?= $items[$i]['item_sku'] ?></td>
        <td title="<?= $items[$i]['item_ID'] ?>"><?= stripslashes($items[$i]['item_desc']) ?></td>
        <td title="<?= $items[$i]['item_pack'] ?>"><?= $items[$i]['dept_belongs_to'] ?></td>
        <td class="boldit" title="<?= $items[$i]['item_cost'] ?>"><?= $items[$i]['item_retail'] ?></td>
        <td title="<?= $items[$i]['ldat'] ?>" style="text-align: center;"><?= $items[$i]['item_qty'] ?></td>
    </tr>
    <?php }?>
</table>
<?php } ?>
</body>
</html>