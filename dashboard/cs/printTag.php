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

$today=date('m/d/Y');

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT a.`ci_ID`, a.`ci_sku`, a.`ci_desc`, a.`cust_ID`, a.`ci_qty`, a.`ci_pif`,  
		         b.`cust_name`, b.`cust_phone`,
		         c.`vendor_name` 
		  FROM `cust_items` a
		  LEFT JOIN `customers` b
		  		 USING (`cust_ID`)
        Left JOIN `vendors` c
        		 USING (`vendor_ID`)
        WHERE a.`ci_tagged`=1';
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "Database Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$listCount=mysqli_num_rows($result);
mysqli_close($db);


$tagcount=0;
for($i=0; $i<$listCount; $i++){
	$row=mysqli_fetch_assoc($result);
	for($ii=0; $ii < $row['ci_qty']; $ii++){
		$wantlist[$tagcount] = $row;
		$wantlist[$tagcount]['tag'] = $ii+1;
		$tagcount = $tagcount + 1;
	}
}


//Update Wantlist
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$listCount; $i++){
    $sql = "UPDATE `".$db_db."`.`cust_items` SET `ci_tagged` = 0 WHERE `ci_ID`=".$wantlist[$i]['ci_ID'];
    $result = mysqli_query($db, $sql);
}
 mysqli_close($db);
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search Wantlists</title>
	<STYLE TYPE="text/css">
   	P.breakhere {
   		page-break-before: always
    	}
   	* {
  			background-color: #FFFFFF;
  			margin: 0;
		}
	</STYLE>
</head>
<body>
<?php for($i=0; $i<$tagcount; $i++){
    if($i !=0 && $i/5==intval($i/5)) echo '<P CLASS="breakhere">';
?>
<table border="1" width="800" >
	<tr >
		<td colspan="2">Merchandise On Hold</td>
		<td colspan="3" align="right"><img width="200" src="images/hpSimple.jpg" border="0"  /></td>
	</tr>
	<tr>
		<td ><?= $wantlist[$i]['cust_name'] ?></td>
		<td ><?= $wantlist[$i]['cust_phone'] ?></td>
		<td >
		<?php if($wantlist[$i]['ci_pif']) { ?>
			PIF trans#<?= $wantlist[$i]['ci_pif'] ?>
		<?php }else{ ?>
			*** Payment Pending ***
		<?php } ?>
		</td>
		<td ><?= $today ?></td>
		<td rowspan="4">
			Items<br />
			<input name="" size="2" value="<?= $wantlist[$i]['tag'] ?>" />/<input name="" size="2" value="<?= $wantlist[$i]['qty'] ?>" /><br /><br />
			<input type="checkbox" name="" /> 24 Hour Hold
		</td>
	</tr>
	<tr>
		<td ><?= $wantlist[$i]['vendor_name'] ?></td>
		<td ><?= $wantlist[$i]['ci_sku'] ?></td>
		<td colspan="2" ><?= $wantlist[$i]['ci_desc'] ?></td>
	</tr>
	<tr>
		<td colspan="4" >Special Insturctions: <input name="" size="70" /></td>
	</tr>
	<tr>
		<td colspan="4">Comments: <?= $wantlist[$i]['ci_note'] ?></td>
	</tr>
</table>
<br /><br />
<?php } ?>
<?php
if($listCount < 1) { ?>
<div style="font-family: Arial; font-weight: Bold; font-size: 24px" align="center">No Pending Tags Found</div>
<?php } ?>
</body>

</html>
