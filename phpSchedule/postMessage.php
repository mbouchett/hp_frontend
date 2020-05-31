<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];
$chkStat=$_REQUEST['chkStat'];

//Load Employees Into Array
$fp = fopen($rootLoc.'data/employees.txt', "r");
    // get the employee records and store them in the users array
     $i=0;
       while (!feof($fp)) {
          $item= fgetcsv($fp, ",");
          $users[$i] =array($item[1],$item[0],$item[2],$item[3],$item[4],$item[5],$item[6]);
		  if($users[$i][3] && !$chkStat) $users[$i][6]='checked="checked"'; // activate if email address is present
          $i++;
       }
fclose($fp);         		//close the employee file
sort($users);    			//Sort the records on Username
$empCount=count($users); 	//How many people in the list
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="524.ico">
<title>Post Message</title>
</head>
<body>
<?php include($rootLoc.'header.php')?>
<br />

<center><big><big><b>Post Message</b></big></big></center>
<br />
<form action="<?=$rootLoc?>sendMessage.php" method="POST" enctype="multipart/form-data">

<table align="center" border="4" bordercolor="#BE873B">
  <tr><td>Message Subject</td><td colspan="2"><input name="subject" type="text" size="40" /></td></tr>
  <tr><td>Return Address</td><td colspan="2"><input name="compAddr" type="text" size="40" value="<?=$compInfo[2]?>"/></td></tr>
  <tr><td align="center" colspan="3"><textarea name="story" cols="60" rows="10"></textarea></td></tr>
  <tr><td>Name</td><td>Email Address</td><td>Email</td></tr>
<?php   for($i=0; $i<$empCount; $i++){
            if($users[$i][3]){
?>
  <tr>
    <td><?=$users[$i][1]?> <?=$users[$i][0]?></td>
    <td><input type="text" name="users[<?=$i?>][0]" value="<?=$users[$i][3]?>"  size="50"></td> <!-- Email Address -->
    <td><input type="checkbox" name="users[<?=$i?>][1]" <?=$users[$i][6]?> ></td> <!-- Selected -->
    <input type="hidden" name="users[<?=$i?>][2]" value="<?=$users[$i][0]?>" /> <!-- Frist Name -->
    <input type="hidden" name="users[<?=$i?>][3]" value="<?=$users[$i][1]?>" /> <!-- Last Name -->
  </tr>
<?php } } ?>
<tr><td align="center" colspan="2"><input type="submit" value="Send Message" /></td>
<?php if($chkStat){ ?>
    <td><input value="[x]" onclick="parent.location='<?=$rootLoc?>postMessage.php'" type="button"></td>
<?php }  ?>
<?php if(!$chkStat){ ?>
    <td><input value="[&nbsp;&nbsp;]" onclick="parent.location='<?=$rootLoc?>postMessage.php?chkStat=unchecked'" type="button"></td>
<?php }  ?>
</tr>
<?php
if($message)
    echo '<tr><td align="center" colspan="8"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
</table>
</form>
<br />
<table align="center" border="4" bordercolor="#BE873B">
<tr><td align="center">
<input value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
<input value="Log Out" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
</td></tr>
</table>
</body>
</html>
