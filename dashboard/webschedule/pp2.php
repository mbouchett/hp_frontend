<?php
date_default_timezone_set('America/New_York');
//Load A Single Value From A Flat File
$fp = fopen('pp.txt', "r");  //Open The File For Reading
  $pp = fgets($fp);                    //Load The Value
fclose($fp);                            //Close The File
$today = date('Y-m-d');

echo "***Information From pp.txt***<br>";
echo "Some Pay Period: ".$pp."<br/><br/>";
echo "Today: ".$today."<br/><br/>";

// discover the subsequent pay periods of the year
while (strtotime($pp) < strtotime($today)){

    $pp = date('Y-m-d', strtotime($pp. ' + 14 days'));
}

$ppStart = date('Y-m-d', strtotime($pp. ' - 14 days'));
$ppEnd = date('Y-m-d', strtotime($pp. ' - 1 days'));
echo "Current Pay Period Start: ".$ppStart."<br/>";
echo "Current Pay Period End: ".$ppEnd."<br/>";
?>