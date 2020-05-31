<?php
$rootLoc="../phpSchedule/";
$appNum=$_POST['appNum'];
$comment=$_POST['comment'];

//Load Application Into Array
$fp = fopen($rootLoc.'data/apps/'.$appNum, "r");
    // get the department records and store them in the depts array
     $i=1;
       while (!feof($fp)) {
          $item= fgets($fp);
          $app[$i]=stripslashes($item);
          $i++;
       }
fclose($fp);         		//close the application file
$app[55]=$comment."\n";

//Create and save the application file
$fp = fopen($rootLoc.'data/apps/'.$appNum, "w");
for($i=1; $i<69; $i++){
  $stuff=$app[$i];
  //echo $i.' - '.$stuff.'<br />';
  fwrite($fp, $stuff);
}
fclose($fp);         		//close the application file
//exit;
header('Location: '.$rootLoc.'viewApp.php?appNum='.$appNum.'&message=Saved');
die();
?>