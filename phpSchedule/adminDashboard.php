<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$bgColor="#555555";  //Background Color For the table cells
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="../webfonts/fonts.css" type="text/css">
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Schedule Administrator Dashboard</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
<br />
<center><big><b>Schedule Administrator Dashboard</b></big>
<br /><br />
<table align="center" width="600" border="4" bordercolor="#BE873B" cellpadding="8">
	<tr>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;&nbsp;Add A New Schedule&nbsp" onclick="parent.location='<?=$rootLoc?>addSchedule.php'" type="button"></td>
        <td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit A Schedule&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='<?=$rootLoc?>editSchedule.php'" type="button"></td>
       	<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;Delete Old Schedule&nbsp;" onclick="parent.location='<?=$rootLoc?>deleteSchedule.php'" type="button"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="Add or Remove Depts" onclick="parent.location='<?=$rootLoc?>editDepts.php'" type="button"></td>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Post A Message&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='<?=$rootLoc?>postMessage.php'" type="button"></td>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn"value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Employee Info&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='<?=$rootLoc?>employeeInfo.php'" type="button"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change Logins&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='<?=$rootLoc?>changePassword.php'" type="button"></td>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Info&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='<?=$rootLoc?>companyInfo.php'" type="button" ></td>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log Out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
        </td>
	</tr>
    <tr>
    	<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Post A Job&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='<?=$rootLoc?>postJob.php'" type="button"></td>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="Re-Name A Schedule" onclick="parent.location='<?=$rootLoc?>renameSchedule.php'" type="button"></td>
		<td align="center" bgcolor="<?=$bgColor?>"><input class="btn" value="&nbsp;&nbsp;&nbsp;View Applications&nbsp;&nbsp;&nbsp;" onclick="parent.location='<?=$rootLoc?>reviewApps.php'" type="button"></td>
    </tr>
</table>
</center>
</body>
</html>
