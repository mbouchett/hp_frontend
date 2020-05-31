<?php
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
  date_default_timezone_set('America/New_York');
?>
<!DOCTYPE html>
<html>
<head>
<link rel="SHORTCUT ICON" href="dash.ico">
<title>Homeport Registry Editor</title>
<style type="text/css">
	td{border: solid thin black;}
	a{cursor: pointer;}
</style>
</head>

<body>
<span class="dashtitle">Homeport Registry Editor</span>
<br />
<table>
	<tr>
		<td><a onclick="parent.location='selectProfileToEdit.php'" title="1">Edit Registry Profile</a></td>	
		<td><a onclick="parent.location='selectRegToEdit.php'">Add/Edit Items</a></td>
		<td><a onclick="parent.location='../'">Main Dashboard</a></td>
	</tr>
</table>
</body>
</html>
