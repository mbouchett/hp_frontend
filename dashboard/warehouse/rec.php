<?php
//rec.php 2018/05
// View and add to the warehouse receiving log
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `freightlog` ORDER BY `fLog_ID` DESC LIMIT 100' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="SHORTCUT ICON" href="../images/mail.ico">
  <title>Warehouse Receiving Log(<?= $num_results ?>)</title>
</head>
<body>
<br /><br />
<form action="processRec.php" method="post">
<table align="center" border="2">
  <tr>
    <td>Shipper</td>
    <td>Vendor</td>
    <td>Pieces</td>
    <td>Receiver</td>
    <td>Comment</td>
  </tr>
  <tr>
    <td><input name="shipper" /></td>
    <td><input name="vendor" /></td>
    <td><input name="pieces" size="5" /></td>
    <td><input name="receiver" size="5" /></td>
    <td><input name="comment" size="30" /></td>
  </tr>
  <tr>
    <td align="center" colspan="5"><input type="submit" value="Send" /></td>
  </tr>
</table>
<br /><br />
<?php if($message){?>
<table align="center" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>
 <br />
<table align="center" border="1">
    <tr style="font-weight: bold">
        <td width="50">Date</td>
        <td width="100">Shipper</td>
        <td width="100">Vendor</td>
        <td width="40"># Pcs</td>
        <td width="60">Receiver</td>
        <td width="300">Comment</td>
    </tr>
<?php for($i=0; $i<$num_results; $i++){
  $row=mysqli_fetch_assoc($result);
?>
    <tr>
        <td width="50"><?= $row['fLog_date'] ?></td>
        <td width="100"><?= $row['fLog_shipper'] ?></td>
        <td width="100"><?= $row['fLog_vendor'] ?></td>
        <td width="40"><?= $row['fLog_pieces'] ?></td>
        <td width="60"><?= $row['fLog_receiver'] ?></td>
        <td width="300"><?= $row['fLog_comment'] ?></td>
    </tr>
<?php } ?>
</table>

</body>
</form>
</html>