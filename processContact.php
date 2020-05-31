<?php
	/* Homeport Process for contact page 
		Mark/Francois Bouchett 2020
		http://www.homeportonline.com/processContact.php 
	*/
	// ******************* Database Credentials *******************
	@include "/home/homeportonline/crc/2018.php";
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	
	//echo $fname."<br>";
	//echo $lname."<br>";
	//echo $email."<br>";
	//echo $message."<br>";

$date = date('F d, Y');

$captcha;

if(isset($_POST['g-recaptcha-response'])){
	$captcha=$_POST['g-recaptcha-response'];
	}
  if(!$captcha){
    echo '<h2>Please check the the captcha form.</h2>';
    exit;
  }
$ip = $_SERVER['REMOTE_ADDR'];
// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response,true);
// should return JSON with success as true
if(!$responseKeys["success"]) {
	echo '<h2>You are a spammer!</h2>';
}

$finalStory = 'Customer Inquiry<br>'.
               $fname.' '.$lname.' asks/comments: '.
               '<hr>'.$message.'<hr>';
//echo $finalStory;
//exit;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:  ' .$fname.' '.$lname.' <' . $email .'>' . " \r\n";
$headers .= 'Reply-To: '.$email. "\r\n";

// Send the email
mail('home.homeport@gmail.com','Customer Contact',$finalStory,$headers);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Message Sent</title>
</head>
<body>
	Okay! Your message has been sent!<br>
	<a href="index.php" >-return-</a>
</body>
</html>