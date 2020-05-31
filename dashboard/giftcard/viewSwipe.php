<?php
//processSwipe.php 2018/01
// Main Gift Card Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$message=$_REQUEST['message'];

$user = $_SESSION['username'];
$today = date("F j, Y, g:i a");
$swipe = $_POST['swipe'];
if (!$swipe) $swipe=trim($_REQUEST['swipe']);

if(strlen($swipe)==18 && substr($swipe,17,1)=="?") $swipe = substr($swipe,1,16);

if(strlen($swipe)>16){
	$gc_num=substr($swipe,2,16);
}else {
	$gc_num=$swipe;
}

if(strlen($swipe)<16) {
	header('Location: swipe.php?message=Invalid Card');
	die;
}
if(strlen($swipe)>16 && substr($swipe,0,2) != "%B") {
	header('Location: swipe.php?message=Invalid Card');
	die;
}
if(strlen($gc_num)!= 16) {
	header('Location: swipe.php?message=Invalid Card');
	die;
}
for($i = 0; $i < 16; $i++) {
	$a = substr($gc_num, $i, 1);
	if(!is_numeric($a)) {
		header('Location: swipe.php?message=Invalid Card');
		die;
	}
}

//echo $gc_num;
//exit;

//Open The Database and look for the card
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `gc` WHERE `gc_num` = \''.trim($gc_num).'\' ' ;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Gift Card Load Failed<br>";
	echo mysqli_error($db);
	die;
}
$num_results=mysqli_num_rows($result);
//if the card is not found add the card
if($num_results==0){
	$sql = "INSERT INTO `".$db_db."`.`gc` (`gc_num`, `gc_issued`) VALUES ('$gc_num', '$today')";
	$result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Update Gift Card Load Failed<br>";
		echo mysqli_error($db);
		die;
	}	
	$sql = 'SELECT * FROM `gc` WHERE `gc_num` = \''.trim($gc_num).'\' ' ;
	$result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Update Retrieve Card Load Failed<br>";
		echo mysqli_error($db);
		die;
	}
}
$gc = mysqli_fetch_assoc($result);
mysqli_close($db);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Administer Gift Card</title>
  <link rel="stylesheet" href="css/swipe.css" type="text/css" />
</head>

<body>
<div id="banner">
  <img alt="Homeport Logo" src="images/hplogosm.png" />
</div>
<br />
<h3>Homeport Gift Card</h3>
<div class="user">logged in as: <?=$user?></div>
<br />
<form action="processViewSwipe.php" method="post">
<table align="center" class="gctable">
    <tr>
        <td>
        	Card# 
			<?= substr($gc['gc_num'],0,4) ?> <?= substr($gc['gc_num'],4,4) ?> <?= substr($gc['gc_num'],8,4) ?> <?= substr($gc['gc_num'],12,4) ?>
        </td>
        <td align="right" rowspan="2"><img width="125"  src="images/hplogosm.png" /></td>
    </tr>
    <tr>
        <td>Issued: <?=stripslashes($gc['gc_issued'])?></td>
    </tr>
    <tr>
        <?php if(!$gc['gc_balance']) $gc['gc_balance'] = 0.00; ?>
        <td align="center" colspan="2"><b>Balance $<?=number_format(stripslashes($gc['gc_balance']),2)?></b></td>
    </tr>
    <tr><td bgcolor="#666666" colspan="2"></td></tr>
    <tr>
        <td>Add $<input name="add" type="text" size="7" /></td>
        <td> Subtract $<input name="subtract" type="text" size="7" /></td>
    </tr>
    <tr>
        <td colspan="2">Alert: <input name="gc_alert" type="text" size="45" value="<?=stripslashes($gc['gc_alert'])?>" /></td>
    </tr>
    <tr>
        <td align="right" colspan="2"><input name="" type="submit" value="Save changes" /></td>
    </tr>
</table>

<br />
<table align="center">
	<tr>
    <td><input value="Print This Card" TYPE="button" onClick="window.print()"> <input value="Swipe Another Card" onclick="parent.location='swipe.php'" type="button"><input value="Return To Dashboard" onclick="parent.location='../'" type="button"></td>
    </tr>
</table>
<input type="hidden" name="gc_ID" value="<?=stripslashes($gc['gc_ID'])?>" />
<input type="hidden" name="gc_num" value="<?=stripslashes($gc['gc_num'])?>" />
<input type="hidden" name="gc_balance" value="<?=stripslashes($gc['gc_balance'])?>" />
</form>
<br />
<?php if($message){?>
<br />
<table align="center" class="dashtable" >
    <tr><td><div align="center"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>
</body>

</html>