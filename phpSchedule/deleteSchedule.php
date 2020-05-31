<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];

//loadSchedule Names into an array
//Set the Path
$path=$rootLoc.'data/schedules';

//using the opendir function
$dir_handle = @opendir($path) or die("Unable to open $path");

$xx=0;
while ($file = readdir($dir_handle))
{
	if (substr($file,0,1)<>".") {
   		$schList[$xx]=$file;
		$xx=$xx+1;
		}
}
closedir($dir_handle);
sort($schList); // to sort in reverse order use asort($dirItem)

$schCount=count($schList);
rsort($schList);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="524.ico">
<title>Untitled Document</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
<br />
<center><big><big><b>Delete Schedule</b></big></big></center>
<table align="center" border="4" style="border-color: #B8860B">
    <tr>
        <td>Delete Week Starting</td>
        <td>
           <select name="weekStart">
           <?php for($i=0; $i<$schCount; $i++){
            $dispWeek=substr($schList[$i],4,2).'/'.substr($schList[$i],6,2).'/'.substr($schList[$i],0,4);
            unset($opt);
            if ($weekStart==$schList[$i]) $opt='selected';
           ?>
              <option <?=$opt?> onclick="parent.location='<?=$rootLoc?>viewSchedule.php?weekStart=<?=$schList[$i]?>&db=kill'" value="<?=$schList[$i]?>"><?=$dispWeek?></option>
           <?php }?>
           </select>
        </td>
    </tr>
  
<tr>
    <td align="center" colspan="2">
        <input value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
        <input value="Log Out" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
    </td>        
</tr>
<?php if($message){ ?>
	<tr>
    	<td align="center" colspan="2"><b><div style="color:#FF0000"><?=$message?></div></b></td>
    </tr>
<?php
	unset($message);
 	}
 ?>
</table>


</body>
</html>
