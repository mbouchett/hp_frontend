<?php
//processDepts.php 2018/01
// processes department edits
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$dept_ID = $_POST['dept_ID'];
$dept_name = $_POST['dept_name'];
$dept_belongs_to = $_POST['dept_belongs_to'];
$dept_area = $_POST['dept_area'];
$sort = $_POST[sort];
$itemCount = count($dept_ID);

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemCount; $i++) {
	$sql = "UPDATE `".$db_db."`.`departments`
    		  SET `dept_name` = '".addslashes($dept_name[$i])."',
        		   `dept_belongs_to`=".$dept_belongs_to[$i].", 
               `area_ID`=".$dept_area[$i]." 
     		  WHERE `dept_ID`=".$dept_ID[$i];
   $result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Department Update Failed<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db);
header('location: depts.php?sort='.$sort);
die;
?>