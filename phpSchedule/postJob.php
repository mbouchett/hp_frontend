<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];

//Load Jobs Into Array
$fp = fopen($rootLoc.'data/jobs.txt', "r");
    // get the job records and store them in an array
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
<title>Edit Jobs</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
<br />

<center><big><big><b>Edit Jobs</b></big></big></center>
<br />
<form action="<?=$rootLoc?>jobsUpdate.php" method="post">
<table align="center" border="4" bordercolor="#BE873B">
<tr><td>Job</td><td>Active</td><td>Delete</td></tr>
<?php   for($i=0; $i<$deptCount; $i++){
    $checkmark='';
    if($depts[$i][1]=="on") $checkmark='checked="checked"';
?>
<tr>
  <td><input size="35" type="text" name="depts[<?=$i?>][0]" value="<?=$depts[$i][0]?>" ></td>
  <td><input <?=$checkmark?> type="checkbox" name="depts[<?=$i?>][1]" ></td>
  <td><input  type="checkbox" name="deleteMe[<?=$i?>]" ></td>
</tr>
<?php } ?>
<tr><td align="center" colspan="4"><input type="submit" value="Save Changes" /></td></tr>
<?php
if($message)
    echo '<tr><td align="center" colspan="4"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
</table>
</form>

<br />
<form action="<?=$rootLoc?>jobsUpdate.php" method="post">
<table align="center" border="4" bordercolor="#BE873B">
<?php   for($i=0; $i<$deptCount; $i++){  ?>
  <input type="hidden" name="depts[<?=$i?>][0]" value="<?=$depts[$i][0]?>" >
  <input type="hidden" name="depts[<?=$i?>][1]" value="<?=$depts[$i][1]?>" >
<?php } ?>
  <input type="hidden" name="depts[<?=$i+1?>][0]" value="" >
  <input type="hidden" name="depts[<?=$i+1?>][1]" value="" >
<tr><td align="center"><input type="submit" value="Add Job" />
<input value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
<input value="Log Out" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
</td></tr>
</table>
</form>
</body>
</html>
