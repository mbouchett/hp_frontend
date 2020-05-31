<?php
// processClosePo.php 2018/01
// Search Items Database By: sku, description or vendor name
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

//Get Vars
$po = $_REQUEST['po'];
$stat = $_REQUEST['stat'];
$po = substr($po, 0, 7);

// Update the order as closed by ap
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `order_status` = ".$stat."
        WHERE `orders`.`order_ID`=".$po;
$result = mysqli_query($db, $sql); // create the query object
if(!$result) {
    echo "Close Order Failed<br>";
    echo $sql."<br>";
    echo mysqli_error($db);
    die;
}
mysqli_close($db); //close the connection

header('Location: sentOrders.php');
die;
?>