<?php
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `resource`";
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

for ($i = 0; $i < $num_results; $i++){
	$resource[$i] = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf8_unicode_ci" />
<title>Password Fix</title>
</head>
<body>
	<form action="processPwfix.php" method="post">
	<table>
	<?php for ($i = 0; $i < $num_results; $i++){ ?>
		<tr>
			<td><?= $resource[$i]['resource_firstName'] ?> <?= $resource[$i]['resource_lastName'] ?></td>
			<td><input type="password" name="pw[<?= $i ?>]"><input type="hidden" name="ID[<?= $i ?>]" value="<?= $resource[$i]['resource_ID'] ?>"></td>	
		</tr>
	<?php } ?>
	<tr><td colspan="2"><button value="Save" type="submit">Save</button></td></tr>
	</table>
	</form>
</body>
</html>