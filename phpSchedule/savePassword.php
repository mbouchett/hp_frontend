<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];

$ap=$_POST['ap'];   //New Admin Password
$up=$_POST['up'];   //New Admin Password verification
$vap=$_POST['vap']; //New User Password
$vup=$_POST['vup']; //New Admin Password verification

// This Bit Loads old Passwords Into An Array
$fp = @fopen($rootLoc.'admin/ap.txt', "r");
if($fp){
    // get the passwords
    $pw[0]= fgets($fp); //old admin password
	$pw[1]= fgets($fp); //old user password
fclose($fp);         //close the password file
}
if(!$ap && !$up){
    header('Location: '.$rootLoc.'changePassword.php?message=Nothing Entered Nothing Changed!' );
    die();
}
if($ap != $vap){
    header('Location: '.$rootLoc.'changePassword.php?message=Admin Passwords Do Not Match!' );
    die();
}
if($up != $vup){
    header('Location: '.$rootLoc.'changePassword.php?message=User Passwords Do Not Match!' );
    die();
}

if($ap && $up){  //Both Admin And User Passwords Are Changed
  $pw[0]=$ap;
  $pw[1]=$up;
  $msg='Both Admin And User Passwords Are Changed';
}
if($ap && !$up){
  $pw[0]=$ap;  // Only Admin Password Is Changed
  $msg='Only Admin Password Is Changed';
}

if(!$ap && $up){
  $pw[1]=$up;   // Only User Password Is Change
  $msg='Only User Password Is Changed';
}


// This Bit Loads old Passwords Into An Array
$fp = @fopen($rootLoc.'admin/ap.txt', "w");
 $savepw[0]=trim($pw[0])."\n";
 $savepw[1]=trim($pw[1])."\n";
  // save the passwords
  fwrite($fp,$savepw[0]); //new admin password
  fwrite($fp,$savepw[1]); //new user password
fclose($fp);         //close the password file


?>
<br /><br />
<table border="4" bordercolor="#808000" align="center" width="400">
	<tr>
<?php
    	echo '<td align="center">'.$msg.'</td>'."\n";
?>
	</tr>
	<tr><td align="center">
<?php
    	echo '<input value="Done" onclick="parent.location=\''.$rootLoc.'adminDashboard.php\'" type="button">'."\n";
?>
	</td></tr>
</table>
