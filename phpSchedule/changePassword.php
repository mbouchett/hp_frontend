<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
<link rel="SHORTCUT ICON" href="524.ico">
<title>Change Login</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
<br />
<center>Change Login</center>
<form action="<?=$rootLoc?>savePassword.php" method="post">
<table border="0" bordercolor="#808000" align="center" width="500">
	<tr>
    	<td></td>
        <td>Login</td>
        <td>Type Again</td>
	</tr>
	<tr>
    	<td>New Administrator Login</td>
        <td><input type="password" name="ap" /></td>
        <td><input type="password" name="vap" /></td>
	</tr>
	<tr>
    	<td>New User Login</td>
        <td><input type="password" name="up" /></td>
        <td><input type="password" name="vup" /></td>
	</tr>
	<tr>
    	<td colspan="3" align="center" bgcolor="#BDBDBD"><i>Leave Blank To Leave Login Unchanged</i></td>
	</tr>
	<tr>
    	<td colspan="3" align="center" ><input type="submit" value="Save Changes" />
        <input type=button value="Cancel" onClick="history.go(-1)"> <!-- Go Back One Page -->
</td>
	</tr>
</table>
</form>
</body>
</html>
<?php
if($message) echo '<div align="center" style="font-size: 18px; color: #FF0000" >'.$message.'</div>'."\n";
?>

