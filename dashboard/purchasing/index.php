<?php
	//index.php 2018/01
	// dashboard
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

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="../css/dashboard.css" type="text/css" />
<meta charset="utf-8" />
<title>Homeport Purchasing - <?= $_SESSION['username']?> </title>

</head>
<body>
    <img alt="Homeport Logo" src="../../images/hp_compass.png">
    <br>
	<span class="largetext"> Purchasing - <?= $_SESSION['username']?></span><br>
    <div class="menu">
        <table>
    		<tr>
    			<td><a class="menubtn" href="vendorSelect.php?direction=Work"><i class="fa fa-list-alt"></i> Items</a></td>
    			<td><a class="menubtn" href="vendorSelect.php?direction=Edit"><i class="fa fa-edit"></i> Edit Vendor</a></td>
    		</tr>
    		<tr>
    			<td><a class="menubtn" href="orders/sentOrders.php"><i class="fa fa-eye"></i> View Orders</a></td>
    			<td><a class="menubtn" href="vendors/addVendor.php"><i class="fa fa-plus-square"></i> Add Vendor</a></td>
    		</tr>
    		<tr>
    			<td><a class="menubtn" href="trustedReps.php"><i class="fa fa-thumbs-o-up"></i> Trusted Reps</a></td>
    			<td><a class="menubtn" href="../"><i class="fa fa-reply"></i> Exit</a></td>
    		</tr>
    	</table>
   </div>
   <br>
	<div class="menu">
		<a class="menubtn" href="countList.php?group=<?= getWeek() ?>" ><i class="fa fa-list-ol"></i> Now Counting Group: <?= getWeek() ?></a>
   </div>
</body>
</html>
