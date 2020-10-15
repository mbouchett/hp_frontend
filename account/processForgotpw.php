<?php
/*  Process forgot password
	Mark/Francois Bouchett 2019
	http://www.homeportonline.com/account/processForgotpw.php
*/
@include "/home/homeportonline/crc/2018.php";

$email = $_POST['email'];

if (!$email) {
    header('Location: forgotpw.php?alert=Email Address Required!');
	die;
}
$pw="";
// Make a password
for($i = 0; $i < 12; $i++) {
	$ch = chr(rand(33, 125));
	$pw = $pw.$ch;
}

$hash=crypt($pw, '$2a$07$theclockswerestrikingthirteen$');

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
	$sql = "UPDATE `".$db_db."`.`web_cust`  
		    SET `wc_pw` = '".$hash."'
            WHERE `wc_email` = '".$email."'";
$result = mysqli_query($db, $sql); // create the query object
// on update error
if(!$result){
	echo "Update No Good!<br>";
	echo $sql." - ".$i."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

setcookie("c_name", '', time() - 3600, "/"); // 86400 = 1 day
setcookie("c_ID", '', time() - 3600, "/"); // 86400 = 1 day

// send email with temporary password
$msg = "You can log on to homeportonline.com using this new password: ".$pw;
// send email
mail($email,"Homeport Password Reset",$msg);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Password Reset</title>
</head>
<body>
Your password has been reset and an email has been sent to: <?= $email ?><br>
<a href="../" >Return to Homeport</a>
</body>
</html>
