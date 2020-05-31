<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$appNum=$_POST['appNum'];
$deleteMe=$_POST['deleteMe'];
$appCount=count($appNum);

for($i=0; $i<$appCount; $i++){
	$myFile=$rootLoc.'data/apps/'.$appNum[$i];
	if($deleteMe[$i]){
		unlink($myFile);
	}
}

header('Location: '.$rootLoc.'reviewApps.php?message=Changes Saved '.date('l jS \of F Y h:i:s A'));
die();

?>
