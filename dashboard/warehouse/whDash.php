<?php
//whDash.php 2018/01
// Admin dashboard for warehouse inventory
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$tag=$_REQUEST['tag'];
unset($enabled);
if(!$tag) $enabled='disabled="disabled"';

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Warehouse Administrator Dashboard</title>
	<style type="text/css">
		td {
			border-style: solid;
			border-width: 1px;
			padding: 5px;
			width: 150px;	
		}
	</style>
</head>

<body>
<br />
<big><b>Warehouse Administrator Dashboar<a style="text-decoration: none" href="whDash.php?tag=woopie" >d</a></b></big>
<br /><br />
<table>
	<tr>
		<td><a href="addInventory.php">Add Inventory</a></td>
      <td><a href="editInventory.php">Edit Inventory</a></td>
	</tr>
	<tr>
		<td><input <?= $enabled ?> value="Tag Verify" onclick="parent.location='tagInventory.php'" type="button"></td>
		<td><a href="../">Exit</a></td>
	</tr>
</table>
</body>
</html>
