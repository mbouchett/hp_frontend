<?php
session_start(); // start up your PHP session!
    //Establish Variables

$password=$_POST['password'];

// This Bit Loads Passwords Into An Array
$fp = @fopen('../phpSchedule/admin/ap.txt', "r");
if($fp){
    // get the passwords
    $pw[0]= fgets($fp); //admin password
	$pw[1]= fgets($fp); //user password
fclose($fp);         //close the password file

} else { //if no password is found
	echo 'No Administrator Or User Files Found!'."\n";
	exit;
}

//This Bit Checks The Password To See Who If Anyone Is Logged In
if($password==trim($pw[0])) { //Administrator is logged in
	$_SESSION['loggedIn']='admin'; // Set user logged in as admin
	$_SESSION['rootLoc']='../phpSchedule/';
	header('Location: ../phpSchedule/adminDashboard.php' );
	die();	
		
}
if($password==trim($pw[1])) { //Administrator is logged in
	$_SESSION['loggedIn']='user'; // Set user logged in as admin
	$_SESSION['rootLoc']='../phpSchedule/';
	header('Location: ../phpSchedule/viewSchedule.php' );
	die();	
		
}
?>
<br><br>
<center><big><b>Incorrect Login</b></big></center>