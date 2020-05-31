<?php
date_default_timezone_set('America/New_York');
//Load A Single Value From A Flat File
$fp = fopen('pp.txt', "r");  //Open The File For Reading
  $pp = fgets($fp);                    //Load The Value
fclose($fp);                            //Close The File

echo "***Information From pp.txt***<br>";
echo "Some Pay Period: ".$pp."<br/>";

$timeStamp = strtotime($pp)+3600;
echo "Timestamp equivalent: ".$timeStamp."<br/><br/>";

echo "***Derived Information***<br>";
$year = date('Y');
$startYear = $year."-01-01";
$endYear = $year."-12-31";
$fdTimeStamp = strtotime($startYear);
$ldTimeStamp = strtotime($endYear);
$minSec = 60;               // one minute in seconds
$hourSec =  3600;           // one hour in seconds
$daySeconds = 86400;        // one day in seconds
$weekSec = 604800;          // one week in seconds
$payPeriodSec = 1209600;    // one pay period in seconds

echo "First day of the year: ".$startYear."<br/>";
echo "Timestamp equivalent: ".$fdTimeStamp."<br/><br/>";

echo "Last day of the year: ".$endYear."<br/>";
echo "Timestamp equivalent: ".$ldTimeStamp."<br/><br/>";

// discover the first pay period of the year
while ($timeStamp > $fdTimeStamp){
    $firstPPStamp = $timeStamp;
    $timeStamp = $timeStamp - $weekSec;
}
//$timeStamp = $firstPPStamp; //reset the timestamp to the first period

echo "First Pay period of the Year: ".date('l, Y-m-d',$firstPPStamp)."<br/>";

// discover the subsequent pay periods of the year
$i = 0;
while ($timeStamp < $ldTimeStamp){
    $payPeriod[$i] = $timeStamp;
    $i++;
    $timeStamp = $timeStamp + $payPeriodSec;
}
$ppCount = count($payPeriod);

for($i = 0;$i < $ppCount; $i++){
echo "Pay Period ".str_pad($i, 2, '0', STR_PAD_LEFT).": ".date('l, Y-m-d',$payPeriod[$i])."<br/>";
}

?>