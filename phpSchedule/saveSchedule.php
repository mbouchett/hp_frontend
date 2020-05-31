<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$time=$_POST['time'];
$dept=$_POST['dept'];
$note=$_POST['note'];
$timeCount=count($time);
$periodDay=$_POST['periodDay'];
$periodMonth=$_POST['periodMonth'];
$periodYear=$_POST['periodYear'];
$fault=$_POST['fault'];

for($i=0; $i<$timeCount; $i++){
	//echo $time[$i][0]."<br />";				//Name
	unset($item1);
	for($ii=1; $ii<15; $ii++){ 				//Times
		$item1=$item1.$time[$i][$ii].',';
	}
	$item1=substr($item1,0,-1); //get rid of the last comma
	//echo $item1."<br />";

	unset($item2);
	for($ii=1; $ii<15; $ii++){ 				//Departments
		$item2=$item2.$dept[$i][$ii].',';
	}
	$item2=substr($item2,0,-1); //get rid of the last comma
	//echo $item2."<br />";

	unset($item3);
	for($ii=0; $ii<7; $ii++){ 				//Notes
		$item3=$item3.$note[$i][$ii].',';
	}
	$item3=substr($item3,0,-1); //get rid of the last comma	
	//echo $item3."<br />";

	//echo $fault[$i]."<hr />";
	if ($fault[$i]){ //Save the default info for this employee
		$fp = fopen($rootLoc.'data/defaultSch/'.$time[$i][0].'.txt', "w");
        fwrite($fp, $item1."\n");
		fwrite($fp, $item2."\n");
		fwrite($fp, $item3);
		fclose($fp);         //close the Employee File
	}
}
$message='Only Default Info saved';
if($periodDay && $periodMonth && $periodYear) { //this part saves the schedule only if a  year, month and day are supplied

// This little bit does minor corrections of Schedule date which will be the filename and determine list order
if (strlen($periodDay)==1) $periodDay='0'.$periodDay;
if (strlen($periodMonth)==1) $periodMonth='0'.$periodMonth;
if (strlen($periodYear)==2) $periodYear='20'.$periodYear;

  $scheduleName=$periodYear.$periodMonth.$periodDay;
  $fp = fopen($rootLoc.'data/schedules/'.$scheduleName.'.txt', "w");

 for($i=0; $i<$timeCount; $i++){

  	unset($item1);
  	for($ii=1; $ii<15; $ii++){ 				//Times
  		$item1=$item1.$time[$i][$ii].',';
  	}
  	$item1=substr($item1,0,-1); //get rid of the last comma

  	unset($item2);
  	for($ii=1; $ii<15; $ii++){ 				//Departments
  		$item2=$item2.$dept[$i][$ii].',';
  	}
  	$item2=substr($item2,0,-1); //get rid of the last comma

  	unset($item3);
  	for($ii=0; $ii<7; $ii++){ 				//Notes
  		$item3=$item3.$note[$i][$ii].',';
  	}
  	$item3=substr($item3,0,-1); //get rid of the last comma
    if($i!=$timeCount-1) $item3=$item3."\n";

    //Write the data to the file
    fwrite($fp, $time[$i][0]."\n"); //Employee name
    fwrite($fp, $item1."\n"); //Times
  	fwrite($fp, $item2."\n"); //Departments
  	fwrite($fp, $item3);      //Notes

 }
  fclose($fp);         //close the Schedule File
  $message="Schedule And Default Info Saved";
}

header('Location: '.$rootLoc.'addSchedule.php?message='.$message.' - '.date('l jS \of F Y h:i:s A'));
//die();
?>