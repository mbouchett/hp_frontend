<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
  $message=$_REQUEST['message'];
  $messColor=$_REQUEST['messColor'];
  $messSize=$_REQUEST['messSize'];
$rootLoc=$_SESSION['rootLoc'];
$weekStart=$_REQUEST['weekStart'];

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
sort($schList);                         // to sort in reverse order use asort($dirItem)
$schCount=count($schList);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="524.ico">
<title>Re-Name Schedule</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
 <br /><div align="center" style=" font-size: 24px">Re-Name Schedule</div>
<div align="center" style=" font-size: 18px">The Format Is: YYYYMMDD.txt</div><br />
<form action="<?=$rootLoc?>processRenameScheduleSchedule.php" method="POST" >
<table align="center" border="4" style="border-color: #B8860B">
    <tr>
        <td>Old Name</td><td>New Name</td><td bgcolor="#000000" width="2"><td>Old Name</td><td>New Name</td><td bgcolor="#000000" width="2"><td>Old Name</td><td>New Name</td>
    </tr>
<?php for($i=0;$i<$schCount;$i=$i+3){ ?>
    <tr>
        <td><?=$schList[$i]?></td><td>
            <input name="newName[<?=$i?>]" />
            <input type="hidden" name="oldName[<?=$i?>]" value="<?=$schList[$i]?>" />
            </td><td bgcolor="#000000" width="2"></td>
        <?php if($schList[$i+1]){ ?>
        <td><?=$schList[$i+1]?></td><td><input name="newName[<?=$i+1?>]" /><input type="hidden" name="oldName[<?=$i+1?>]" value="<?=$schList[$i+1]?>" /></td><td bgcolor="#000000" width="2"></td>
        <?php }
        if($schList[$i+2]){ ?>
        <td><?=$schList[$i+2]?></td><td><input name="newName[<?=$i+2?>]" /><input type="hidden" name="oldName[<?=$i+2?>]" value="<?=$schList[$i+2]?>" /></td>
        <?php } ?>
    </tr>
<?php } ?>
</table>
<?php if($message){?>
<br />
<table align="center" border="4" >
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>
<br /><div align="center"><input type="submit" name="" value="Okay Okay I'm Done Save It" />
<input value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
</div>
</form>

</body>
</html>
