<?php
//vendorSelect.php 2018/01
// Chooses which vendor's items to look at
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

@$direction=$_REQUEST['direction'];

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `vendor_ID`, `vendor_name`, `vendor_group` 
		  FROM `vendors` 
		  ORDER BY `vendor_name`' ;
$result = mysqli_query($db, $sql);
if($result) {
	$num_results=mysqli_num_rows($result);
}
mysqli_close($db);


for($i=0; $i<$num_results; $i++){
    $vendors[$i] = mysqli_fetch_assoc($result);
}

$vencount = count($vendors);

// indicates which program to run
$dir="items";
if($direction=="Edit") $dir="vendors/editVendor";
if($direction=="Enter") $dir="enterCount";
if($direction=="Add Details") $dir="details";
if($direction=="Count") $dir="printCount";
if($direction=="Order") $dir="offCycle";

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Vendor Select</title>
<link rel="stylesheet" type="text/css" href="../css/vendorSelect.css" />
</head>
<body>
	Select A Vendor to <?= $direction ?>:
	<form action="<?= $dir ?>.php" method="post">
	<select name="vendor_ID">
		<?php for($i = 0; $i < $vencount; $i++) {
					unset($selected);
					if($i == 0) $selected = "selected=\"selected\"";
		?>
		<option  <?= @$selected ?> onclick="parent.location='<?= $dir ?>.php?vendor_ID=<?= $vendors[$i]['vendor_ID'] ?>'" value="<?= $vendors[$i]['vendor_ID'] ?>"><?= $vendors[$i]['vendor_name'] ?></option>
		<?php } ?>
	</select>	
	<input type="submit" value="Select">
	</form>
	<br>
	<hr>
	<table>
		<tr><td>Vendor ID</td><td>Vendor Name</td><td>Count Group</td></tr>
		<?php for($i=0; $i<$num_results; $i++){ ?>
		<tr>
			<td><a href="vendors/editVendor.php?vendor_ID=<?= $vendors[$i]['vendor_ID'] ?>"><?= $vendors[$i]['vendor_ID'] ?></a></td>	
			<td><a href="items.php?vendor_ID=<?= $vendors[$i]['vendor_ID'] ?>"><?= $vendors[$i]['vendor_name'] ?></a></td>	
			<td><?= $vendors[$i]['vendor_group'] ?></td>		
		</tr>
		<?php } ?>	
	</table>
	<hr>
</body>
</html>