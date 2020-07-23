<?php
//processEnterSales.php 2020/07
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$date = $_POST['date'];
$amt = $_POST['amt'];
$cat = $_POST['cat'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT `".$db_db."`.`sales_by_cat` (`sbc_date`, `sbc_amt`, `dept_ID`)
        VALUES ('$date', '$amt', '$cat')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
if(!$result){
	echo "Add Data - No Good<br>";
   echo $sql;
   echo mysqli_error($db);
   die;
}else {
	$ID = mysqli_insert_id($db);	
}
mysqli_close($db); //close the connection
header('location: enterSales.php?today='.$date);
?>