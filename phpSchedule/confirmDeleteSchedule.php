<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
  
$rootLoc=$_SESSION['rootLoc'];
$deleteWeek=$_POST['deleteWeek'];

$target=$rootLoc.'data/schedules/'.$deleteWeek;
unlink(@$target);
$message= $deleteWeek.' has been deleted';
header('Location: '.$rootLoc.'deleteSchedule.php?message='.$message.'' );
die();
?>
