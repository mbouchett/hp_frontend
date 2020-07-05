<?php
	//dashboard.php 2018/01
	// dashboard
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Homeport Dashboard - <?= $_SESSION['username']?> - <?= $_SESSION['userlevel'] ?></title>
<link rel="stylesheet" href="../webfonts/fonts.css" type="text/css" /> 
<link rel="stylesheet" href="../icons/all.css" type="text/css">

<link rel="stylesheet" href="css/dashboard.css" type="text/css" />

</head>
<body>
    <img alt="Homeport Logo" src="../images/hp_compass.png">
    <br>
	<span class="largetext"> Dashboard - <?= $_SESSION['username']?></span><br>
    <div class="menu">
    	<table>
            <tr>
              <td colspan="3"><a class="flagbtn" href="fillList.php"><i class="fa fa-box-open"></i> FILL</a></td>  
            </tr>
    		<tr>
    			<td><a class="menubtn" href="../signs"><i class="fa fa-object-group"></i> Signs</a></td>
    			<td><a class="menubtn" href="../phpSchedule/viewSchedule.php"><i class="fa fa-calendar"></i> Time Schedules</a></td>
    			<td><a class="menubtn" href="webschedule"><i class="fa fa-clock"></i> Time Clock</a></td>
    		</tr>
    		<tr>
    			<td><a class="menubtn" href="registry/"><i class="fa fa-gift"></i> Registry</a></td>
    			<td><a class="menubtn" href="cs/whPickup.php" ><i class="fa fa-car"></i> Schedule Pickup</a></td>
                <td><a class="menubtn" href="giftcard/swipe.php"><i class="fa fa-credit-card"></i> Gift Card Transaction</a></td>
    		</tr>
    		<tr>
    			<td><a class="menubtn" href="cs/"><i class="fa fa-handshake"></i> Customer Service</a></td>
    			<td><a class="menubtn" href="purchasing/"><i class="fa fa-shopping-basket"></i> Purchasing</a></td>
    			<td><a class="menubtn" href="frontend/"><i class="fa fa-shopping-basket"></i> Edit Front End</a></td>
    		</tr>
    		<tr>
    			<td><a class="menubtn" href="phonesale/phoneSale.php"><i class="fa fa-phone"></i> Phone Sale Form</a></td>
    			<td><a class="menubtn" href="depts/depts.php"><i class="fa fa-map-signs"></i> Departments</a></td>
            <td><a class="menubtn" href="giftcard/gcDash.php"><i class="fa fa-list-alt"></i> Gift Card Reports</a></td>
    		</tr>
    		<tr>
    			<td><a class="menubtn" href="warehouse/searchInventory.php"><i class="fa fa-truck"></i> Warehouse Inventory</a></td>
    			<td><a class="menubtn" href="warehouse/whDash.php"><i class="fa fa-truck"></i> Warehouse Admin <i class="fa fa-gear"></i></a></td>
    			<td><a class="menubtn" href="warehouse/rec.php"><i class="fa fa-th-list"></i> Receiving Log</a></td>
    		</tr>
    		<?php if($_SESSION['userlevel'] > 2) { ?>
    		<tr>
    			<td></td>
            	<td><a class="menubtn" href="otb/"><i class="fa fa-dollar-sign"></i> Open To Buy<i class="fa fa-gear"></i></a></td>
    			<td></td>
    		</tr>    		
    		<?php } ?>
    		<?php if($_SESSION['userlevel'] > 3 || $_SESSION['username'] == "delliott" ) { ?>
    		<tr>
    			<td><a class="menubtn" href="webcust/index.php"><i class="fa fa-shopping-basket"></i> View Customer Orders<i class="fa fa-gear"></i></a></td>
            	<td><a class="menubtn" href="#"><i class="fa fa-calendar"></i> Time Schedule Admin<i class="fa fa-gear"></i></a></td>
    			<td></td>
    		</tr>
    		<tr>
    			<td></td>
            	<td></td>
    			<td></td>
    		</tr>
    		<?php } ?>

    		<?php if($_SESSION['userlevel'] > 5 ) { ?>
    		<tr>
    			<td><a class="menubtn" href="util/removeHist.php"><i class="fa fa-bomb"></i> Match Hist->Items<i class="fa fa-gear"></i></a></td>
            	<td><a class="menubtn" href="util/removePics.php"><i class="fa fa-picture-o"></i> Remove Orphaned Images<i class="fa fa-gear"></i></a></td>
    			<td></td>
    		</tr>
    		<tr>
    			<td></td>
            	<td></td>
    			<td></td>
    		</tr>
    		<?php } ?>    		
 
            <tr>
                <td></td>
                <td><a class="menubtn" href="processLogout.php"><i class="fa fa-sign-out"></i> Log Out</a></td>
                <td></td>
            </tr>

    	</table>
    </div>
</body>
</html>
