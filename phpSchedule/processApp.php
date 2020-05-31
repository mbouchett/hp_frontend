<?php

$app=$_POST['app'];
$appCount = count($app);

for($i = 0; $i < $appCount; $i++){
	$app[$i] = filter_var($app[$i], FILTER_SANITIZE_STRING);
}

if(!$app[1]) header("location: http://www.homeportonline.com");
if(!$app[5]) header("location: http://www.homeportonline.com");

//Load our email address
$fp = fopen('../email.txt', "r");  //Open The File For Reading
  $data = fgets($fp);                    //Load The Value
fclose($fp);
$homeportEmail = substr($data,12,19).".com";

//Load Company Info Into Array
$fp = fopen('../phpSchedule/data/companyInfo.txt', "r");
    // get the Company records and store them in the users array
     $i=0;
       while (!feof($fp)) {
          $item= fgets($fp);
          $compInfo[$i] =$item;
          $i++;
       }
fclose($fp);         		//close the Company file

// This bit loads and increments the application #
$fp = fopen('../phpSchedule/data/appNo.txt', "r"); //open the application # file
	$appNo= fgets($fp);		// Load the current application #
fclose($fp);         		//close the application # file
$appNo=$appNo+1;			//increment the application #
$fp = fopen('../phpSchedule/data/appNo.txt', "w"); //open the application # file
	fwrite($fp, $appNo);		// save the current application #
fclose($fp);         		//close the application # file

//Create and save the application file
$fp = fopen('../phpSchedule/data/apps/'.$appNo.'.txt', "w");
for($i=1; $i<68; $i++){
  $stuff=$app[$i];
  fwrite($fp, $stuff."\n");
}
fclose($fp);         		//close the application file
if($app[4]){ // If an email address was provided then send a conformation
$message=$app[1]."\n\n".
		 "\t\tApplication For Employment At Homeport Received: ".$app[2]."\n\n";
		 if(trim($app[9])=="No Positions Currently Available"){
		 	$message=$message."\t\tThank you for your interest in Homeport. Although we are not currently\n".
							  "hiring we do keep applications on file. Should a position arise we typically\n".
							  "go through filled applications before posting the position.\n\n".
				              "Homeport Ltd\n52Church Streeet\nBurlington, VT 05401\nwww.homeportonline.com\n(802) 863-4644";
		 } else{
		 	$message=$message."\t\tThank you for your interest in Homeport. We consider all applications\n".
							  "for employment seriously and will contact you if we need to talk further\n".
							  "Thank You.\n\n".
				              "Homeport Ltd\n52Church Streeet\nBurlington, VT 05401\nwww.homeportonline.com\n(802) 863-4644";
}
mail($app[4],'Application For Employment At Homeport Received #'.$appNo,$message,'home@homeportonline.com');
}
//mail($homeportEmail,'New Application Filed','http://www.homeportonline.com/phpSchedule/viewApp.php?appNum='.$appNo.'.txt','home@homeportonline.com');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
  <link rel="SHORTCUT ICON" href="../images/HM.ICO">
  <title>Homeport Application For Employment</title>
</head>
<body>
<table width="100%" vspace="0">
	<tr>
    	<td align="center"><div style="font-size:36px"><img width="200" src="<?=$compInfo[1]?>"> <?=$compInfo[0]?></div></td>
	</tr>
</table>
<hr align="center" width="700">
<div align="center" style="font-size: 20px">Application For Employment</div>
<table align="center" cellpadding="2" border="4" bordercolor="#CC9933" width="500">
	<tr>
    	<td align="center">Thank you for your interest in Homeport<br />
        	Your Application for employment has been received and<br />
            a conformation has been emailed if you provided one.
        </td>
    </tr>
	<tr>
    	<td align="center"><input value="Return To The Homeport Website" onclick="parent.location='../index.php'" type="button"></td>
    </tr>
</table>
</body>
</html>