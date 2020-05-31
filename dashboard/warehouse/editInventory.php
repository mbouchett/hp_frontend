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
$catSelected = $_REQUEST['catSelected'];

if(!$searchKey) $searchKey = @$_REQUEST['referSearch'];

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
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title> Edit Inventory(<?= $invCount ?>)</title>
   <link href="css/editInventory.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- header bar -->
<div class="title">Edit Warehouse Inventory</div>

<!-- ==================================== Category List ==================================== -->
<table align="center" cellspacing="4">
  <tr>
    <?php for($i=0; $i<$catCount; $i++){
      if(trim($catSelected)==trim($cats[$i])){
        $bgc='#00FF00'; // Active
      }else{
        $bgc='#FFD700'; // Not Active
      } ?>
    <td align="center" width="90" bgcolor="<?=$bgc?>"><a href="editInventory.php?catSelected=<?=$cats[$i]?>"  ><?=$cats[$i]?></a></td>
    <?php } ?>
  </tr>
</table>

<!-- ====================================== Search Bar ====================================== -->
<table align="center" cellspacing="4">
  <tr>
    <td>
     <form action="editInventory.php" method="post">
      <input id="searchKey" name="searchKey" /><input type="submit" name="" value="Search" />
     </form>
    </td>
  </tr>
</table>
<?php if($invCount > 0) { ?>

<!-- =================================== Items List  Header =================================== -->
<form action="processEditInventory.php" method="post" >
<table>
<tr><td align="center" colspan="11"><input name="" type="submit" value="Save Any Changes" /> <input value="Exit" onclick="parent.location='../'" type="button"></td></tr>
    <tr><td>Picture</td>
        <td><a href="editInventory.php?catSelected=<?=$catSelected?>&order=vendor&referSearch=<?=$searchKey?>">Vendor</a></td>
        <td><a href="editInventory.php?catSelected=<?=$catSelected?>&order=sku&referSearch=<?=$searchKey?>">Sku</a></td></td>
        <td>Price</td>
        <td><a href="editInventory.php?catSelected=<?=$catSelected?>&order=description&referSearch=<?=$searchKey?>">Description</a></td></td>
        <td>Location</td><td>Purchased</td><td>Customer</td><td>Emp</td><td>Comment</td><td>Category</td><td>Del</td></tr>
        
<!-- ====================================== Items List ====================================== -->
    <?php
      for($i = 0; $i < $invCount; $i++){
    ?>
    <tr>
      <td><input class="pic" type="text" name="wi_pic[<?=$i?>]" value="<?=$inv[$i]['wi_pic']?>" /></td>
      <td><input class="vendor" type="text" name="wi_vendor[<?=$i?>]" value="<?=$inv[$i]['vendor']?>" /></td>
      <td title="<?=$inv[$i]['wi_dept']?>"><input class="sku" type="text" name="wi_sku[<?=$i?>]" value="<?=$inv[$i]['wi_sku']?>" /></td>
      <td><input class="price" type="text" name="wi_price[<?=$i?>]" value="<?=$inv[$i]['wi_price']?>" /></td>
      <td><input class="desc" type="text" name="wi_desc[<?=$i?>]" value="<?=$inv[$i]['wi_desc']?>" /></td>
      <td><input class="location" type="text" name="wi_location[<?=$i?>]" value="<?=$inv[$i]['wi_location']?>" /></td>
      <td><input class="dp" name="wi_purchased[<?=$i?>]" type="text" size="15" value="<?=$inv[$i]['wi_purchased']?>" /></td>
      <td><input class="pb" name="wi_cust[<?=$i?>]" type="text" size="15" value="<?=$inv[$i]['wi_cust']?>" /></td>
      <td><input class="emp" name="wi_employee[<?=$i?>]" type="text" size="15" value="<?=$inv[$i]['wi_employee']?>" /></td>
      <td><input class="comment" name="wi_comment[<?=$i?>]" type="text" size="25" value="<?=$inv[$i]['wi_comment']?>" /></td>
    	<td><select name="wi_dept[<?=$i?>]" size="1">
    	<?php for($ii=0; $ii<$catCount; $ii++){
        			$selected='';
					if(trim($cats[$ii])==trim($inv[$i]['wi_dept'])){ $selected='selected="selected"';}
		?>
				<option <?=$selected?> value="<?=$cats[$ii]?>"><?=$cats[$ii]?></option>
		<?php } ?>
			</select></td>      
      <td><input type="checkbox" name="del[<?= $i ?>]"></td>
    </tr>
    <input type="hidden" name="wi_ID[<?=$i?>]" value="<?=stripslashes($inv[$i]['wi_dept'])?>" />
    <input type="hidden" name="wi_ID[<?=$i?>]" value="<?=stripslashes($inv[$i]['wi_ID'])?>" />
    <?php }

if($message)
    echo '<tr><td align="center" colspan="11"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
    <tr><td align="center" colspan="11"><input name="" type="submit" value="Save Any Changes" /> <input value="Exit" onclick="parent.location='../'" type="button"></td></tr>
</table>
<input type="hidden" name="catSelected" value="<?=$catSelected?>" />
<input type="hidden" name="searchKey" value="<?=$searchKey?>" />
</form>
<?php }else { ?>
<div id="exit"><input value="Exit" onclick="parent.location='../'" type="button"></div>
<?php } ?>
</body>

</html>