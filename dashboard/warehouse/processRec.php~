<?php
//processRec.php 2018/05
// process changes to the warehouse receiving log
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
  	
$date=date('Y/m/d');
$shipper=$_POST['shipper'];
$vendor=$_POST['vendor'];
$receiver=$_POST['receiver'];
$pieces=$_POST['pieces'];
$comment=$_POST['comment'];

//if the account is not found
if(!$shipper || !$vendor || !$receiver || !$pieces){
	header('Location: rec.php?message=Shipper Vendor Receiver and Pieces are all required&messColor=CC0033&messSize=24');
	die;
}

$comment=$_POST['comment'];
    // save to database
    //open connection
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	//create insert string
$sql = "INSERT INTO `".$db_db."`.`freightlog` (`flog_date`, `flog_shipper`, `flog_vendor`, `flog_receiver`, `flog_pieces`, `flog_comment`)
        VALUES ('$date', '$shipper', '$vendor', '$receiver', '$pieces', '$comment')";       
	//perform action
$result = mysqli_query($db, $sql); // create the query object
	//close the connection
mysqli_close($db);

$finalStory=    '<br /><table align="center" border="1">'."\n".
                '<tr style="font-weight: bold">'."\n".
                '<td width="50">Date</td>'."\n".
                '<td width="100">Shipper</td>'."\n".
                '<td width="100">Vendor</td>'."\n".
                '<td width="40"># Pcs</td>'."\n".
                '<td width="60">Receiver</td>'."\n".
                '<td width="300">Comment</td>'."\n".
                '</tr>'."\n".
                '<tr>'."\n".
                '<td width="50">'.$date.'</td>'."\n".
                '<td width="100">'.$shipper.'</td>'."\n".
                '<td width="100">'.$vendor.'</td>'."\n".
                '<td width="40">'.$pieces.'</td>'."\n".
                '<td width="60">'.$receiver.'</td>'."\n".
                '<td width="300">'.$comment.'</td>'."\n".
                '</tr>'."\n".
                '</table>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Homeport Warehouse Burlington, VT homeport@homeportonline.com>' . "\r\n";

mail('tlacroix@homeportonline.com','Homeport Receiving Alert',$finalStory,$headers);
mail('sbevins@homeportonline.com','Homeport Receiving Alert',$finalStory,$headers);
mail('homeportap@gmail.com','Homeport Receiving Alert',$finalStory,$headers);
header('Location: rec.php?message=Shipment Logged&messColor=CC0033&messSize=24');
die;
?>