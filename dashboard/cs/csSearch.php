<?php
//csMenu.php 2018/01
// Display the customer service menu
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
@$key = strtolower($_POST['key']);

if($key) {
	// Load customer items into array
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT a.`ci_id`, a.`ci_sku`, a.`ci_desc`, a.`order_ID`, a.`ci_location`, a.`ci_datecontacted`, a.`ci_datepickedup`, 
				b.`cust_name`, b.`cust_ID`, 
				c.`vendor_name` 
			FROM `customers` b 
			LEFT JOIN `cust_items` a USING (`cust_ID`)
	        LEFT JOIN `vendors` c
USING (`vendor_ID`)
	        ORDER BY a.`ci_ID` DESC';
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Database Error!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
	$itemcount=mysqli_num_rows($result);
	mysqli_close($db); 
	
	for($i = 0;$i < $itemcount; $i++) {
		$items[$i]=mysqli_fetch_assoc($result);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Search Customer Service</title>
	<link href="css/csSearch.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<form action="csSearch.php" method="post">
			Customer Service Search: <input type="text" name="key">
			<input type="submit" value="Search">
			<input value="Exit" onclick="parent.location='csMenu.php'" type="button">
	</form>
<hr size="12" noshade="noshade" width="1200"/>
<!-- ========================== Legend ========================== -->
<table>
    <tr >
        <td bgcolor="#FFFF99">&nbsp;&nbsp;&nbsp;Recently Added&nbsp;&nbsp;&nbsp;</td>
        <td bgcolor="#FFCCFF">&nbsp;&nbsp;&nbsp;Placed On Order&nbsp;&nbsp;&nbsp;</td>
        <td bgcolor="#99FF99">&nbsp;&nbsp;&nbsp;Placed On Hold&nbsp;&nbsp;&nbsp;</td>
        <td bgcolor="#33CCCC">&nbsp;&nbsp;&nbsp;Customer Contacted&nbsp;&nbsp;&nbsp;</td>
        <td bgcolor="#CC9933">&nbsp;&nbsp;&nbsp;Picked Up&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>

<hr size="12" noshade="noshade" width="1200"/>	
	
	<table>
	<?php if($key) { ?>
			<tr><td>Customer Name</td><td>Sku</td><td>Item Description</td><td>Vendor</td></tr>	

	<?php for($i = 0;$i < $itemcount; $i++) { 
			// determine the background color based on status
			$bgcolor = "#FFFF99";
			if($items[$i]['order_ID']) $bgcolor = "#FFCCFF";
			if($items[$i]['ci_location']) $bgcolor = "#99FF99";
			if($items[$i]['ci_datecontacted']) $bgcolor = "#33CCCC";
			if($items[$i]['ci_datepickedup']) $bgcolor = "#CC9933";
			$a = strpos(strtolower("x".$items[$i]['cust_name']), $key);
			$b = strpos(strtolower("x".$items[$i]['ci_sku']),$key);
			$c = strpos(strtolower("x".$items[$i]['ci_desc']), $key);
			$d = strpos(strtolower("x".$items[$i]['vendor_name']), $key);
			if( $a || $b || $c || $d) { ?>
		<tr bgcolor="<?= $bgcolor ?>" class="link" onclick="parent.location='csEdit.php?cust_ID=<?= $items[$i]['cust_ID'] ?>'">
			<td><?= $items[$i]['cust_name'] ?></td><td><?= $items[$i]['ci_sku'] ?></td><td><?= $items[$i]['ci_desc'] ?></td><td><?= $items[$i]['vendor_name'] ?></td>
		</tr>
	<?php } } }?>
	</table>	
</body>
</html>