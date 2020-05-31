<?php
//phoneList.php 2018/01
// Print a list of employee phone numbers
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
//get user variables
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `resource_firstName`, `resource_lastName`, `resource_phone` 
		  FROM `resource` 
		  WHERE `resource_lastDay` IS NULL ORDER BY `resource_lastName`";
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){               //Iniate The Loop
    $resource[$i]=mysqli_fetch_assoc($result);     //Fetch & Store The Current Record
}

// get status Message
unset($message);
$message=$_REQUEST['message'];

?>
<!DOCTYPE HTML>

<html>

  <head>
    <title>Phone List (a)</title>
    <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
    <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
  </head>

  <body >
  <br><br>
  <div class="plaincontainer">
        <table class="listtable">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
            </tr>
            <?php for($i=0; $i < $num_results; $i++) { ?>
            <tr>
                <td class="printwide"><?= $resource[$i]['resource_firstName'] ?></td>
                <td class="printwide"><?= $resource[$i]['resource_lastName'] ?></td>
                <td class="printwide"><?= $resource[$i]['resource_phone'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <br>
        <a class="dashbut" href="scheduleDash.php"><span class="icontext">&#128281;&nbsp;</span>Return</a>
  </body>

</html>