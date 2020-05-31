<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
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
rsort($schList);

if(!$weekStart) $weekStart=$schList[0]; //if no weekstart has been specified then assign the most recent(this will be the default status)
$day=substr($weekStart,6,2);            // from the weekstart filename derive the Day
$month=substr($weekStart,4,2);           // from the weekstart filename derive the Month
$year=substr($weekStart,0,4);           // from the weekstart filename derive the Year


//Load Current Schedule
$i=0;
$fp = @fopen($rootLoc.'data/schedules/'.$weekStart, "r");
 while (!feof($fp)) {
     // get the Schedule records and store them in the arrays
     $empName[$i]= fgets($fp);
     $item= fgetcsv($fp, ",");
     $dTime[$i] =array($item[0],$item[1],$item[2],$item[3],$item[4],$item[5],$item[6],$item[7],$item[8],$item[9],$item[10],$item[11],$item[12],$item[13]);
     $item= fgetcsv($fp, ",");
	 $dDept[$i] =array($item[0],$item[1],$item[2],$item[3],$item[4],$item[5],$item[6],$item[7],$item[8],$item[9],$item[10],$item[11],$item[12],$item[13]);
     $item= fgetcsv($fp, ",");
	 $dNote[$i] =array($item[0],$item[1],$item[2],$item[3],$item[4],$item[5],$item[6]);
     $i=$i+1;
}
$empCount=count($empName);
fclose($fp);         		//close the employee file

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

