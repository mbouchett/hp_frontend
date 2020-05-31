<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="../webfonts/fonts.css" type="text/css">
<title>Schedule Login</title>
</head>
<body>
<?php include('../phpSchedule/header.php')?>
<br />
<form action="../phpSchedule/login.php" method="post">
<table align="center" border="4" bordercolor="#808000">
	<tr>
    	<td align="center">
        Enter Login
    	</td>
	</tr>
    <tr>
    	<td align="center">
   		    <input class="btn" type="hidden" name="rootLoc" value="../phpSchedule/">
            <input class="btn" name="password" type="password"/><br />
    	</td>
	</tr>
    <tr>
        <td align="center"><input class="btn" type="submit" name="" value="Login" /></td>
    </tr>
</table>
</form>
</body>
</html>
