<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$weekStart=$_REQUEST['weekStart'];
$db=$_REQUEST['db'];

$today=date("Ymd");
echo $today;

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

if(!$weekStart) $weekStart=$schList[0];
$day=substr($weekStart,6,2);
$month=substr($weekStart,4,2);
$year=substr($weekStart,0,4);

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

//this bit converts department names to colors

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

for($i=0; $i<$empCount; $i++){
 for($ii=0; $ii<14; $ii++){
   for($iii=0; $iii<$deptCount; $iii++){
     if($dDept[$i][$ii]==$depts[$iii][0]) $dDept[$i][$ii]=$depts[$iii][1];
   }
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="SHORTCUT ICON" href="524.ico">
  <title></title>
</head>

<body>
<?php include($rootLoc.'header.php')?>
<br />
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
              <option <?=$opt?> onclick="parent.location='<?=$rootLoc?>viewSchedule.php?weekStart=<?=$schList[$i]?>'" value="<?=$schList[$i]?>"><?=$dispWeek?></option>
           <?php }?>
           </select>
        </td>
        <?php if($db=="kill") {?>
        	<form action="confirmDeleteSchedule.php" method="post">
        	<td>
            <input type="submit" value="Delete This Schedule" />
            <input type=button value="Cancel" onClick="history.go(-1)"> <!-- Go Back One Page -->
            <input type="hidden" name="deleteWeek" value="<?=$weekStart?>" />
            </td>
            </form>
			<?php }?>
    </tr>
</table>

<?php
      //Load the dates array
      for($i=0; $i<7; $i++){
        $day0[$i]=$day+$i;
        switch ($month){
           case 1||3||5||7||8||10||12:
                if($day0[$i]>31){
                   if($day0[$i]==32) $month=$month+1;
                   $day0[$i]=$day0[$i]-31;
                }
           break;
           case 4||6||9||11:
                if($day0[$i]>30){
                    if($day0[$i]==30) $month=$month+1;
                    $day0[$i]=$day0[$i]-30;
                }
           break;
           case 2:
                // Account for leap year
                $a=$year/4;
                if($a==intval($a)){
                    $feb=28;
                }else {
                    $feb=27;
                if($day0[$i]>$feb) {
                    if($day0[$i]==$feb) $month=$month+1;
                        $day0[$i]=$day0[$i]-$feb;
                    }
                }
           break;
        }
        $month0[$i]=$month;
      }
?>
<table align="center" style=" border-top-width: 4px; border-bottom-width: 4px; border-left-width: 4px; border-right-width: 4px; border-color: #B8860B">

<tr>
  <td align="center"></td>
  <td align="center" colspan="3"><b><?=$month0[0]?>/<?=$day0[0]?>/<?=substr($year,2,2)?></b></td>
  <td align="center" colspan="3"><b><?=$month0[1]?>/<?=$day0[1]?>/<?=substr($year,2,2)?></b></td>
  <td align="center" colspan="3"><b><?=$month0[2]?>/<?=$day0[2]?>/<?=substr($year,2,2)?></b></td>
  <td align="center" colspan="3"><b><?=$month0[3]?>/<?=$day0[3]?>/<?=substr($year,2,2)?></b></td>
  <td align="center" colspan="3"><b><?=$month0[4]?>/<?=$day0[4]?>/<?=substr($year,2,2)?></b></td>
  <td align="center" colspan="3"><b><?=$month0[5]?>/<?=$day0[5]?>/<?=substr($year,2,2)?></b></td>
  <td align="center" colspan="3"><b><?=$month0[6]?>/<?=$day0[6]?>/<?=substr($year,2,2)?></b></td>
</tr>
<tr>
  <td align="left" ><b>Name</b></td>
  <td align="center" colspan="3"><b>Sunday</b></td>
  <td align="center" colspan="3"><b>Monday</b></td>
  <td align="center" colspan="3"><b>Tuesday</b></td>
  <td align="center" colspan="3"><b>Wednesday</b></td>
  <td align="center" colspan="3"><b>Thursday</b></td>
  <td align="center" colspan="3"><b>Friday</b></td>
  <td align="center" colspan="3"><b>Saturday</b></td>
</tr>

<?php for($i=0; $i<$empCount; $i++){?>
    <tr>
      <td align="left" rowspan="2"><?=$empName[$i]?></td>
      <td align="center" bgcolor="#<?=$dDept[$i][0]?>"><?=$dTime[$i][0]?></td>
      <td align="center" bgcolor="#<?=$dDept[$i][1]?>"><?=$dTime[$i][1]?></td><td width="4"></td>
      <td align="center" bgcolor="#<?=$dDept[$i][2]?>"><?=$dTime[$i][2]?></td>
      <td align="center" bgcolor="#<?=$dDept[$i][3]?>"><?=$dTime[$i][3]?></td><td width="4"></td>
      <td align="center" bgcolor="#<?=$dDept[$i][4]?>"><?=$dTime[$i][4]?></td>
      <td align="center" bgcolor="#<?=$dDept[$i][5]?>"><?=$dTime[$i][5]?></td><td width="4"></td>
      <td align="center" bgcolor="#<?=$dDept[$i][6]?>"><?=$dTime[$i][6]?></td>
      <td align="center" bgcolor="#<?=$dDept[$i][7]?>"><?=$dTime[$i][7]?></td><td width="4"></td>
      <td align="center" bgcolor="#<?=$dDept[$i][8]?>"><?=$dTime[$i][8]?></td>
      <td align="center" bgcolor="#<?=$dDept[$i][9]?>"><?=$dTime[$i][9]?></td><td width="4"></td>
      <td align="center" bgcolor="#<?=$dDept[$i][10]?>"><?=$dTime[$i][10]?></td>
      <td align="center" bgcolor="#<?=$dDept[$i][11]?>"><?=$dTime[$i][11]?></td><td width="4"></td>
      <td align="center" bgcolor="#<?=$dDept[$i][12]?>"><?=$dTime[$i][12]?></td>
      <td align="center" bgcolor="#<?=$dDept[$i][13]?>"><?=$dTime[$i][13]?></td><td width="4"></td>
    </tr>
    <tr>
      <td align="center" colspan="3"><?=$dNote[$i][0]?></td><td align="center" colspan="3"><?=$dNote[$i][1]?></td>
      <td align="center" colspan="3"><?=$dNote[$i][2]?></td><td align="center" colspan="3"><?=$dNote[$i][3]?></td>
      <td align="center" colspan="3"><?=$dNote[$i][4]?></td><td align="center" colspan="3"><?=$dNote[$i][5]?></td>
      <td align="center" colspan="3"><?=$dNote[$i][6]?></td>
    </tr>
    <tr>
      <td colspan="22" bgcolor="#000000"></td>
    </tr>
<?php }?>
</table>


</body>

</html>