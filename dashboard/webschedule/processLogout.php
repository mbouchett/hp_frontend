<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit;
  }
session_destroy();
header('Location: index.php');
?>