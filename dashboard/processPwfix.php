<?php
	include "/home/homeportonline/crc/2018.php";

	$ID = $_POST['ID'];
	$pw = $_POST['pw'];
	
	$count = count($ID);
	
	date_default_timezone_set('America/New_York');

	//Open The Database
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	for ($i = 0; $i < $count; $i++){
		if($pw[$i]){
			$hash=crypt($pw[$i], '$2a$07$theclockswerestrikingthirteen$');
			$sql = "UPDATE `resource` SET `resource_password`=\"".$hash."\" WHERE `resource_ID`=".$ID[$i];
			$result = mysqli_query($db, $sql); // create the query object
		}
	}
	mysqli_close($db); //close the connection
	header('location: pwfix.php')
?>