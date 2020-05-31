<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$usersX=$_POST['users'];
$userCount=count($usersX);
$deleteMe=$_POST['deleteMe'];

// $users[$i][0] =Lastnames
// $users[$i][1] =Firstnames
// $users[$i][2] =Telephone #s
// $users[$i][3] =Email Adresses
// $users[$i][4] =Ok To Call
// $users[$i][5] =Ok To Email
// $users[$i][5] =Switch to delete user
// $users[$i][6] =Emergency Contact

// this bit copies the Employee arry minus any deleted items
unset($users);
$ii=0; // initialize copy array counter
for($i=0; $i<$userCount; $i++){
    if(!$deleteMe[$i]) {
        $users[$ii][0]=$usersX[$i][0];
        $users[$ii][1]=$usersX[$i][1];
        $users[$ii][2]=$usersX[$i][2];
        $users[$ii][3]=$usersX[$i][3];
        $users[$ii][4]=$usersX[$i][4];
        $users[$ii][5]=$usersX[$i][5];
        $users[$ii][6]=$usersX[$i][6];
    $ii=$ii+1;
    }
}
$userCount=count($users);

// This bit corrects check boxes for playback
for($i=0; $i<$userCount; $i++){
	if ($users[$i][4]) $users[$i][4]="checked";
	if ($users[$i][5]) $users[$i][5]="checked";
	if (!$users[$i][4]) $users[$i][4]="";
	if (!$users[$i][5]) $users[$i][5]="";
}

//Update Employee File
$fp = fopen($rootLoc.'data/employees.txt', "w");
    for($i=0; $i<$userCount; $i++){
        $stuff=$users[$i][1].','.$users[$i][0].','.$users[$i][2].','.$users[$i][3].','.$users[$i][4].','.$users[$i][5].','.$users[$i][6]."\n";
        if($i==$userCount-1) $stuff=$users[$i][1].','.$users[$i][0].','.$users[$i][2].','.$users[$i][3].','.$users[$i][4].','.$users[$i][5].','.$users[$i][6];
        fwrite($fp, $stuff);
}
fclose($fp);         //close the Employee File

header('Location: '.$rootLoc.'employeeInfo.php?message=Employee File Updated '.date('l jS \of F Y h:i:s A'));
die();
?>
