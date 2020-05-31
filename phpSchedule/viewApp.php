<?php
$appNum=$_REQUEST['appNum'];
$message=$_REQUEST['message'];

//Load Company Info Into Array
$fp = fopen($rootLoc.'data/companyInfo.txt', "r");
    // get the Company records and store them in the users array
     $i=0;
       while (!feof($fp)) {
          $item= fgets($fp);
          $compInfo[$i] =$item;
          $i++;
       }
fclose($fp);         		//close the Company file

//Load Application Into Array
$fp = fopen('../phpSchedule/data/apps/'.$appNum, "r");
    // get the department records and store them in the depts array
     $i=1;
       while (!feof($fp)) {
          $item= fgets($fp);
          $app[$i]=stripslashes($item);
          //echo $i.' - '.$item.'<br />';
          $i++;
       }
fclose($fp);         		//close the application file

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <link rel="SHORTCUT ICON" href="../images/HM.ICO">
  <title>Homeport Application For Employment</title>
</head>
<body>
 <form action="../phpSchedule/updateComment.php" method="POST" >
<table width="100%" vspace="0">
	<tr>
    	<td align="center"><div style="font-size:36px"><img width="200" src="<?=$compInfo[1]?>"> <?=$compInfo[0]?></div></td>
	</tr>
</table>
<hr align="center" width="700">
<div align="center" style="font-size: 20px">Application For Employment</div>

<hr align="center" width="700">
  <table border="1" align="center" width="700">
    <tr><td>Name: </td><td><?=$app[1]?></td><td colspan="2" align="center" width="200"><?=$app[2]?></td></tr>
    <tr><td>Address: </td><td><?=$app[3]?></td><td>In House Comment:</td>
    <td align="center" rowspan="3"><input type="submit" name="submit" value="Save">

<?php if($message)
    echo '<br /><div style="font-weight: bold; color: #009900">'.$message.'</div>';
    unset($message);
?>

    </td></tr>
    <tr><td>Email: </td><td><?=$app[4]?></td><td align="center" rowspan="2"><input type="hidden" name="appNum" value="<?=$appNum?>">
    <input size="32" name="comment" value="<?=$app[55]?>" ></td></tr>
    <tr><td>Telephone: </td><td><?=$app[5]?></td></tr>
    <tr><td height="4" colspan="4" bgcolor="#585858"></td></tr>
    <tr><td colspan="2">Are you currently employed?</td><td colspan="2"><?=$app[7]?></td></tr>
    <tr><td colspan="2">If currently employed then where?</td><td colspan="2"><?=$app[6]?></td></tr>
    <tr><td colspan="2">Are you a student?</td><td colspan="2"><?=$app[8]?></td></tr>
    <tr><td colspan="2">What position are you applying for?</td><td colspan="2"><?=$app[9]?></td></tr>
    <tr><td height="4" colspan="4" bgcolor="#585858"></td></tr>
</table>
<table align="center" border="1" width="700">
    <tr><td colspan="4"><div style=" font-weight: bold">Education</div></td></tr>
    <tr><td ></td><td >Name Of Institution</td><td >Level Completed</td><td >Year Compleated</td></tr>
    <tr>
    	<td >High School</td>
        <td ><?=$app[56]?></td>
        <td ><?=$app[57]?></td>
        <td ><?=$app[58]?></td>
    </tr>
    <tr>
    	<td >College Or University</a></td>
        <td ><?=$app[59]?></td>
        <td ><?=$app[60]?></td>
        <td ><?=$app[61]?></td>
    </tr>
    <tr>
    	<td >Technical Or Specialized Training</a></td>
        <td ><?=$app[62]?></td>
        <td ><?=$app[63]?></td>
        <td ><?=$app[64]?></td>
    </tr>
    <tr>
    	<td >Other</td>
        <td ><?=$app[65]?></td>
        <td ><?=$app[66]?></td>
        <td ><?=$app[67]?></td>
    </tr>
    <tr><td height="4" colspan="4" bgcolor="#585858"></td></tr>
  </table>
