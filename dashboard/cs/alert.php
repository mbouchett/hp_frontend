<?php
	include "/home/homeportonline/crc/2018.php";
	date_default_timezone_set('America/New_York');
	
	require 'twilio-php-master/Twilio/autoload.php';  
	
	$to = $_REQUEST['phone'];
	$temp = $_REQUEST['temp'];
	$when = date("Y-m-d H:i:s");;

$text = "The temperature at the cottage has fallen dangerously low. \nTemp at ".$when." is :\n". $temp." degrees farenheit.";
exit;
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