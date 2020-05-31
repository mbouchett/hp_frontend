<?php
//index.php 2018/01
// webschedule login
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

// get message if login no good
unset($message);
@$message=$_REQUEST['message'];

?>
<!DOCTYPE html>

<html>
  <head>
    <link rel="SHORTCUT ICON" href="images/schedule.ico">
    <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
    <title>Web Schedule Login</title>
  </head>
  <body>
<div id="banner">
  <a href="../../index.php"><img alt="Homeport Logo" src="../../images/compass_white.png" /></a>
</div>
<br><br>


    <div id="title"><span class="dashtitle">Web Schedule Login</span></div>
   <br />
<form name="scheduleLogin" action="processLogin.php" method="post">
    <div class="loginbox">
    <table>
        <tbody>
        <tr>
        <td><h3>User Name </h3></td>
        <td><input id="start" name="username" type="text"><br /></td>
        </tr>
        <tr>
            <td><h3>Password </h3></td>
            <td><input value="" id="pw" name="pw" type="password" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><a class="dashbut"  onClick="document.scheduleLogin.submit()" name=""><span class="icontext">&#128273;&nbsp;</span>Login</a></td>
        </tr>


        </tbody>
    </table>
  </div>
<div class="hiddenstuff">
<input type="submit" />
</div>
</form>
<?php if($message){?>
    <table align="center" border="1" style="border-color: #FFFFFF">
        <tr><td><div style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
    </table>
<?php  }?>
    <script defer="defer" type="text/javascript" src="js/schedule.js"></script>
  </body>
</html>
