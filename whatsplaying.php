<?php
//includes
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
$artist = $_REQUEST['s1'];
$album = $_REQUEST['s2'];
$song = $_REQUEST['s3'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
$sql = "INSERT INTO `".$db_db."`.`music` (`artist`, `album`, `song`)
        VALUES ('$artist', '$album', '$song')";
$result = mysqli_query($db, $sql);
mysqli_close($db);
?>