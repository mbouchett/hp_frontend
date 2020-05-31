<?php
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }
$rootLoc=$_SESSION['rootLoc'];
$deptsX=$_POST['depts'];
$deptCount=count($deptsX);
$deleteMe=$_POST['deleteMe'];

// $depts[$i][0] =Lastnames
// $depts[$i][1] =Firstnames

// this bit copies the arry minus any deleted items
unset($depts);
$ii=0; // initialize copy array counter
for($i=0; $i<$deptCount; $i++){
    if(!$deleteMe[$i]) {
        $depts[$ii][0]=$deptsX[$i][0];
        $depts[$ii][1]=$deptsX[$i][1];
    $ii=$ii+1;
    }
}
$deptCount=count($depts);

for($i=0; $i<$deptCount; $i++){
  if(!$depts[$i][1]) $depts[$i][1]="off";
  }

//Update Department File
$fp = fopen($rootLoc.'data/jobs.txt', "w");
    for($i=0; $i<$deptCount; $i++){
        $stuff=$depts[$i][0].','.$depts[$i][1]."\n";
        if($i==$deptCount-1) $stuff=$depts[$i][0].','.$depts[$i][1];
        fwrite($fp, $stuff);

}
fclose($fp);         //close the Department File

header('Location: '.$rootLoc.'postJob.php?message=File Updated '.date('l jS \of F Y h:i:s A'));
die();

?>
