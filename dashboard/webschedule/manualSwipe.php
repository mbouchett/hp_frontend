<?php
//manualSwipe.php 2018/01
// Main Customer Service Interface
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
if($userlevel<5){
    echo "What are you doing here?";
    die;
}

//Open The Database and get the user info
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `resource_ID`, `resource_firstName`, `resource_lastName` 
		  FROM `resource` 
		  WHERE `resource_lastDay` IS NULL AND `resource_hourly` > 0 
		  ORDER BY `resource_lastName`";
$result = mysqli_query($db, $sql); // create the query object
$resourceCount=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$resourceCount; $i++){               //Iniate The Loop
    $resource[$i]=mysqli_fetch_assoc($result);     //Fetch & Store The Current Record
}
//set all the wibbley, wobbley, timey, wimey stuff
date_default_timezone_set('EDT');// ste the default time zone
$hour = date("g");
$min = date("i");
$ap = date("a");
$year = date("Y");
$month = date("m");
$day = date("d");

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="SHORTCUT ICON" href="images/schedule.ico">
  <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
  <title>Manual Time Clock</title>
</head>

<body>
<div id="banner">
	<a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a>
</div>
<br>
<br>
   <div class="dashtitle">Time Clock</div>
<br>


<form name="punch" action="processManualSwipe.php" method="post">
<div class="loginbox">
   <table>
        <tr><td>Hour</td><td>Min</td><td>a/p</td><td>yyyy</td><td>mm</td><td>dd</td></tr>
        <tr>
            <td><input onblur="return hourBlur(this)" name="hour" value="<?= $hour ?>" size="1"  maxlength="2"/></td>
            <td><input onblur="return minBlur(this)" name="min" value="<?= $min ?>" size="1"  maxlength="2"/></td>
            <td><input onblur="return apBlur(this)" name="ap" value="<?= $ap ?>" size="1" maxlength="2" /></td>
            <td><input onblur="return yearBlur(this)" id="year" name="year" value="<?= $year ?>" size="2" /></td>
            <td><input onblur="return monthBlur(this)" id="month" name="month" value="<?= $month ?>" size="1" /></td>
            <td><input onblur="return dayBlur(this)" name="day" value="<?= $day ?>" size="1" /></td>
            <td>
              <select name="card" size="1">
                <?php for($i=0; $i<$resourceCount; $i++){ ?>
                <option value="<?= $resource[$i]['resource_ID'] ?>"><?= $resource[$i]['resource_lastName'] ?>, <?= $resource[$i]['resource_firstName'] ?></option>
                <?php } ?>
              </select>
            </td>

        </tr>
</table>
<br />

</div>
<br />
<a class="dashbut" onClick="document.punch.submit()"><span class="icontext">&#10003;&nbsp;</span>Punch the Clock</a>

<a href="scheduleDash.php" class="dashbut"><span class="icontext">&#128281;&nbsp;</span>Forget It</a>
</form>

    <script defer="defer" type="text/javascript" src="js/manualSwipe.js"></script>
</body>

</html>