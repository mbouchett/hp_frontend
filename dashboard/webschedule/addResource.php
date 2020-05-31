<?php
//addResource.php 2018/01
// Add an employee to the system
date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
// *** Verify Login ***
if(!isset($_SESSION['username'])){
  header('Location: index.php');
  exit;
}
//get user variables
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];
if($userlevel<5){
    echo "What are you doing here?";
    die;
}

// get status Message
unset($message);
$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="SHORTCUT ICON" href="images/schedule.ico">
    <link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
    <title>Add A Resource</title>
</head>

<body>
<div id="banner">
  <a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a>
</div>
<br><br>
   <span class="dashtitle">Add New Employee</span>
   <br><br>

   <form name="processAddResource" action="processAddResource.php"  method="post">
   <div class="loginbox">
   <table>
     <tr>
       <td>First Name* </td>
       <td><input type="text" name="fName" /></td>
     </tr>
     <tr>
       <td>Last Name* </td>
       <td><input type="text" name="lName" /></td>
     </tr>
     <tr>
       <td>User Name* </td>
       <td><input type="text" name="uName" /></td>
     </tr>
     <tr>
       <td>Phone* </td>
       <td><input type="text" name="phone" /></td>
     </tr>
     <tr>
       <td>Email* </td>
       <td><input type="text" name="email" /></td>
     </tr>
     <tr>
       <td>Rate Of Pay*</td>
       <td><input type="text" name="rate" /></td>
     </tr>
     <tr>
       <td>First Day(yyyy-mm-dd)*</td>
       <td><input type="text" name="firstDay" value="<?= date('Y-m-d') ?>" /></td>
     </tr>
     </table>




   </div>
   <br>
   <a class="dashbut"  onClick="document.processAddResource.submit()" name=""><span class="icontext">&#59136;&nbsp;</span>Add Employee</a>
<a class="dashbut" onclick="history.go(-1)" ><span class="icontext">&#128281;&nbsp;</span>Return to Menu</a>
    <div class="hiddenstuff">
    <input type="submit" />
    </div>
    </form>

     <!-- keep outside form -->
<?php if($message){?>
    <div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div>
<?php  }?>
</body>

</html>