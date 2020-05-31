<?php
//unpicked.php 2018/01
// Display cs items that have been received but the customer has not picked up
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT a.`ci_ID`, a.`ci_sku`, a.`ci_desc`, a.`cust_ID`,  a.`ci_dateheld`, a.`ci_datecontacted`, a.`ci_datepickedup`, 
		         b.`cust_name`, b.`cust_phone`,
		         c.`vendor_name` 
		  FROM `cust_items` a
		  LEFT JOIN `customers` b
		  		 USING (`cust_ID`)
        Left JOIN `vendors` c
        		 USING (`vendor_ID`)
        WHERE `ci_dateheld` ORDER BY `ci_dateheld`';
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
for($i = 0; $i < $listCount; $i++) {
	$items[$i] = mysqli_fetch_assoc($result);	
}

$ii=0;
for($i=0; $i<$listCount; $i++){
 if(!$items[$i]['ci_datepickedup']){
   $goodlist[$ii]=$items[$i];
   $ii=$ii+1;
 }
}
$goodCount=count($goodlist);

?>


<!DOCTYPE html>

<html>

<head>
  <title>Not Picked Up Wantlists</title>
</head>
<body>
<button onclick="parent.location='csMenu.php'">Exit</button>
<br />
<table style=" font-family: Arial; font-weight: bold" align="center" border="1" width="1000">
    <?php for($i=0; $i<$goodCount; $i++){ ?>
    <tr>
        <td ><a style="text-decoration: none" href="csEdit.php?cust_ID=<?= $goodlist[$i]['cust_ID'] ?>" ><?= $goodlist[$i]['cust_name'] ?></a></td>
        <td ><a style="text-decoration: none" href="csEdit.php?cust_ID=<?= $goodlist[$i]['cust_ID'] ?>" ><?= $goodlist[$i]['ci_sku'] ?></a></td>
        <td ><a style="text-decoration: none" href="csEdit.php?cust_ID=<?= $goodlist[$i]['cust_ID'] ?>" ><?= $goodlist[$i]['ci_desc'] ?></a></td>
        <td ><a style="text-decoration: none; font-size: 10px" href="csEdit.php?cust_ID=<?= $goodlist[$i]['cust_ID'] ?>" ><?= $goodlist[$i]['vendor_name'] ?></a></td>
    </tr>
    <?php } ?>
</table>
<?php
if($goodCount < 1) { ?>
<div style="font-family: Arial; font-weight: Bold; font-size: 24px" align="center">Everything Has Been Picked Up<br />
<img border="0" src="images/happyface.jpg" alt="Happy Face" />
</div>
<?php } ?>
</body>

</html>
