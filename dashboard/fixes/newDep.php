<?php
include "/home/homeportonline/crc/2018.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<script type="text/javascript" >
	function setFocus() {
    document.getElementById("name").focus();
}
</script>
</head>
<body onload="setFocus()">

<form action="processNewDept.php" method="post">
<table>
	<tr>
		<td>Department Name</td>	
		<td>Old Department</td>
		<td>Belongs To</td>
		<td>Area</td>
		<td></td>
	</tr>
	<tr>
		<td><input id="name" type="text" name="dep_name"></td>	
		<td><input type="text" name="old_dep"></td>
		<td><input type="text" name="belongs_to"></td>
		<td><input type="text" name="area"></td>
		<td><input type="submit" name="add"></td>
	</tr>
</table>

</form>
</body>
</html>