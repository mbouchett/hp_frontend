<?php
//punchComment.php 2018/01
// Handles a timeclock punch
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');// set the default time zone

// get the punch record number
$punch_ID = $_REQUEST['punch_ID'];

//if the page is called without a record number then kill page
if(!$punch_ID) die;
//if the variable is not a number number then kill page
if(!is_numeric($punch_ID)) die;

// Get the punch
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `rawPunch` WHERE `punch_ID` = '.$punch_ID ;
$result = mysqli_query($db, $sql);          //Initiate The Query
mysqli_close($db);                          //Close The Connection
//Store the Result To $punch
$punch=mysqli_fetch_assoc($result);       //Fetch The Current Record

// Get The User Info
$db= new mysqli('localhost', $db_user, $db_pw, $db_db); 
$sql = 'SELECT `resource_firstName`,`resource_lastName` FROM `resource` WHERE `resource_ID`='.$punch['resource_ID'] ;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Get User Info Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); 
//Store the Result To $punch
$resource=mysqli_fetch_assoc($result);

$theStamp = date("g:i a",strtotime($punch['punch_timeStamp']));
?>
<!DOCTYPE HTML>

<html>

<head>
    <meta http-equiv="refresh" content="30;url=timeClock.php">
    <title>Verify Punch And Add Comment</title>
    <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />

</head>
<body>
<div class="clockcontainer">
      <span class="dashtitle2"><?= $resource['resource_firstName'] ?> <?= $resource['resource_lastName'] ?></span><span class="dashtitle"><br>You Just Swiped At:</span><br /><br />
   </div>
   <br />
      <div class="clock">
      <span class="digitalvoid">&middot;&nbsp;</span><span class="digitaltext"><?= $theStamp ?></span><span class="digitalred">&nbsp;&middot;</span>
      </div>
      <br>
     <h3> <?= date("l - F j, Y", strtotime($punch['punch_timeStamp'])) ?></h3>
<br>
<div class="commentbox">
<form action="processPunchComment.php" name="processPunchComment" method="post">
<br>
<h3>Need to add a comment?</h3>
<br><input id="start" type="text" name="comment" value="<?= $punch['punch_comment'] ?>" />
<br><br>
<a class="dashbut" onClick="document.processPunchComment.submit()" name=""><span class="icontext">&#128319;&nbsp;</span>Submit &amp; Continue</a>
<div class="hiddenstuff">
<input type="submit" />
</div>
<input type="hidden" name="punch_ID" value="<?= $punch_ID ?>">
</form>
</div>
<script defer="defer" type="text/javascript" src="js/punch.js"></script>
</body>

</html>