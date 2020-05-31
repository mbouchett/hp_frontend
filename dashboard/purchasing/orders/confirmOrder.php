<?php
//confirmOrder.php 2018/01
// remote order acknowledgment
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

$email=$_REQUEST['email'];
$order_ID=$_REQUEST['order_ID'];

$finalStory = 'Order Received : <a href="http://www.homeportonline.com/dashboard/purchasing/orders/repViewOrder.php?order_ID='.$order_ID.'">'.$order_ID.'</a>';
//echo $finalStory;
//exit;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Order Receipt Confirmation'. "\r\n";

// Send the email
mail($email,'Confirmation Order# '.$order_ID,$finalStory,$headers);

$date = date('F d, Y');

// Update the order as sent
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `order_akn` = \"R-".$date."\"
        WHERE `orders`.`order_ID` = ".$order_ID.";";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: confirmConfirmation.php?order_ID='.$order_ID);
die();
?>
