<?php
$today = ($_REQUEST['today']) ? $_REQUEST['today'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Enter Sales By Category</title>
</head>
<body>
	<form method="post" action="processEnterSales.php">
	<label for="date">Date:</label>
	<input type="date" id="date" name="date" value="<?= $today ?>"> 
	<label for="amt">Amt:</label>
	<input type="text" id="amt" name="amt">
	<label for="cat">Cat:</label>
	<input type="text" id="cat" name="cat">
	<input type="submit" value="Save" />
	</form>
</body>
</html>