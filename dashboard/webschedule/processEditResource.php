<?php
//processEditResource.php 2018/01
// processes resource changes
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

//get user variables
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];
if($userlevel<5){
    echo "What are you doing here?";
    die;
}

// Collect POST Variables
$recno = $_POST['recno'];
$employeeNumber = $_POST['employeeNumber'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userName = $_POST['userName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$hired = $_POST['hired'];
$lastDay = $_POST['lastDay'];
$adjustedPay = $_POST['adjustedPay'];
$hourlyRate = $_POST['hourlyRate'];
$oldRate = $_POST['oldRate'];
$salary = $_POST['salary'];
$level = $_POST['level'];
$resetPW = $_POST['resetPW'];
$com = $_POST['com'];
$ptcom = $_POST['ptcom'];

$itemCount = count($recno);

// set last day if if rate is changed
for($i=0; $i<$itemCount; $i++){
    if($hourlyRate[$i] != $oldRate[$i]){
        //echo $hourlyRate[$i].' - '.$oldRate[$i].'<br>';
        $adjustedPay[$i]  = date("Y-m-d");
    }
    $com[$i] = ($com[$i]) ? 1 : 0;
    $ptcom[$i] = ($ptcom[$i]) ? 1 : 0;
}
// Update Data to an SQL database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
for($i=0; $i<$itemCount; $i++){
	
    $sql = "UPDATE `".$db_db."`.`resource`
        SET `resource_firstName` = '".$firstName[$i]."',
		 `resource_lastName` = '".$lastName[$i]."',
         `resource_userName` = '".$userName[$i]."',
         `resource_phone` = '".$phone[$i]."',
         `resource_email` = '".$email[$i]."',
         `resource_payChange` = '".$adjustedPay[$i]."',
         `resource_level` = '".$level[$i]."',
         `resource_com` = '".$com[$i]."',
         `resource_ptcom` = '".$ptcom[$i]."',
         `resource_firstDay` = '".$hired[$i]."'
         WHERE `resource_ID` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
if(!$result) {
	echo "Resource Update Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection

//Save Employee Numbers
for($i=0; $i<$itemCount; $i++){
    $sql = "UPDATE `".$db_db."`.`resource` SET `resource_num` = '".$employeeNumber[$i]."' WHERE `resource_ID` = '".$recno[$i]."';";

    if(!$employeeNumber[$i]) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_num` = NULL WHERE `resource_ID` = '".$recno[$i]."';";
    if($employeeNumber[$i] == 0) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_num` = NULL WHERE `resource_ID` = '".$recno[$i]."';";
    //if(is_nan($employeeNumber)) $sql = "UPDATE `".$db_db."`.`resource` SET `employeeNumber` = NULL WHERE `recno` = '".$recno[$i]."';";
    if(strlen($employeeNumber[$i]) == 0) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_num` = NULL WHERE `resource_ID` = '".$recno[$i]."';";

    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $result = mysqli_query($db, $sql); // create the query object
    if(!$result) {
		echo "Employee Number Update Failed<br>";
		echo mysqli_error($db);
		die;
	 }
    mysqli_close($db); //close the connection
}
// Save Hourly Rates
for($i=0; $i<$itemCount; $i++){
    $sql = "UPDATE `".$db_db."`.`resource` SET `resource_hourly` = '".$hourlyRate[$i]."' WHERE `resource_ID` = '".$recno[$i]."';";

    if(!$hourlyRate[$i]) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_hourly` = NULL WHERE `resource_ID` = '".$recno[$i]."';";
    if($hourlyRate[$i] == 0) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_hourly` = NULL WHERE `resource_ID` = '".$recno[$i]."';";
    //if(is_nan($hourlyRate[$i])) $sql = "UPDATE `".$db_db."`.`resource` SET `hourlyRate` = NULL WHERE `recno` = '".$recno[$i]."';";
    if(strlen($hourlyRate[$i]) == 0) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_hourly` = NULL WHERE `resource_ID` = '".$recno[$i]."';";

    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $result = mysqli_query($db, $sql); // create the query object
	if(!$result) {
		echo "Hourly Rate Update Failed<br>";
		echo mysqli_error($db);
		die;
	 }
    mysqli_close($db); //close the connection
}
// Save Salaries
for($i=0; $i<$itemCount; $i++){
    $sql = "UPDATE `".$db_db."`.`resource` SET `resource_salary` = '".$salary[$i]."' WHERE `resource_ID` = '".$recno[$i]."';";

    if(!$salary[$i]) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_salary` = NULL WHERE `resource_ID` = '".$recno[$i]."';";
    if($salary[$i] == 0) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_salary` = NULL WHERE `resource_ID` = '".$recno[$i]."';";
    //if(is_nan($salary[$i])) $sql = "UPDATE `".$db_db."`.`resource` SET `salary` = NULL WHERE `recno` = '".$recno[$i]."';";
    if(strlen($salary[$i]) == 0) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_salary` = NULL WHERE `resource_ID` = '".$recno[$i]."';";

    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Salary Update Failed<br>";
		echo mysqli_error($db);
		die;
	 }
    mysqli_close($db); //close the connection
}
// Save lastDay
$pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"; // Valid Date (YYYY-MM-DD)
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$itemCount; $i++){
    $sql = "UPDATE `".$db_db."`.`resource` SET `resource_lastDay` = '".$lastDay[$i]."' WHERE `resource_ID` = '".$recno[$i]."';";
    if(!preg_match($pattern, $lastDay[$i])) $sql = "UPDATE `".$db_db."`.`resource` SET `resource_lastDay` = NULL WHERE `resource_ID` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
	if(!$result) {
		echo "lastDay Update Failed<br>";
		echo mysqli_error($db);
		die;
	 }
}
mysqli_close($db); //close the connection

// reset password
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$pw = '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS';
for($i=0; $i<$itemCount; $i++){
	$sql = "UPDATE `".$db_db."`.`resource` SET `resource_password` = '".$pw."' WHERE `resource_ID` = '".$recno[$i]."';";
	if($resetPW[$i]){
		$result = mysqli_query($db, $sql); // create the query object
		if(!$result) {
			echo "lastDay Update Failed<br>";
			echo mysqli_error($db);
			die;
		}
	}
}
mysqli_close($db); //close the connection
header('location: editResource.php?message=Changes Saved');
die;
?>