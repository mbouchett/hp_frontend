<?php
//selectRegToEdit.php 2018/06
// Vendor Catalog Edit Workspace
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }


$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` ORDER BY `reg_event_date` DESC ';
$result = mysqli_query($db, $sql);
$regCount=mysqli_num_rows($result);
mysqli_close($db);
for($i=0; $i<$regCount; $i++){
	$reg[$i] = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Homeport Registry Item Editor</title>
	<style type="text/css">
		td{
			border: solid thin black;
			padding: 3px;
		}
		a{cursor: pointer;}
	</style>
</head>
<body>
<br />
<h2>Homeport Registry Item Editor</h2>
<button onclick="parent.location='index.php'">Registry Dashboard</button>
<br />
<table>
  <tr><td><h3>Couple</h3></td><td><h3>Big Day</h3></td></tr>
  <?php for($i = 0; $i < $regCount; $i++){
      $day=substr($reg[$i]['reg_event_date'],-2);
      $month=substr($reg[$i]['reg_event_date'],5,2);
      $year=substr($reg[$i]['reg_event_date'],0,4);
  ?>
	<tr>
		<td align="center">
  			<a href="editRegItems.php?regnum=<?=stripslashes($reg[$i]['reg_ID'])?>">
  				<?=stripslashes($reg[$i]['reg_partner1F'])?> <?=stripslashes($reg[$i]['reg_partner1L'])?> & <?=stripslashes($reg[$i]['reg_partner2F'])?> 
  				<?=stripslashes($reg[$i]['reg_partner2L'])?>
  			</a>
  		</td>
  		<td>
  			<?=$month?>/<?=$day?>/<?=$year?>
  		</td>
  	</tr>
<?php } ?>
</table>
 <br />
<button onclick="parent.location='index.php'">Registry Dashboard</button>
<br />
</body>
</html>