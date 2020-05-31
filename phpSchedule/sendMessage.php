<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$usersX=$_POST['users'];
$userCount=count($usersX);
$story=$_POST['story'];
$subject=$_POST['subject'];
$compAddr=$_POST['compAddr'];


// $users[$i][0] =Email Address
// $users[$i][1] =Selected
// $users[$i][3] =First Name
// $users[$i][2] =Last Name
// $story =The Message

// this bit copies the Employee arry minus any deleted items
unset($users);
$ii=0; // initialize copy array counter
for($i=1; $i<$userCount+1; $i++){
    if($usersX[$i][1] && $usersX[$i][0]) {
        $users[$ii][0]=$usersX[$i][0];
        $users[$ii][1]=$usersX[$i][1];
        $users[$ii][2]=$usersX[$i][2];
        $users[$ii][3]=$usersX[$i][3];
    $ii=$ii+1;
    }
}
$userCount=count($users);

for($i=0; $i<$userCount; $i++){
	$finalStory=$users[$i][3].' '.$users[$i][2]."\n\n".
                "\t\t".$story;

	// Decide who gets the email
	mail($users[$i][0],$subject,$finalStory,$compAddr);
//echo $i.' - '.$users[$i][0]."<br />\n";
}
//exit;
header('Location: '.$rootLoc.'postMessage.php?message=Email Sent '.date('l jS \of F Y h:i:s A'));
die();
?>
