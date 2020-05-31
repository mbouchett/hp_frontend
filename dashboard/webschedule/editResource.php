<?php
//editResource.php 2018/01
// Resource Edit Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

//get user variables
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];
if($userlevel<5){
    echo "What are you doing here?";
    die;
}
$order = $_REQUEST['order'];

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `resource` ORDER BY `resource_lastDay` ,`resource_num`";
if($order == "ln") $sql = "SELECT * FROM `resource` ORDER BY `resource_lastDay` , `resource_lastName`";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Load Users Failed<br>";
	echo mysqli_error($db);
	die;
}
$num_results=mysqli_num_rows($result);
mysqli_close($db); //close the connection

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
    $resource[$i]=mysqli_fetch_assoc($result);
}

// get status Message
unset($message);
$message=$_REQUEST['message'];

?>
<!DOCTYPE HTML>
<html>
	<head>
    	<title>Edit Resources (a)</title>
    	<link rel="stylesheet" href="css/scheduleDash.css" type="text/css" />
	</head>
  <body onload="loadPage()">
  <div id="banner">
  <a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a>
  </div>
  <br><br>
   <span class="dashtitle2">Employee List:</span><br> Show All Fields <input id="checkNode" name="showfields" type="checkbox" onclick="hide()">
   <br> <span class="dashtitlegreen"><?php if($message) { ?>
         *<?= $message    ?>*
    <?php }              ?></span><br>
    <form action="processEditResource.php" name="processEditResource" method="post">
    <a class="dashbut"  onClick="document.processEditResource.submit()"><span class="icontext">&#128190;&nbsp;</span>Save Changes</a>
      <a class="dashbut" href="scheduleDash.php"><span class="icontext">&#128281;&nbsp;</span>Return</a>
    <div  class="employeelist">
    <table>
            <tr class="dashtitlesmall">
                <td>Card</td>
                <td><a href="editResource.php">E#</a></td>
                <td>First Name</td>
                <td><a href="editResource.php?order=ln">Last Name</a></td>
                <td>Username</td>
                <td>Phone</td>
                <td>Email</td>
                <td>First Day</td>
                <td>Last Day</td>
                <td>Level</td>
                <td>Comm</td>
                <td>Reset PW</td>
                <td class="hide">Last Raise</td>
                <td class="hide">Hourly</td>
                <td class="hide">Salary</td>
            </tr>
            <?php
            for($i=0; $i < $num_results; $i++) {
                unset($bgColor);
                if($resource[$i]['resource_lastDay']) $bgColor = 'style="background-color: #ABABAB"';
                $check = "";
                if($resource[$i]['resource_com'] == 1) $check = "checked";
            ?>
            <tr>
                <td <?= $bgColor ?>><?= $resource[$i]['resource_ID'] ?><input type="hidden" name="recno[<?= $i ?>]" value="<?= $resource[$i]['resource_ID'] ?>"/></td>
                <td <?= $bgColor ?>><input type="text" name="employeeNumber[<?= $i ?>]" value="<?= $resource[$i]['resource_num'] ?>"  size="2" /></td>
                <td <?= $bgColor ?>><input type="text" name="firstName[<?= $i ?>]" value="<?= $resource[$i]['resource_firstName'] ?>" size="10" /></td>
                <td <?= $bgColor ?>><input type="text" name="lastName[<?= $i ?>]" value="<?= $resource[$i]['resource_lastName'] ?>" size="12" /></td>
                <td <?= $bgColor ?>><input type="text" name="userName[<?= $i ?>]" value="<?= $resource[$i]['resource_userName'] ?>" size="12" /></td>
                <td <?= $bgColor ?>><input type="text" name="phone[<?= $i ?>]" value="<?= $resource[$i]['resource_phone'] ?>" size="12" /></td>
                <td <?= $bgColor ?>><input type="text" name="email[<?= $i ?>]" value="<?= $resource[$i]['resource_email'] ?>" size="40" /></td>
                <td <?= $bgColor ?>><input type="text" name="hired[<?= $i ?>]" value="<?= $resource[$i]['resource_firstDay'] ?>" size="10" /></td>
                <td <?= $bgColor ?>><input type="text" name="lastDay[<?= $i ?>]" value="<?= $resource[$i]['resource_lastDay'] ?>" size="10" /></td>
                <td <?= $bgColor ?>><input type="text" name="level[<?= $i ?>]" value="<?= $resource[$i]['resource_level'] ?>"  size="2" /></td>
                <td <?= $bgColor ?>><input name="com[<?= $i ?>]" type="checkbox" <?= $check ?>></td>
                <td <?= $bgColor ?>><input name="resetPW[<?= $i ?>]" type="checkbox" ></td>
                <td class="hide" style="border-collapse: collapse; margin: 0;"><input type="text" name="adjustedPay[<?= $i ?>]" value="<?= $resource[$i]['resource_payChange'] ?>" size="10" /></td>
                <td class="hide" style="border-collapse: collapse; margin: 0;">
                    <input type="text" name="hourlyRate[<?= $i ?>]" value="<?= $resource[$i]['resource_hourly'] ?>" size="3" />
                    <input type="hidden" name="oldRate[<?= $i ?>]" value="<?= $resource[$i]['resource_hourly'] ?>">
                </td>
                <td class="hide" style="border-collapse: collapse; margin: 0;"><input type="text" name="salary[<?= $i ?>]" value="<?= $resource[$i]['resource_salary'] ?>" size="4" /></td>
            </tr>
            <?php } ?>
        </table>
        </div>
        <br>
      <a class="dashbut"  onClick="document.processEditResource.submit()"><span class="icontext">&#128190;&nbsp;</span>Save Changes</a>
      <a class="dashbut" href="scheduleDash.php"><span class="icontext">&#128281;&nbsp;</span>Return</a>
      <div class="hiddenstuff">
      <input type="submit" />
      </div>
    </form>


  <script defer="defer" type="text/javascript" src="js/editResource.js"></script>
  </body>

</html>