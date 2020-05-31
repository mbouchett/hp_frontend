<?php
//processWhPickup.php 2018/01
// Processes a pickup request
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
  
require 'twilio-php-master/Twilio/autoload.php';  
  
// scrub text for database
function scrubText($text){
    $scrubbedText = str_replace("'", "", $text);
    $scrubbedText = str_replace('"', '', $scrubbedText);
    $scrubbedText = str_replace("\\", "-", $scrubbedText);
    return $scrubbedText;
}

$username=$_SESSION['username'];
$who=$_POST['who'];
$what=$_POST['what'];
$time=$_POST['time'];
$date=$_POST['date'];
$day=$_POST['day'];
$customer=$_POST['customer'];
$company=$_POST['company'];
$sku=$_POST['sku'];
$description=$_POST['description'];
$message=stripslashes($_POST['message']);

if(!$username) $username = $_POST['user'];
if(!$date) $date = "xxx";
if(!$time) $time = "xxx";
if(!$day) $day = "xxx";
if(!$sku) $sku = "N/A";
if(!$description) $description = "xxx";
if(!$customer) $customer = "xxx";
if(!$company) $company = "xxx";

$when = "[".$day."] [".$time."] [".$date."]";

switch ($who) {
    case "francois":
        $to = "+18023630546";
        break;
    case "mark":
        $to = "+18023731035";
        break;
    case "frank":
        $to = "+18023731036";
        break;
    case "taylor":
        $to = "+18026890543";
        break;
    case "derek":
        $to = "+18025987776";
        break;
    case "theo":
        $to = "+18023386557";
        break;
    case "dawson":
        $to = "+12673779246";
        break;
    case "garett":
        $to = "+18603186492";
        break;
}

//Scrub the data
$when = scrubText($when);
$who = scrubText($who);
$what = scrubText($what);
$customer = scrubText($customer);
$company = scrubText($company);
$sku = scrubText($sku);
$description = scrubText($description);
$message = scrubText($message);
$username = scrubText($username);

// save to the message log
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`pickups` (`pu_when`, `pu_employee`, `pu_location`, `pu_cust_name`, `pu_vendor_name`, `pu_sku`, `pu_desc`, `pu_message`, `pu_requestedBy`)
        VALUES ('$when', '$who', '$what', '$customer', '$company', '$sku', '$description', '$message','$username')";
$result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "save pickup log Error!<br>";
	echo $sql." - ".$i."<br>";
	echo mysqli_error($db);
	die;
}
$pu_ID = mysqli_insert_id($db);
mysqli_close($db);


$text = "Pick Up:\www.homeportonline.com/dashboard/cs/pickup.php?pu_ID=".$pu_ID."\n";

//***********************************************************************************************

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    $to,
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+18029921899',
        // the body of the text message you'd like to send
        'body' => $text
    )
);

//***********************************************************************************************
?>
<script type="text/javascript">
    alert("Message Sent");
    window.location="whPickup.php"
</script>