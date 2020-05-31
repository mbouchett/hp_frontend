<?php
/* Contact form
	Mark/Francois Bouchett 2019
	processStatusUpdate.php
*/

// ******************* Database Credentials *******************
@include "/home/homeportonline/crc/2018.php";
@include "/home/homeportonline/crc/_unMash.php";

	$wo_ID = $_REQUEST['wo_ID'];
	$stat = $_REQUEST['stat'];
	if(!$wo_ID | !is_numeric($stat)) {
		die;
	}
	
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "UPDATE `".$db_db."`.`web_order` 
		    SET `wo_status` = ".$stat."
            WHERE `wo_ID` = ".$wo_ID;
	$result = mysqli_query($db, $sql);
	// on update error
	if(!$result){
		echo "Update No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
	mysqli_close($db);
	
	//Return To the Calling Page With a status Alert
	header('Location: orderDetails.php?wo_ID='.$wo_ID);
	die;
?>