$month=(int)$month;
$tday=$day;
      //Load the dates array
      for($i=0; $i<7; $i++){

        switch ($month){
           case 1:
                if($tday==32){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 3:
                if($tday==32){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 5:
                if($tday==32){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 7:
                if($tday==32){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 8:
                if($tday==32){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 10:
                if($tday==32){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 12:
                if($tday==32){
                   $month=1;
                   $tday=1;
                   $year=$year+1;
                }
           break;
           case 11:
                if($tday==31){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 4:
                if($tday==31){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 6:
                if($tday==31){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 9:
                if($tday==31){
                   $month=$month+1;
                   $tday=1;
                }
           break;
           case 2:
                // Account for leap year
                $a=$year/4;
                if($a==intval($a)){
                    $feb=29;
                }else {
                    $feb=28;
                }
                if($tday==$feb+1) {
                    $month=$month+1;
                    $tday=1;
                }
           break;
        }
        $month0[$i]=$month;
        $day0[$i]=$tday;
        $year0[$i]=$year;
        $tday=$tday+1;
      }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="../webfonts/fonts.css" type="text/css">
<link rel="SHORTCUT ICON" href="../images/icon.ico">
<title>Edit Schedule</title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
 <br /><div align="center" style=" font-size: 24px">Editing Schedule</div>
<form action="<?=$rootLoc?>editSchedule.php" method="POST" >
<table align="center" border="4" style="border-color: #B8860B">
    <tr>
        <td>Week Starting</td>
        <td>
           <select name="weekStart">
           <?php for($i=0; $i<$schCount; $i++){
            $dispWeek=substr($schList[$i],4,2).'/'.substr($schList[$i],6,2).'/'.substr($schList[$i],0,4);
            unset($opt);
            if ($weekStart==$schList[$i]) $opt='selected';
           ?>
              <option <?=$opt?> onclick="parent.location='<?=$rootLoc?>editSchedule.php?weekStart=<?=$schList[$i]?>'" value="<?=$schList[$i]?>"><?=$dispWeek?></option>
           <?php }?>
           </select>
        </td><td><input type="submit" value="Refresh" /></td>
    </tr>
</table>
</form>
<br />
<form action="<?=$rootLoc?>saveScheduleEdit.php" method="post">
<input name="periodMonth" type="hidden" value="<?=$month?>"/>
<input name="periodDay" type="hidden" value="<?=$day?>"/>
<input name="periodYear" type="hidden" value="<?=$year?>"/>
<input name="weekStart"  type="hidden" value="<?=$weekStart?>"/>
<table align="center" border="4" style="border-color: #B8860B">

<!-- Put the dates across -->
  <tr>
    <td align="left" rowspan="3"><b>Name</b></td>
    <td align="center" colspan="2"><b><?=$month0[0]?>/<?=$day0[0]?>/<?=substr($year0[0],2,2)?></b></td>
    <td align="center" colspan="2"><b><?=$month0[1]?>/<?=$day0[1]?>/<?=substr($year0[1],2,2)?></b></td>
    <td align="center" colspan="2"><b><?=$month0[2]?>/<?=$day0[2]?>/<?=substr($year0[2],2,2)?></b></td>
    <td align="center" colspan="2"><b><?=$month0[3]?>/<?=$day0[3]?>/<?=substr($year0[3],2,2)?></b></td>
    <td align="center" colspan="2"><b><?=$month0[4]?>/<?=$day0[4]?>/<?=substr($year0[4],2,2)?></b></td>
    <td align="center" colspan="2"><b><?=$month0[5]?>/<?=$day0[5]?>/<?=substr($year0[5],2,2)?></b></td>
    <td align="center" colspan="2"><b><?=$month0[6]?>/<?=$day0[6]?>/<?=substr($year0[6],2,2)?></b></td>
  </tr>


<!-- Put the days of the week across -->
  <tr>
      <td align="center" colspan="2" class="bgcolor1"><b>Sunday</b></td>
      <td align="center" colspan="2" class="bgcolor2"><b>Monday</b></td>
      <td align="center" colspan="2" class="bgcolor1"><b>Tuesday</b></td>
      <td align="center" colspan="2" class="bgcolor2"><b>Wednesday</b></td>
      <td align="center" colspan="2" class="bgcolor1"><b>Thursday</b></td>
      <td align="center" colspan="2" class="bgcolor2"><b>Friday</b></td>
      <td align="center" colspan="2" class="bgcolor1"><b>Saturday</b></td>
  </tr>


<!-- Put the column headers across -->
  <tr>
      <?php for($i=0; $i<7; $i++){?>
      <td align="center"><small><small>Begin</small></small></td><td align="center"><small><small>End</small></small></td>
      <?php }?>
  </tr>

<!-- Put the employee names and times across -->
<?php for($i=0; $i<$empCount; $i++){ ?>
    <input type="hidden" name="time[<?=$i?>][0]" value="<?=$empName[$i]?>"  />
    <tr>
        <td><b><?=$empName[$i]?></b></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][1]" size="6" value="<?=$dTime[$i][0]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][2]" size="6" value="<?=$dTime[$i][1]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][3]" size="6" value="<?=$dTime[$i][2]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][4]" size="6" value="<?=$dTime[$i][3]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][5]" size="6" value="<?=$dTime[$i][4]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][6]" size="6" value="<?=$dTime[$i][5]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][7]" size="6" value="<?=$dTime[$i][6]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][8]" size="6" value="<?=$dTime[$i][7]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][9]" size="6" value="<?=$dTime[$i][8]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][10]" size="6" value="<?=$dTime[$i][9]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][11]" size="6" value="<?=$dTime[$i][10]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][12]" size="6" value="<?=$dTime[$i][11]?>"/></small></td>
        <td align="center"><small><input type="text" name="time[<?=$i?>][13]" size="6" value="<?=$dTime[$i][12]?>"/></small></td><td align="center"><small><input type="text" name="time[<?=$i?>][14]" size="6" value="<?=$dTime[$i][13]?>"/></small></td>
    </tr>

<!-- Put the departments across -->
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

<!-- Put the notes across -->
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
<input class="btn" value="Return To Dashboard" onclick="parent.location='adminDashboard.php'" type="button">
<input class="btn" value="Log Out" onclick="parent.location='logout.php'" type="button">
</td></tr>
</table>
</form>
</body>
</html>
