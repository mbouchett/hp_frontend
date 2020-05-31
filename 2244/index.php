<?php
date_default_timezone_set('America/New_York');
$addr = $_SERVER['REMOTE_ADDR'];
$today = date('Y-m-d H:i');
$data = $today.' - '.$addr."\n";

//Save A Single Value To A Flat File
$fp = fopen('visits.txt', "a");  //Open The File For append
  fwrite($fp,$data);                    //Save The Value
fclose($fp);         		            //close the file

header('Location: http://www.homeportonline.com');

?>