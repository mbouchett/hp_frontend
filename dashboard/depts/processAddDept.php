<?php
//processAddDept.php 2018/04
// Saves a new department to the system
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$dept_name = $_REQUEST['dept_name'];
$dept_belongs_to = $_REQUEST['dept_belongs_to'];
$dept_area = $_REQUEST['dept_area'];

if(!$dept_name || !$dept_belongs_to){
  header('location: depts.php?message=***Department Not Saved***');
}

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT `".$db_db."`.`departments` (`dept_name`, `dept_belongs_to`, `area_ID`)
        VALUES ('$dept_name', '$dept_belongs_to', '$dept_area')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
if(!$result){
	echo "Add Department - No Good<br>";
   echo $sql;
   echo mysqli_error($db);
   die;
}
header('location: depts.php?message=***Department Added***');
?>