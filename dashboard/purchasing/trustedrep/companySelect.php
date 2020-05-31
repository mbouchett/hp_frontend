<?php
	include "/home/homeportonline/crc/2018.php";
	date_default_timezone_set('America/New_York');
	
	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['repnum'])){
		header('Location: index.php');
		die;
  	}

	// *************** Open vendor database find matching emails ***************
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `vendors`.`vendor_ID`,`vendors`.`vendor_name` 
			  FROM `vendors` 
			  WHERE `vendor_email` = "'.$_SESSION['repemail'].'"
			  ORDER BY `vendor_name`';
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "Lookup Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
	$vendorCount = mysqli_num_rows($result);
	mysqli_close($db); 
	//Store the Results To A Local Array
	for($i=0; $i<$vendorCount; $i++){
		$vendor[$i] = mysqli_fetch_assoc($result);
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Trusted Rep Main Menu (<?= $vendorCount ?>)</title>
</head>
<body>

<?= $_SESSION['repfname'] ?> <?= $_SESSION['replname'] ?>'s Vendor List:<br>
<hr align="left" width="25%">
<?php for($i=0; $i<$vendorCount; $i++){ ?>
<a href="items.php?vendor_ID=<?= $vendor[$i]['vendor_ID'] ?>" ><?= $vendor[$i]['vendor_name'] ?></a><br>
<?php } ?>
<hr align="left" width="25%">
<!-- Change Password -->
<hr align="left" width="25%">
</body>
</html>