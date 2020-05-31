<?php
//csEdit.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$cust_ID = $_REQUEST['cust_ID'];

//Get Customer Data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `customers` WHERE `cust_ID` = '.$cust_ID;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Customer Database Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$cust=mysqli_fetch_assoc($result);

// load customer items into array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `cust_items` 
		  WHERE `cust_items`.`cust_ID` = '.$cust['cust_ID'];
$result = mysqli_query($db, $sql);
if(!$result){
	echo "cust_item Database Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$itemcount=mysqli_num_rows($result);
mysqli_close($db); 
//Store the Results To A Local Array
for($i=0; $i<$itemcount; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>New Paid In Full</title>
</head>

<body>
<br />
<table align="center" width="400" border="0" cellpadding="8">
    <tr>
    	<td colspan="2" title="Click Here to Return">
    		<img onclick="parent.location='csEdit.php?cust_ID=<?= $cust_ID ?>'" height="30" border="0" src="images/hpSimple.jpg" />
    	</td><td align="right" colspan="2"></td>
    </tr>
	<tr>
		<td colspan="4" align="center">
        	<hr />
        	Homeport Ltd.<br />
        	52 Church Street<br />
            Burlington, VT 05401<br />
            (802) 863-4644
        </td>
	</tr>
	
	<tr bgcolor="#CCCCCC">
        <td width="100">Sold By:</td><td width="75"><input name="a[0]" size="12" type="text" value="<?= $cust['cust_employee'] ?>" /></td>
        <td width="110">Cashier</td><td><input name="a[1]" size="8" type="text" value="<?= $_SESSION['username'] ?>" /></td>
	</tr>
	<tr bgcolor="#CCCCCC">
        <td>Trans#</td><td><input name="a[2]" size="12" type="text" value="<?=$items[0]['ci_pif']?>" /></td><td>Date Paid:</td><td><input name="a[3]" size="8" type="text" value="<?=date('m/d/Y')?>" /></td>
	</tr>

	<tr>
        <td colspan="4" align="justify"><div style="font-size:12px">In order for us to better serve you, please call one hour before you plan to pick up your merchandise, so that we can have it ready. -Thank You</div></td>
	</tr>
</table>
<table width="400" align="center" boarder="1">
	<tr bgcolor="#000000">
		<td width="15" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px">Category</td>
		<td width="15" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px">Quantity</td>
		<td width="20" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px">SKU</td>
		<td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px">Description</td>
		<td width="65" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px">Price</td>
	</tr>
	<?php for($i=0; $i < $itemcount; $i++) { 
	if(!empty($items[$i]['ci_pif']) && empty($items[$i]['ci_datepickedup']) && $items[$i]['ci_pifFlag']) { ?>
	<tr>
		<td style="font-family:Arial, Helvetica, sans-serif"><?=$items[$i]['dept_ID']?></td>
		<td style="font-family:Arial, Helvetica, sans-serif"><?=$items[$i]['ci_qty']?></td>
		<td style="font-family:Arial, Helvetica, sans-serif"><?=$items[$i]['ci_sku']?></td>
		<td style="font-family:Arial, Helvetica, sans-serif"><?=$items[$i]['ci_desc']?></td>
		<td style="font-family:Arial, Helvetica, sans-serif"><?=$items[$i]['ci_price']?></td>
	</tr>	
	<?php } } ?>
</table>
<table align="center" width="400" border="0" cellpadding="1">
	<tr bgcolor="#CCCCCC">
        <td> Paid By:<br /></td>
        <td><input name="a[4]" size="35" type="text" value="<?=$cust['cust_name']?>" /></td>
    </tr>
	<tr bgcolor="#CCCCCC">
        <td> Phone Number:<br /></td>
        <td><input name="a[4]" size="35" type="text" value="<?=$cust['cust_phone']?>" /></td>
    </tr>
    <tr><td colspan="2" align="center" bgcolor="#000000"><div style="font-family: Arial; font-size: 18px; color: #FFFFFF">Paid In Full</div></td></tr>
</table>

<div align="center">
	<input value="Print This Form" TYPE="button" onClick="window.print()">
</div>
</body>
</html>