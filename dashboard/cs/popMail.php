<?php
//csEdit.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$today = date('Y-m-d');

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];
$message=$_REQUEST['message'];
$cust_ID=$_REQUEST['cust_ID'];

// =================== get user list =================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `resource_firstName`,`resource_lastName`,`resource_email`
		  FROM `resource` 
		  WHERE `resource_lastDay` IS NULL   		  
		  ORDER BY `resource_lastName`";
$result = mysqli_query($db, $sql);
$usercount=mysqli_num_rows($result);
mysqli_close($db);

for($i=0; $i<$usercount; $i++){ 
    $users[$i]=mysqli_fetch_assoc($result);
}

// ================= get customer info ===============
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `customers` WHERE `cust_ID`='.$cust_ID ;
$result = mysqli_query($db, $sql);
mysqli_close($db);
$cust=mysqli_fetch_assoc($result);

$popmessage = $username." requests that you please look at this customer service record.\n";
$popmessage .="Customer Name: ".$cust['cust_name']."\n";
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8" />
	<title>Email Notice</title>
	<link href="css/popMail.css" rel="stylesheet" type="text/css" />
</head>
<body>
<hr size="12" noshade="noshade"/>
<?php if($message){?>
<table align="center" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<div align="center"><input type="button" name="" value="Close Window" onclick="window.close()" /></div>
<?php unset($message);
 }else {?>
<form action="processPopMail.php" method="post" >
    <?= $username ?> requests that you please look at this customer service record.<hr />
    Customer Name: <b><?= $cust['cust_name'] ?></b><hr/>
    Additional Comments:<br />
    <textarea name="comment" rows="3" cols="40"></textarea>
    <hr />
    <input type="submit" value="Send Message" /> To:
    <select name="mailto" size="1">
        <?php for($i=0; $i < $usercount; $i++){ ?>
        <option value="<?= $users[$i]['resource_email'] ?>"><?= $users[$i]['resource_firstName'] ?> <?= $users[$i]['resource_lastName'] ?></option>
        <?php } ?>
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="" value="Cancel" onclick="window.close()" />
    <input type="hidden" name="popmessage" value="<?= $popmessage ?>" />
    <input type="hidden" name="cust_name" value="<?= $cust['cust_name'] ?>" />
    <input type="hidden" name="cust_ID" value="<?= $cust_ID ?>" />
</form>
<?php } ?>
<hr size="12" noshade="noshade"/>
</body>
</html>
