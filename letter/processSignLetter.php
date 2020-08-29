<?php
@include "/home/homeportonline/crc/2018.php";

// Functions
function test_input($data) { // validate data before insert
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(!$_POST['name']){
	 header('Location: index.php');
	die;
}
$name = test_input($_POST['name']);

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`petition_behave` (`pb_sig`) VALUES ('$name')";

//perform action
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Signature Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('Location: index.php');
?>