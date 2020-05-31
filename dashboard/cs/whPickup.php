<?php
//whPickup.php 2018/01
// initiates a pickup request
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$today = date('Y-m-d');
$day = date('D');

$username=$_SESSION['username'];
$ci_ID = $_REQUEST['ci_ID'];
$del=$_REQUEST['del'];
$page = $_REQUEST['page'] ? $_REQUEST['page'] : 0;
$offset = $page * 25;

if($ci_ID) {
	// ========================= load pickup item info =========================
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT a.`ci_id`, a.`ci_sku`, a.`ci_desc`, a.`cust_ID`, 
			         b.`cust_name`, 
			         c.`vendor_name` 
			  FROM `cust_items` a
			  LEFT JOIN `customers` b
			  		 USING (`cust_ID`)
	        Left JOIN `vendors` c
	        		 USING (`vendor_ID`)
	        WHERE a.`ci_ID` = '.$ci_ID;
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Database Error!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db); 
	$item=mysqli_fetch_assoc($result);
}else {
	$item['cust_name'] = $_REQUEST['cust'];	
	$item['vendor_name'] = $_REQUEST['comp'];
	$item['ci_sku'] = $_REQUEST['sku'];
	$item['ci_desc'] = $_REQUEST['desc'];
}

// ========================= load pickup history =========================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM pickups';
$result = mysqli_query($db, $sql);
$pct=mysqli_num_rows($result);

$sql = 'SELECT * FROM pickups ORDER BY `pu_id` DESC LIMIT '.$offset.', 25' ;
$result = mysqli_query($db, $sql);
$puCount=mysqli_num_rows($result);
mysqli_close($db);
for($i=0; $i<$puCount; $i++){
	$pickups[$i]=mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="300">
	<title>Homeport Warehouse Pickup</title>
	<link href="css/whPickup.css" rel="stylesheet" type="text/css" />
</head>

<body style="text-align: center">
<span style="font-family: Arial; font-size: 24px; font-weight: bold; ">Homeport Website Dashboard</span>
<!-- ============================= New Pickup Request ============================= -->
<form id="sms" name="sms" method="post" action="processWhPickup.php">
<table bgcolor="#FFFFCC" align="center" width="600" border="1">
	<tr>
		<td align="right" valign="top">Send To:</td>
		<td align="left">
    		<select name="who" id="carrier">
    			<!-- <option value="dawson">Dawson</option> -->
    			<!-- <option value="derek">Derek</option> -->
    			<!-- <option value="theo">Theo</option> -->
    				<option value="garett">Garett</option>
    				<option value="taylor">Taylor</option>
      			<option value="mark">Mark</option>
      			<option value="francois">François</option>
	   			<option value="frank">Frank</option>
    		</select>
    	</td>
		<td align="center"><input type="submit" name="Submit" value="Send Message" /></td>
		<td>
			<input type="button" onClick="history.go(-2)" value="Return" />
			<input type="button" onclick="parent.location='../dashboard.php'" value="Exit" />	
		</td>
	</tr>
	<tr>
		<td align="right">What:</td>
		<td colspan="3">
			PU@WH <input type="radio" name="what" value="PU@WH" checked="checked" />|
         PU@STORE<input type="radio" name="what" value="PU@STORE" />|
         OTHER<input type="radio" name="what" value="OTHER" />
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">When:</td>
		<td title="Time" align="center"><span style="font-size: 9px; color: #A8A8A8">00:00</span><br /><input name="time" size="10" value=""></td>
		<td title="Date" align="center"><span style="font-size: 9px; color: #A8A8A8">yyyy-mm-dd</span><br /><input name="date" size="10" value="<?= $today ?>"></td>
		<td title="Day" align="center"><span style="font-size: 9px; color: #A8A8A8">Sat Sun Mon Tue Wed Thu Fri</span><br /><input name="day" size="10" value="<?= $day ?>"></td>
	</tr>
	<tr>
		<td align="right" valign="top">Customer Name:</td>
		<td colspan="3" align="left"><input title="<?= $username ?>" name="customer" size="45" id="customer" value="<?= $item['cust_name'] ?>"></td>
	</tr>
	<tr>
		<td align="right" valign="top">Company</td>
		<td colspan="3" align="left"><input name="company" size="45" id="company" value="<?= $item['vendor_name'] ?>"></td>
	</tr>
	<tr>
		<td align="right" valign="top">Sku</td>
		<td colspan="3" align="left"><input name="sku" size="45" id="sku" value="<?= $item['ci_sku'] ?>"></td>
	</tr>
	<tr>
    <td align="right" valign="top">Description</td>
    <td colspan="3" align="left"><input name="description" size="45" id="description" value="<?= $item['ci_desc'] ?>"></td>
  </tr>
  <tr>
		<td align="right" valign="top">Message:</td>
		<td colspan="3" align="left">
			<input name="message" size="45" id="message" />
			<input type="hidden" name="user" value="<?=$username ?>" />
		</td>
	</tr>
</table>

<!-- ============================= old Pickup Requests ============================= -->
<br />
 <center>
 	<?php if($page > 0) { ?><a href="whPickup.php?page=<?= $page-1 ?>"> prev </a> <?php } ?>
 	<b>Message Lo<a style="text-decoration: none" href="whPickup.php?del=1">g</a></b>
   <?php if(($page * 25)+25 < $pct) { ?><a href="whPickup.php?page=<?= $page+1 ?>"> next </a> <?php } ?>
 </center>
 <table align="center" border="1">
   <tr style=" font-size: 10px; font-family: Arial; font-weight: bold">
    <td></td><td>When</td><td>Who</td><td>What</td><td>Customer</td><td>Company</td><td>Sku</td><td>Description</td><td>Message</td><td>Sent By</td>
  </tr>
 <?php for($i=0; $i<$puCount; $i++){
       $backcolor='';
       $conbut = '';
       if($pickups[$i]['pu_confirmed'] == 1){
          $backcolor='bgcolor="#33FF00"';
       }else {
          $conbut = 'Yes';
       }
 ?>
  <tr <?= $backcolor ?> style="font-size: 10px; font-family: Arial">
<?php if($conbut == "Yes"){ ?>
    <td><input style="font-size: 8px" type="button" value="Confirm" onclick="parent.location='confirmPickup.php?pu_ID=<?= $pickups[$i]['pu_ID'] ?>'" /></td>
<?php }else{ ?>
          <td></td>
<?php } ?>
    <td><?= $pickups[$i]['pu_when'] ?></td>
    <td><?= $pickups[$i]['pu_employee'] ?></td>
    <td><?= $pickups[$i]['pu_location'] ?></td>
    <td><?= $pickups[$i]['pu_cust_name'] ?></td>
    <td><?= $pickups[$i]['pu_vendor_name'] ?></td>
    <td><?= $pickups[$i]['pu_sku'] ?></td>
    <td><?= $pickups[$i]['pu_desc'] ?></td>
    <td title="<?= $pickups[$i]['pu_message'] ?>"><?= substr($pickups[$i]['pu_message'],0,20) ?></td>
    <td><?= $pickups[$i]['pu_requestedBy'] ?></td>
<?php if($del == 1){ ?>
    <td><input type="button" value="Delete" onclick="parent.location='processDeletePickup.php?pu_ID=<?= $pickups[$i]['pu_ID'] ?>'" /></td>
<?php } ?>
  </tr>
  <?php } ?>
 </table>
</form>
</body>
</html>