<?php
date_default_timezone_set('America/New_York');
// processEditCompany.php
// Mark Bouchett
// 2015/11
session_start(); // Resume up your PHP session!
// *** Verify Login ***
if(!isset($_SESSION['username'])){
  header('Location: index.php');
  exit;
}
$ppStart = $_POST['ppStart'];
$ppDays = $_POST['ppDays'];

if(!$ppStart || !$ppDays){
    header('location: editCompany.php?message=All Fields Are Required');
    die;
}

// Verify for valid date
$pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"; // Valid Date (YYYY-MM-DD)
if(!preg_match($pattern, $ppStart)){
    header('location: editCompany.php?message=The Acceptable Date Format Is YYYY-MM-DD');
    die;
}

// is not a number
if($ppDays < 1){
    header('location: editCompany.php?message=The Period Length Must Be A Number');
    die;
}

//Save A Single Value To A Flat File
$fp = fopen('pp.txt', "w");     //Open The File For Overwrite
  fwrite($fp,$ppStart."\n");                    //Save The Value
  fwrite($fp,$ppDays);                     //Save The Value
fclose($fp);         		               //close the file

header('location: editCompany.php?message=Changes Saved');
die;
?>