<?php
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

$pw = $_POST['pw'];
$hash=crypt($pw, '$2a$07$theclockswerestrikingthirteen$'); 
echo $hash."<br>";
?>
<!DOCTYPE html>
<html>
<head>
<title>Password</title>
</head>
<body>
	<form action="pw.php" method="post">
	<table>
		<tr>
			<td><input type="password" name="pw"></td>	
		</tr>
	<tr><td colspan="2"><button value="Save" type="submit">Save</button></td></tr>
	</table>
	</form>
</body>
</html>