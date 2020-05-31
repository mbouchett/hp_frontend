<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$users=$_POST['users'];

// $users[$i][0] =Lastnames
// $users[$i][1] =Firstnames

$userCount=count($users);

//Update Employee File
$fp = fopen($rootLoc.'data/companyInfo.txt', "w");
    for($i=0; $i<$userCount; $i++){
        fwrite($fp, $users[$i]."\n");
}
fclose($fp);         //close the Employee File

header('Location: '.$rootLoc.'companyInfo.php?message=Company Info File Updated '.date('l jS \of F Y h:i:s A'));
die();
?>
