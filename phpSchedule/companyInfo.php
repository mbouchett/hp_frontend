<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];

//Load Company Info Into Array
$fp = fopen($rootLoc.'data/companyInfo.txt', "r");
    // get the Company records and store them in the users array
     $i=0;
       while (!feof($fp)) {
          $item= fgets($fp);
          $users[$i] =$item;
          $i++;
       }
fclose($fp);         		//close the Company file
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="524.ico">
<title>Company Info</title>
</head>
<body>
<?php include($rootLoc.'header.php')?>
<br />
<center><big><big><b>Company Info</b></big></big></center>
<br />
<form action="<?=$rootLoc?>companyUpdate.php" method="post">
<table align="center" border="4" bordercolor="#BE873B" width="500">
<tr>
  <td>Company Name</td><td><input type="text" name="users[0]" value="<?=$users[0]?>" size="60" ></td>
</tr>
<tr>
  <td>Company Logo Address</td><td><input type="text"  name="users[1]" value="<?=$users[1]?>" size="60"  ><br />
  <small><i>example: http://www.mydomain.com/images/smallcompanylogo.jpg</i></small>
  </td>
</tr>
<tr>
  <td>Company Email Address</td><td><input type="text"  name="users[2]" value="<?=$users[2]?>" size="60"  ></td>
</tr>
<tr><td colspan="2" align="center"><small><i>Fields May Be Left Blank</i></small></td></tr>
<tr><td align="center" colspan="2" ><input type="submit" value="Save Changes" /></td></tr>
<?php
if($message)
    echo '<tr><td align="center" colspan="8"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
</table>
</form>
<br />
<table align="center" border="4" bordercolor="#BE873B">
<tr><td>
<input value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
<input value="Log Out" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
</td></tr>
</table>
</body>
</html>
