<?php
//enterSales.php 2020/07
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$today = ($_REQUEST['today']) ? $_REQUEST['today'] : date('Y-m-d');
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `sales_by_cat` ORDER BY `sbc_date` DESC";
//perform action
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Lookup Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$itemCount = mysqli_num_rows($result);
mysqli_close($db); 
//Store the Results To A Local Array
for($i=0; $i<$itemCount; $i++){
	$sbc[$i] = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Enter Sales By Category</title>
<style type="text/css">
	td{
			border-style: solid; 
			border-color: black; 
			border-width: 1px;
	}
</style>
<script type="text/javascript" >
	function focusonamt() {
		var x = document.getElementById('inpt');
		x.focus();
	}
</script>
</head>
<body onload="focusonamt();">
	<form method="post" action="processEnterSales.php">
	<label for="date">Date:</label>
	<input type="date" id="date" name="date" value="<?= $today ?>"> 
	<label for="amt">Amt:</label>
	<input id="inpt" type="text" id="amt" name="amt">
	<label for="cat">Cat:</label>
	<input type="text" id="cat" name="cat">
	<input type="submit" value="Save" />
	</form>
	<hr>
	<table>
	<tr><td>Date</td><td>Amount</td><td>Category</td></tr>
	<?php for($i=0; $i<$itemCount; $i++){ ?>
	<tr>
		<td><?= $sbc[$i]['sbc_date'] ?></td><td style="text-align: right;"><?= number_format($sbc[$i]['sbc_amt'],2) ?></td><td style="text-align: center;"><?= $sbc[$i]['dept_ID'] ?></td>
	</tr>
	<?php } ?>
	</table>
</body>
</html>