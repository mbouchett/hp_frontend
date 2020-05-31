<?php
/* Contact form
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/dashboard/webcust/viewWebCustomers.php
*/

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/_unMash.php";

// ****************** initializes variables *******************
$nameColor = 'ffffff';
$checked = "";

// ************* Get customer Info *************
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `web_cust` ORDER BY `wc_lname`';
$result = mysqli_query($db, $sql);
$custCount = mysqli_num_rows($result);
mysqli_close($db);

for($i=0; $i<$custCount; $i++){
	$cust[$i] = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Homeport Web Customers</title>
</head>
<body>
<table>
	<tr><td>Name</td><td>Email</td><td>Bad</td></tr>
	<?php for($i=0; $i<$custCount; $i++){ 
			$nameColor = 'ffffff';
			$checked = '';
			if($cust[$i]['wc_badActor']) $nameColor = 'ff5555';
			if($cust[$i]['wc_badActor']) $checked = 'checked';
	?>
	<tr>
		<td style="background-color: #<?= $nameColor ?>"><a href="custDetails.php?wc_ID=<?= $cust[$i]['wc_ID'] ?>"><?= $cust[$i]['wc_fname'] ?> <?= $cust[$i]['wc_lname'] ?></a></td>
		<td style="background-color: #<?= $nameColor ?>"><?= $cust[$i]['wc_email'] ?></td>
		<td><input type="checkbox" name="badActor" <?= $checked ?>><?= $cust[$i]['wc_fname'] ?></td>
	</tr>
	<?php } ?>
</table>
<a href="index.php">Exit</a><br>
</body>
</html>