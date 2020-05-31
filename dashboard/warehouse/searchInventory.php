<?php
//searchInventory.php 2018/02
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
@$message=$_REQUEST['message'];
@$searchKey=$_POST['searchKey'];
@$catSelected = $_REQUEST['catSelected'];

if(!$searchKey) @$searchKey = @$_REQUEST['referSearch'];

//Load categories Into Array
$fp = fopen('data/categories.txt', "r");
// get the categories records and store them in the cats array
$i=0;
while (!feof($fp)) {
    $item= fgets($fp);
    $cats[$i] =$item;
    $i++;
}
fclose($fp);//close the categories file
sort($cats);//Sort the records on category name
$catCount=count($cats);//How many categories in the list

//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
if($searchKey) {
	$sql = 'SELECT * 
			  FROM `whseInv` 
			  WHERE `wi_desc` LIKE"%'.$searchKey.'%" OR `vendor` LIKE"%'.$searchKey.'%" OR `wi_sku` LIKE"%'.$searchKey.'%" 
			  ORDER BY `vendor`, `wi_sku`';
}elseif($catSelected) {
	$sql = 'SELECT * 
			  FROM `whseInv` 
			  WHERE `wi_dept` LIKE"%'.$catSelected.'%" 
			  ORDER BY `vendor`, `wi_sku`';		
}
if($sql){
	$result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Load warehouse Inventory Failed<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	$invCount = mysqli_num_rows($result);
	mysqli_close($db);
	for($i=0; $i<$invCount; $i++){
		$inv[$i]=mysqli_fetch_assoc($result);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8_unicode_ci">
	<title> View Inventory(<?= $invCount ?>)</title>
	<link href="css/searchInventory.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		function setFocus() { document.getElementById("searchKey").focus(); }
	</script>
</head>

<body onload="setFocus()">
<!-- header bar -->
<div class="title">Warehouse Inventory</div>
<table align="center" cellspacing="4">
  <tr>
    <?php for($i=0; $i<$catCount; $i++){
      if(trim($catSelected)==trim($cats[$i])){
        $bgc='#00FF00'; // Active
      }else{
        $bgc='#FFD700'; // Not Active
      } ?>
    <td align="center" width="90" bgcolor="<?=$bgc?>"><a href="searchInventory.php?catSelected=<?=$cats[$i]?>"  ><?=$cats[$i]?></a></td>
    <?php } ?>
  </tr>
</table>

<table align="center" cellspacing="4">
  <tr>
    <td>
     <form action="searchInventory.php" method="post">
      <input id="searchKey" name="searchKey" /><input type="submit" name="" value="Search" />
     </form>
    </td>
  </tr>
</table>
<?php if($invCount > 0) { ?>
<form action="processSearchInventory.php" method="post" >
<table align="center" border="4" bordercolor="#B8860B">
<tr><td align="center" colspan="11"><input name="" type="submit" value="Save Any Changes" /> <input value="Exit" onclick="parent.location='../'" type="button"></td></tr>
    <tr><td>Picture</td>
        <td><a href="searchInventory.php?catSelected=<?=$catSelected?>&order=vendor&referSearch=<?=$searchKey?>">Vendor</a></td>
        <td><a href="searchInventory.php?catSelected=<?=$catSelected?>&order=sku&referSearch=<?=$searchKey?>">Sku</a></td></td>
        <td>Price</td>
        <td><a href="searchInventory.php?catSelected=<?=$catSelected?>&order=description&referSearch=<?=$searchKey?>">Description</a></td></td>
        <td>Location</td><td>Date Purchased</td><td>Purchased By</td><td>Employee</td><td>Comment</td><td>PU</td></tr>
    <?php
      for($i = 0; $i < $invCount; $i++){
        $rowcolor="#FFFFFF";
        if(substr($inv[$i]['wi_comment'],0,6) == "Verify") $rowcolor="#FFFF66";
        if($inv[$i]['wi_purchased'] || $inv[$i]['wi_employee'] || $inv[$i]['wi_cust']) $rowcolor="#FFCCFF";
    ?>
    <tr bgcolor="<?= $rowcolor ?>">
      <td>
            <?php if($inv[$i]['wi_pic']) { ?>
            <a class="thumbnail" href="#thumb">
            <img style="max-height: 25px; max-width: 100px" border="0" src="<?= resolve($inv[$i]['wi_pic']) ?>"  />
            <span><img src="<?= resolve($inv[$i]['wi_pic']) ?>"/></span>
            </a>
            <?php } ?>
      </td>
      <td><?=$inv[$i]['vendor']?></td>
      <td title="<?=$inv[$i]['wi_dept']?>"><?=$inv[$i]['wi_sku']?></td>
      <td><?=$inv[$i]['wi_price']?></td>
      <td><?=$inv[$i]['wi_desc']?></td>
      <td><?=$inv[$i]['wi_location']?></td>
      <td><input style="background-color: <?= $rowcolor ?>" name="wi_purchased[<?=$i?>]" type="text" size="15" value="<?=$inv[$i]['wi_purchased']?>" /></td>
      <td><input style="background-color: <?= $rowcolor ?>" name="wi_cust[<?=$i?>]" type="text" size="15" value="<?=$inv[$i]['wi_cust']?>" /></td>
      <td><input style="background-color: <?= $rowcolor ?>" name="wi_employee[<?=$i?>]" type="text" size="15" value="<?=$inv[$i]['wi_employee']?>" /></td>
      <td><input style="background-color: <?= $rowcolor ?>" name="wi_comment[<?=$i?>]" type="text" size="25" value="<?=$inv[$i]['wi_comment']?>" /></td>
      <td class="delButton">
      <?php if($rowcolor=="#FFCCFF"){ ?>
        <input type="button" value="PU"
        onclick="window.open('../cs/whPickup.php?cust=<?= $inv[$i]['wi_cust'] ?>&comp=<?= $inv[$i]['vendor'] ?>&sku=<?= $inv[$i]['wi_sku'] ?>&desc=<?= $inv[$i]['wi_desc'] ?>', 'newwindow')" />
      <?php }else { ?>-<?php } ?>
      </td>
    </tr>
    <input type="hidden" name="wi_ID[<?=$i?>]" value="<?=$inv[$i]['wi_ID']?>" />
    <?php }

if($message)
    echo '<tr><td align="center" colspan="11"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
    <tr><td align="center" colspan="11"><input name="" type="submit" value="Save Any Changes" /> <input value="Exit" onclick="parent.location='../'" type="button"></td></tr>
</table>
<input type="hidden" name="catSelected" value="<?=$catSelected?>" />
<input type="hidden" name="referPage" value="search" />
<input type="hidden" name="searchKey" value="<?=$searchKey?>" />
</form>
<?php }else { ?>
<div id="exit"><input value="Exit" onclick="parent.location='../'" type="button"></div>
<?php } ?>
</body>

</html>