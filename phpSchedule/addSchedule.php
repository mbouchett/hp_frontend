<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$message=$_REQUEST['message'];
$periodYear=$_REQUEST['periodYear'];
$periodMonth=$_REQUEST['periodMonth'];
$periodDay=$_REQUEST['periodDay'];
date_default_timezone_set('America/New_York');

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
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="../webfonts/fonts.css" type="text/css">
<link rel="SHORTCUT ICON" href="524.ico">
<title>Schedule Builder</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
<form action="<?=$rootLoc?>saveSchedule.php" method="post">
<table align="center" border="4" style="border-color:#000000">
	<tr><td rowspan="2"><big>Schedule Builder</big></td>
    	<td rowspan="2" align="center">Start Of Week<small><br />*Required</small></td>
    	<td><input name="periodMonth" type="text" value="<?=$periodMonth?>" size="2"/></td>
        <td><input name="periodDay" type="text" value="<?=$periodDay?>" size="2"/></td>
        <td><input name="periodYear" type="text" value="<?=$periodYear?>" size="3"/></td>
    </tr>
	<tr>
    	<td>mm</td>
        <td>dd</td>
        <td>yyyy</td>
    </tr>
</table>
<table align="center" border="4" bordercolor="#808000">
    <tr>
        <td align="left"><b>Name</b></td>
        <td align="center" colspan="2" class="bgcolor1"><b>Sunday</b></td>
        <td align="center" colspan="2" class="bgcolor2"><b>Monday</b></td>
        <td align="center" colspan="2" class="bgcolor1"><b>Tuesday</b></td>
        <td align="center" colspan="2" class="bgcolor2"><b>Wednesday</b></td>
        <td align="center" colspan="2" class="bgcolor1"><b>Thursday</b></td>
        <td align="center" colspan="2" class="bgcolor2"><b>Friday</b></td>
        <td align="center" colspan="2" class="bgcolor1"><b>Saturday</b></td>
        <td rowspan="2">Set Default</td>
    </tr>
    <tr>
        <td></td>
        <?php for($i=0; $i<7; $i++){?>
        <td align="center"><small><small>Begin</small></small></td><td align="center"><small><small>End</small></small></td>
		<?php }?>
    </tr>
    
<?php for($i=0; $i<$empCount; $i++){
	$userName[$i]=$users[$i][1].' '.$users[$i][0];
	
	// look for a default file for this employee
	$fp = @fopen($rootLoc.'data/defaultSch/'.$userName[$i].'.txt', "r");
		  if($fp){
    	  // get the employee records and store them in the arrays
          $item= fgetcsv($fp, ",");
          $dTime[$i] =array($item[0],$item[1],$item[2],$item[3],$item[4],$item[5],$item[6],$item[7],$item[8],$item[9],$item[10],$item[11],$item[12],$item[13]);
          $item= fgetcsv($fp, ",");		  
		  $dDept[$i] =array($item[0],$item[1],$item[2],$item[3],$item[4],$item[5],$item[6],$item[7],$item[8],$item[9],$item[10],$item[11],$item[12],$item[13]);
          $item= fgetcsv($fp, ",");	
		  $dNote[$i] =array($item[0],$item[1],$item[2],$item[3],$item[4],$item[5],$item[6]);	  
fclose($fp);         		//close the employee file
}
?> 
	<input type="hidden" name="time[<?=$i?>][0]" value="<?=$userName[$i]?>"  /> 
    <tr>
        <td><?=$userName[$i]?></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][1]" size="6" value="<?=$dTime[$i][0]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][2]" size="6" value="<?=$dTime[$i][1]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][3]" size="6" value="<?=$dTime[$i][2]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][4]" size="6" value="<?=$dTime[$i][3]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][5]" size="6" value="<?=$dTime[$i][4]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][6]" size="6" value="<?=$dTime[$i][5]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][7]" size="6" value="<?=$dTime[$i][6]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][8]" size="6" value="<?=$dTime[$i][7]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][9]" size="6" value="<?=$dTime[$i][8]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][10]" size="6" value="<?=$dTime[$i][9]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][11]" size="6" value="<?=$dTime[$i][10]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][12]" size="6" value="<?=$dTime[$i][11]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][13]" size="6" value="<?=$dTime[$i][12]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][14]" size="6" value="<?=$dTime[$i][13]?>"/></small></td>
        <td rowspan="3"><input type="checkbox" name="fault[<?=$i?>]" /></td>
    </tr>
<tr>
	<td><small><small>Dept.</small></small></td>
    <?php for($iii=1; $iii<15; $iii++){?>
    	<td>
        	<select name="dept[<?=$i?>][<?=$iii?>]">
        	<?php for($iv=0; $iv<$deptCount; $iv++){
				unset($opt);
				if ($depts[$iv][0]==$dDept[$i][$iii-1]) $opt='selected';
			?>

            	<option <?=$opt?>><?=$depts[$iv][0]?></option>
            <?php }?>
            </select>
        </td>
    <?php }?>

</tr>
<tr class="TFtableCol">
	<td><small><small>Note</small></small></td>
    <?php for($iii=1; $iii<8; $iii++){?>
    	<td align="center" colspan="2"><input type="text" name="note[<?=$i?>][<?=$iii-1?>]" size="17" value="<?=$dNote[$i][$iii-1]?>"/></td>
    <?php }?>
</tr>
<tr><td bgcolor="#990000" colspan="16"></td></tr>
<?php }?>
<tr><td align="center" colspan="16"><input class="btn" type="submit" value="Save Changes" />
</td></tr>
<?php
if($message)
    echo '<tr><td align="center" colspan="16"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
<tr><td align="center" colspan="16">
<input class="btn" value="Return To Dashboard" onclick="parent.location='<?=$rootLoc?>adminDashboard.php'" type="button">
<input class="btn" value="Log Out" onclick="parent.location='<?=$rootLoc?>logout.php'" type="button">
</td></tr>
</table>
</form>
</body>
</html>
