<?php
//processResetCashReport.php 2018/01
// Reset Cash Report

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
$yyyy = $_POST['yyyy'];
$mm = $_POST['mm'];
$dd = $_POST['dd'];
$th = $_POST['th'];
$tm = $_POST['tm'];

$stamp = $yyyy.'-'.$mm.'-'.$dd.'-'.$th.'-'.$tm;

//Save A Single Value To A Flat File
$fp = fopen('datestamp.txt', "w");  //Open The File For Overwrite
  fwrite($fp,$stamp);                   //Save The Value
fclose($fp);         		            //close the file

header('Location: cashReport.php');
die;
?>