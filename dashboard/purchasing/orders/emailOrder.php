<?php
//emailOrder.php 2018/01
// enter a vendor count worksheet
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$sender = strtoupper(substr($username,0,1)).'. '.ucwords(substr($username,1));

$email=$_REQUEST['email'];
$order_ID=$_REQUEST['po'];

$date = date('F d, Y');

$finalStory = 'Follow the link below to view a purchase order From <h3>&nbsp;&nbsp;&nbsp;&nbsp;Homeport</h3>52 Church Street, Burlington, VT 05401<br />802-863-4832'.
'<br /><br />Navigate Your Browser to: http://www.homeportonline.com/dashboard/purchasing/orders/repViewOrder.php?order_ID='.$order_ID.
'<br/><a href="http://www.homeportonline.com/dashboard/purchasing/orders/repViewOrder.php?order_ID='.$order_ID.'"> Or Click Here To View Purchase Order #'.$order_ID.'</a><br />'.
'<br /><a href="http://www.homeportonline.com/dashboard/purchasing/orders/confirmOrder.php?order_ID='.$order_ID.'&email='.$useremail.'">Please Click Here To Confirm Receipt of This Order</a>'.
' or<br />Navigate you browser to: http://www.homeportonline.com/dashboard/purchasing/orders/confirmOrder.php?order='.$order_ID.' <br />-Thank You';
//echo $finalStory;
//exit;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:  ' . $username . ' <' . $useremail .'>' . " \r\n";
$headers .= 'Reply-To: '.$useremail. "\r\n";

// Send the email
mail($email,'Homeport Purchase Order# '.$po,$finalStory,$headers);

// Update the order as sent
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `orders`.`order_emailed` = \"E-".$date."\", 
        		`orders`.`order_status` = 2 
        WHERE `orders`.`order_ID` = ".$order_ID;

//echo $sql;
//exit;

$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Order email Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('Location: viewOrder.php?order_ID='.$order_ID.'&success=yes');
die();
?>