<table border="1" align="center" width="700">
    <tr><td colspan="6"><div style=" font-weight: bold">Work Experience</div></td></tr>
    <tr><td >Start</td><td>End</td><td >Employer</td><td >Duties/Responsibilities</td><td >Supervisor</td><td >Telephone</td></tr>
    <tr>
    	<td ><?=$app[10]?></td>
        <td ><?=$app[11]?></td>
        <td ><?=$app[12]?></td>
        <td ><?=$app[13]?></td>
        <td ><?=$app[14]?></td>
        <td ><?=$app[15]?></td>
    </tr>
    <tr>
    	<td ><?=$app[16]?></td>
        <td ><?=$app[17]?></td>
        <td ><?=$app[18]?></td>
        <td ><?=$app[19]?></td>
        <td ><?=$app[20]?></td>
        <td ><?=$app[21]?></td>
    </tr>
    <tr>
    	<td ><?=$app[22]?></td>
        <td ><?=$app[23]?></td>
        <td ><?=$app[24]?></td>
        <td ><?=$app[25]?></td>
        <td ><?=$app[26]?></td>
        <td ><?=$app[27]?></td>
    </tr>
    <tr>
    	<td ><?=$app[28]?></td>
        <td ><?=$app[29]?></td>
        <td ><?=$app[30]?></td>
        <td ><?=$app[31]?></td>
        <td ><?=$app[32]?></td>
        <td ><?=$app[33]?></td>
    </tr>
    <tr><td height="4" colspan="6" bgcolor="#585858"></td></tr>
  </table>
  <table border="1" align="center" width="700">
  	<tr><td align="left" colspan="4"><div style=" font-weight: bold">Personal Referances</div></td></tr>
  	<tr>
    	<td><b>Name</b></td><td><b>Relationship To You</b></td><td><b>Telephone 1</b></td><td><b>Telephone 2</b></td>
    </tr>
  	<tr>
    	<td><?=$app[34]?></td><td><?=$app[35]?></td><td><?=$app[36]?></td><td><?=$app[37]?></td>
    </tr>
  	<tr>
    	<td><?=$app[38]?></td><td><?=$app[39]?></td><td><?=$app[40]?></td><td><?=$app[41]?></td>
    </tr>
    <tr><td height="4" colspan="6" bgcolor="#585858"></td></tr>
  </table>
    <table align="center" width="700">
  	<tr><td align="left" colspan="7"><div style=" font-weight: bold">Availability</div></td></tr>
  	<tr>
    	<td align="center">Sunday</td><td align="center">Monday</td><td align="center">Tuesday</td><td align="center">Wednesday</td><td align="center">Thursday</td><td align="center">Friday</td><td align="center">Saturday</td>
    </tr>
    <tr>
    	<td align="center"><?=$app[42]?></td><td align="center"><?=$app[43]?></td><td align="center"><?=$app[44]?></td><td align="center"><?=$app[45]?></td><td align="center"><?=$app[46]?></td><td align="center"><?=$app[47]?></td><td align="center"><?=$app[48]?></td>
    </tr>
    <tr><td height="4" colspan="8" bgcolor="#585858"></td></tr>
</table>
<table border="1" align="center" width="700">
  	<tr><td>Number Of Hours That You Can Work Each Week: <b><?=$app[49]?></b> Max <b><?=$app[50]?></b> Min</td><td>Are You Available Holidays? <b><?=$app[51]?></b></td>
    </tr>
    <tr>
    	<td>How Long Do You Plan To Work? : <b><?=$app[52]?></b> :</td><td>Will You Be Here In The Summer? <b><?=$app[53]?></b></td>
    </tr>
    <tr><td colspan="4">Have You Ever Been Convicted Of A Criminal Offense? <b><?=$app[54]?></b></td></tr>
    <tr><td height="4" colspan="2" bgcolor="#585858"></td></tr>
</table>
<table align="center" width="700">
    <tr><td align="center"><input value="Return To Previous Screen" onclick="parent.location='<?=$rootLoc?>reviewApps.php'" type="button"></td></tr>
</table>
</form>
</body>
</html>