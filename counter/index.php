<?php
	//Load A Single Value From A Flat File
	$fp = fopen('/home/homeportonline/crc/number.txt', "r");  			//Open The File For Reading
	  $number= fgets($fp);                    //Load The Value
	fclose($fp);                            	//Close The File


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Now Serving</title>
</head>
<body>
	<div>Now Serving</div>
	<div><?= $number ?></div>
	<div>
		<form method="post" action="processAdvance.php">
				<input name="set" />
				<input type="submit" value="Advance/Set" />
		</form>
	</div>
</body>
</html>