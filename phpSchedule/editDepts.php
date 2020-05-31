<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];

//Load Departments Into Array
$fp = fopen($rootLoc.'data/departments.txt', "r");
    // get the department records and store them in the depts array
     $i=0;
       while (!feof($fp)) {
          $item= fgetcsv($fp, ",");
          $depts[$i] =array($item[0],$item[1]);
          $i++;
       }
fclose($fp);         		//close the department file
sort($depts);    			//Sort the records on department name
$deptCount=count($depts); 	//How many departments in the list
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="524.ico">
<title>Edit Departments</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
<br />

<center><big><big><b>Edit Departments</b></big></big></center>
<br />
<form action="<?=$rootLoc?>deptUpdate.php" method="post">
<table align="center" border="4" bordercolor="#BE873B">
<tr><td>Department</td><td>Color#</td><td>Color</td><td>Remove</td></tr>
<?php   for($i=0; $i<$deptCount; $i++){  ?>
<tr>
  <td><input type="text" name="depts[<?=$i?>][0]" value="<?=$depts[$i][0]?>" ></td>
  <td><input type="text" name="depts[<?=$i?>][1]" value="<?=$depts[$i][1]?>" ></td>
  <td width="15" bgcolor="#<?=$depts[$i][1]?>"></td>
  <td><input type="checkbox" name="deleteMe[<?=$i?>]" ></td>
</tr>
<?php } ?>
<tr><td colspan="4"><small><small>Try and keep depatrment labels to 3 chrs</small></small></td></tr>
<tr><td align="center" colspan="4"><input type="submit" value="Save Changes" /></td></tr>
<?php
if($message)
    echo '<tr><td align="center" colspan="4"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
</table>
</form>

<br />
<form action="<?=$rootLoc?>deptUpdate.php" method="post">
<table align="center" border="4" bordercolor="#BE873B">
<?php   for($i=0; $i<$deptCount; $i++){  ?>
  <input type="hidden" name="depts[<?=$i?>][0]" value="<?=$depts[$i][0]?>" >
  <input type="hidden" name="depts[<?=$i?>][1]" value="<?=$depts[$i][1]?>" >
<?php } ?>
  <input type="hidden" name="depts[<?=$i+1?>][0]" value="" >
  <input type="hidden" name="depts[<?=$i+1?>][1]" value="" >
<tr><td align="center"><input type="submit" value="Add Department" />
<input value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
<input value="Log Out" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
</td></tr>
</table>
</form>
<br />
<table align="center" border="4" bordercolor="#BE873B">
<tr><td bgcolor="#FF0000">#FF0000</td><td bgcolor="#00FFFF">#00FFFF</td><td bgcolor="#0000FF">#0000FF</td><td bgcolor="#FF0080">#FF0080</td><td bgcolor="#FFFF00">#FFFF00</td><td bgcolor="#00FF00">#00FF00</td></tr>
<tr><td bgcolor="#FF00FF">#FF00FF</td><td bgcolor="#FFFFFF">#FFFFFF</td><td bgcolor="#C0C0C0">#C0C0C0</td><td bgcolor="#FF8040">#FF8040</td><td bgcolor="#808000">#808000</td><td bgcolor="#408080">#408080</td></tr>
<tr><td bgcolor="#F778A1">#F778A1</td><td bgcolor="#C38EC7">#C38EC7</td><td bgcolor="#C2DFFF">#C2DFFF</td><td bgcolor="#348781">#348781</td><td bgcolor="#C3FDB8">#C3FDB8</td><td bgcolor="#FDD017">#FDD017</td></tr>
</table>
</body>
</html>
