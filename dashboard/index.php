<?php
//index.php 2018/01
// dashboard login
date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  if(isset($_SESSION['username'])){
    header('Location: dashboard.php');
    die;
  }
  
@$message = $_REQUEST['message'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="SHORTCUT ICON" href="images/dash.ico">
  	<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<title>Homeport Dashboard Login</title>

<script type="text/javascript">
function setFocus()
{
     document.getElementById("start").focus();
}

</script>
</head>

<body onload="setFocus()">
<form name="scheduleLogin" action="processLogin.php" method="post">
<?php if($message){?>
      <div class="badlogin">
        <td><?=$message?></td>
      </div>
<?php  }?>
<img alt="Homeport Logo" src="../images/hp_compass.png">
<br>
<div class="largetext">Homeport Dashboard</div>
    <table>
        <tbody>
	        <tr>
	        <td><h2>User Name: </h2></td>
	        <td><input class="inputsauce" id="start" name="username" type="text"><br /></td>
	        </tr>
	        <tr>
	            <td><h2>Password: </h2></td>
	            <td><input id="pw" name="pw" type="password" /></td>
	        </tr>
        </tbody>
    </table>
    <br>
    <button class="logbtn"  onClick="document.scheduleLogin.submit()" name=""><i class="fa fa-unlock-alt"></i> Login</button>
<div class="hiddenstuff"> <input type="submit" /> </div>
</form>

</body>
</html>

