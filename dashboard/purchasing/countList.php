<?php
//countList.php 2018/01
// Vendor to count this week
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
function getWeek(){
	$seconds = time();
	//echo "Seconds since 01/01/1970 ->".$seconds."<br>";
	$minutes = floor($seconds/60);
	//echo "Minutes since 01/01/1970 ->".$minutes."<br>";
	$hours = floor($minutes/60);
	//echo "Hours since 01/01/1970 ->".$hours."<br>";
	$days = floor($hours/24)-3;
	//echo "Days since 01/01/1970 ->".$days."<br>";
	$weeks = floor($days/7);
	//echo "Hours since 01/01/1970 ->".$weeks."<br>";
	$currentWeek = (($weeks-1) % 8) + 1;
	//echo "Current week ->".$currentWeek."<br>";
	return $currentWeek;
} 

$group = $_REQUEST['group'];
if(!$group) $group = getWeek();
$sort = $_REQUEST['sort'];
if(!$sort) $sort = 1;

// what day of the week is it?
$day = date("D");
$dayOffset = 0;
if($day == "Sun") $dayOffset = 0;
if($day == "Mon") $dayOffset = 1;
if($day == "Tue") $dayOffset = 2;
if($day == "Wed") $dayOffset = 3;
if($day == "Thu") $dayOffset = 4;
if($day == "Fri") $dayOffset = 5;
if($day == "Sat") $dayOffset = 6;


$today = date("Y-m-d");
$dayUnset = 6 - $dayOffset;
$begDate = date('Y-m-d', strtotime($today. " - $dayOffset days"));
$endDate = date('Y-m-d', strtotime($today. " + $dayUnset days"));
//echo $today." - ".$dayOffset." - ".$begDate." - ".$endDate." - ";

$sql = 'SELECT * FROM `vendors` WHERE `vendor_group`='.$group.'  ORDER BY `vendor_name`';
if($group == -1) $sql = 'SELECT * FROM `vendors` ORDER BY `vendor_name`';
if($sort == 2) $sql = 'SELECT * FROM `vendors` WHERE `vendor_group`='.$group.'  ORDER BY `vendor_counter`, `vendor_name`';

// -------------------- Load Vendors into array --------------------
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Load Group Failed<br>";
    echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$vndCount = mysqli_num_rows($result);
mysqli_close($db);
for($i = 0;$i < $vndCount; $i++) {
	$vendors[$i] = mysqli_fetch_assoc($result);
}

$prevgrp = $group - 1;
$nextgrp = $group + 1;
if($prevgrp < 1) $prevgrp = 8;
if($prevgrp > 8) $prevgrp = 1;
if($nextgrp < 1) $nextgrp = 8;
if($nextgrp > 8) $nextgrp = 1;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Homeport: Group <?= $group ?> Vendors To Count</title>
	<link href="css/countList.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="text-align: center;">
	Homeport: Group <?= $group ?> Vendors To Count (<?= $vndCount ?>) <a href="index.php">Exit</a><br>
	<a href="countList.php?group=<?= $prevgrp ?>" ><<< Group <?= $prevgrp ?> >>></a> Cycle Starts: <?= $begDate ?> - Cycle Ends: <?= $endDate ?> <a href="countList.php?group=<?= $nextgrp ?>" ><<< Group <?= $nextgrp ?> >>></a>
</div>
	<table>
	<tr>
		<td><a href="countList.php?group=<?= $group ?>&sort=1">Vendor</a></td>
		<td>Count Printed</td>
		<td>Count Completed</td>
		<td><a href="countList.php?group=<?= $group ?>&sort=2">Responsible</a></td>
		<td>counter</td>
	</tr>		
	<?php for($i = 0; $i <$vndCount; $i++) { ?>
	<tr>
		<td><a href="items.php?vendor_ID=<?= $vendors[$i]['vendor_ID'] ?>" ><?= $vendors[$i]['vendor_name'] ?></a></td>
		<?php
			$style = "style=\"background-color: #FF5A52;\"";
			if($vendors[$i]['vendor_printCount'] >= $begDate && $vendors[$i]['vendor_printCount'] <= $endDate) $style = "style=\"background-color: #99FF94;\"";
		?>
		<td <?= $style ?>><?= $vendors[$i]['vendor_printCount'] ?></td>
		<?php
			$style = "style=\"background-color: #FF5A52;\"";
			if($vendors[$i]['vendor_lastCount'] >= $begDate && $vendors[$i]['vendor_lastCount'] <= $endDate) $style = "style=\"background-color: #99FF94;\"";
		?>
		<td <?= $style ?>><?= $vendors[$i]['vendor_lastCount'] ?></td>
		<td><?= $vendors[$i]['vendor_counter'] ?></td>
		<td title="<?= $vendors[$i]['vendor_preCounter'] ?>"><?= $vendors[$i]['vendor_curCounter'] ?></td>
	</tr>
	<?php } ?>
	</table>
	<table>
		<tr>
			<td><a href="countList.php?group=9" >Christmas</a></td><td><a href="countList.php?group=10" >Christmas Cards</a></td><td><a href="countList.php?group=11" >Ad-Hoc Counts</a></td>	
		</tr>
	</table>	
	  
</body>
</html>