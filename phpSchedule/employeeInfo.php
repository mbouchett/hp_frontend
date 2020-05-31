<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];

//Load Employees Into Array
$fp = fopen($rootLoc.'data/employees.txt', "r");
    // get the employee records and store them in the users array
     $i=0;
       while (!feof($fp)) {
          $item= fgetcsv($fp, ",");
          $users[$i] =array($item[1],$item[0],$item[2],$item[3],$item[4],$item[5],$item[6]);
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
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="../webfonts/fonts.css" type="text/css">
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Employee Info</title>
</head>
<body>
<?php include($rootLoc.'header.php')?>
<br />

<center><big><big><b>Employee Info</b></big></big></center>
<br />
<form action="<?=$rootLoc?>employeeUpdate.php" method="post">
<table align="center" border="4" bordercolor="#BE873B">
<tr><td>First Name</td><td>Last Name</td><td>Telephone #</td><td>Emrg Contact #</td><td>Email Address</td><td>Ok To Call</td><td>Ok To Email</td><td>Remove</td></tr>
<?php   for($i=0; $i<$empCount; $i++){  ?>
<tr>
  <td><input type="text" name="users[<?=$i?>][1]" value="<?=$users[$i][1]?>" ></td>
  <td><input type="text" name="users[<?=$i?>][0]" value="<?=$users[$i][0]?>" ></td>
  <td><input type="text" name="users[<?=$i?>][2]" value="<?=$users[$i][2]?>" ></td>
  <td><input type="text" name="users[<?=$i?>][6]" value="<?=$users[$i][6]?>" ></td>
  <td><input type="text" name="users[<?=$i?>][3]" value="<?=$users[$i][3]?>" ></td>
  <td><input type="checkbox" name="users[<?=$i?>][4]" <?=$users[$i][4]?> ></td>
  <td><input type="checkbox" name="users[<?=$i?>][5]" <?=$users[$i][5]?> ></td>
  <td><input type="checkbox" name="deleteMe[<?=$i?>]" ></td>

</tr>
<?php } ?>
<tr><td align="center" colspan="8"><input class="btn" type="submit" value="Save Changes" /></td></tr>
<?php
if($message)
    echo '<tr><td align="center" colspan="8"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
</table>
</form>
<br />
<form action="<?=$rootLoc?>employeeUpdate.php" method="post">
<table align="center" border="4" bordercolor="#BE873B">
<?php   for($i=0; $i<$empCount; $i++){  ?>
  <input type="hidden" name="users[<?=$i?>][1]" value="<?=$users[$i][1]?>" >
  <input type="hidden" name="users[<?=$i?>][0]" value="<?=$users[$i][0]?>" >
  <input type="hidden" name="users[<?=$i?>][2]" value="<?=$users[$i][2]?>" >
  <input type="hidden" name="users[<?=$i?>][3]" value="<?=$users[$i][3]?>" >
  <input type="hidden" name="users[<?=$i?>][4]" value="<?=$users[$i][4]?>" >
  <input type="hidden" name="users[<?=$i?>][5]" value="<?=$users[$i][5]?>" >
  <input type="hidden" name="users[<?=$i?>][6]" value="<?=$users[$i][6]?>" >
<?php } ?>
  <input type="hidden" name="users[<?=$i+1?>][1]" value="" >
  <input type="hidden" name="users[<?=$i+1?>][0]" value="" >
  <input type="hidden" name="users[<?=$i+1?>][2]" value="" >
  <input type="hidden" name="users[<?=$i+1?>][3]" value="" >
  <input type="hidden" name="users[<?=$i+1?>][4]" unchecked >
  <input type="hidden" name="users[<?=$i+1?>][5]" unchecked >
  <input type="hidden" name="users[<?=$i+1?>][6]" value="" >
<tr><td align="center"><input class="btn" type="submit" value="Add User" />
<input class="btn" value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
<input class="btn" value="Log Out" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
</td></tr>
</table>
</form>
</body>
</html>
