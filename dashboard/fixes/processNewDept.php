<?php
include "/home/homeportonline/crc/2018.php";

//processNewDept.php
$name=$_POST['dep_name'];
$oldDept=$_POST['old_dep'];
$belongsTo=$_POST['belongs_to'];
$area=$_POST['area'];

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = "INSERT INTO `".$db_db."`.`departments` 
			(`dept_name`, `old_dep`, `dept_belongs_to`, `area_ID`) 
			VALUES ('$name','$oldDept',$belongsTo, $area)";
$result = mysqli_query($db, $sql);          //Initiate The Query
mysqli_close($db);

header('Location: newDep.php');
die;
?>