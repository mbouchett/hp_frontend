<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];

//using the opendir function load apps into an array
//Set the Path
$path=$rootLoc.'data/apps';

$dir_handle = @opendir($path) or die("Unable to open $path");
$xx=0;
while ($file = readdir($dir_handle))
{
	if (substr($file,0,1)<>".") {
   		$appNum[$xx]=$file;
		$xx=$xx+1;
		}
}
closedir($dir_handle);
rsort($appNum);
$appCount=count($appNum);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="524.ico">
<title>Review Job Applications</title>
</head>
<body>
<?php include($rootLoc.'header.php')?>
<br />
<center><big><big><b>Review Job Applications</b></big></big></center>
<br />
<form action="<?=$rootLoc?>appsUpdate.php" method="post">
<table align="center" border="4" bordercolor="#BE873B">
<tr><td>Application </td><td>Name</td><td>Position</td><td>Date</td><td>Remove</td></tr>
<?php   for($i=0; $i<$appCount; $i++){ 
 
//This bit Gets the Name & Date From the application
$fp = fopen($rootLoc.'data/apps/'.$appNum[$i], "r");
     $appName=fgets($fp);     //0 app Name
	 $appDate=fgets($fp);     //1 app Date
     $app02=fgets($fp);     //
     $app02=fgets($fp);     //
     $app02=fgets($fp);     //
     $app02=fgets($fp);     //
     $app02=fgets($fp);     //
     $app02=fgets($fp);     //
     $appPosition=fgets($fp);     // 8 app Position

fclose($fp);         		//close the application file
?>
<tr>
  <td><a href="<?=$rootLoc?>viewApp.php?appNum=<?=$appNum[$i]?>"><?=substr($appNum[$i],0,-4)?></a><input type="hidden" name="appNum[<?=$i?>]" value="<?=$appNum[$i]?>" /></td>
  <td><?=$appName?></td>
  <td><?=$appPosition?></td>
  <td><?=$appDate?></td>
  <td align="center"><input name="deleteMe[<?=$i?>]" type="checkbox" /></td>
</tr>
<?php } ?>
<tr><td align="center" colspan="5"><input type="submit" value="Save Changes" /></td></tr>
<?php
if($message)
    echo '<tr><td align="center" colspan="5"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
</table>
</form>
<table align="center" border="4" bordercolor="#BE873B">
<?php   for($i=0; $i<$deptCount; $i++){  ?>
  <input type="hidden" name="depts[<?=$i?>][0]" value="<?=$depts[$i][0]?>" >
  <input type="hidden" name="depts[<?=$i?>][1]" value="<?=$depts[$i][1]?>" >
<?php } ?>
  <input type="hidden" name="depts[<?=$i+1?>][0]" value="" >
  <input type="hidden" name="depts[<?=$i+1?>][1]" value="" >
<tr><td align="center">
<input value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
<input value="Log Out" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
</td></tr>
</table>

</body>
</html>
