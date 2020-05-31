<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

$username=$_SESSION['username'];
$popmessage=stripslashes($_POST['popmessage']);
$cust_name=$_POST['cust_name'];
$comment=$_POST['comment'];
$mailto=$_POST['mailto'];
$when = date('m/d/Y');
$cust_ID = $_POST['cust_ID'];
$link="\n\n
        If you are logged into the dashboard you can navigate to the link below.\n
        http://www.homeportonline.com/dashboard/wantlist/customer.php?cust=".$cust;

$text = $popmessage.
        $comment.
        $link;

mail($mailto, "CS Alert",$text,"From:".$username);

header('Location: popMail.php?message=Message Sent '.$when);
die;
?>