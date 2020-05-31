<?php
//processNewaccount.php
//Mark Bouchett 2019
@include "/home/homeportonline/crc/2018.php";

$email = $_POST['email'];
$pw = $_POST['pw'];
$item = $_POST['item'];
$branch = $_POST['branch'];
$cust = $_POST['cust'];

$hash=crypt($pw, '$2a$07$theclockswerestrikingthirteen$');

// check to see if user exists
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "Select * from `web_cust` WHERE `wc_email` = '".$email."'";
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db);

if (!$email || !$pw) {
    header('Location: signIn.php?alert=Login Error...');
	die;
}
if($num_results == 0) {
	header('Location: signIn.php?alert=Login Error...');
	die;
}
$user=mysqli_fetch_assoc($result);
if($hash != $user['wc_pw']) {
	header('Location: signIn.php?alert=Login Error...');
	die;	
}

// set cookies
setcookie("c_name", $user['wc_fname'], time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("c_ID", $user['wc_ID'], time() + (86400 * 30), "/"); // 86400 = 1 day

if($item && $branch == "like") {
	header('Location: processAddToLikes.php?item='.$item.'&back=3');
	die;	
}
if($item && $branch == "wish") {
	header('Location: ../registries/processAddToWish.php?item='.$item.'&back=3');
	die;	
}
if($item && $branch == "reg") {
	header('Location: ../registries/processAddToReg.php?item='.$item.'&back=3');
	die;	
}
if($branch == "createReg") {
	header('Location: ../registries/createReg.php');
	die;
}
if($branch == "shopReg") {
	header('Location: ../registries/shopReglist.php?cust='.$cust);
	die;
}
if($branch == "shopWish") {
	header('Location: ../registries/shopWishlist.php?cust='.$cust);
	die;
}
if($branch == "cart") {
	header('Location: ../cart/checkout.php');
	die;
}
if($branch == "favs") {
	header('Location: ../favorites.php');
	die;
}
header('Location: ../');
die;
?>