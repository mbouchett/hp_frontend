<?php
//processAddMc.php 2018/01
// Puts a new merchandise credit into the system
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

//Establish Variables
$cust_ID=$_POST['cust_ID'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$desc=ucwords(strtolower($_POST['desc']));
$emp=$_POST['emp'];
$dept_ID=$_POST['dept_ID'];
$ret=$_POST['ret'];
$today=date('Y-m-d');

//Check for missing data
$msg1 = '<script type="text/javascript">'
       .'alert("Be Sure To Fill Out All Required Fields!");'
       .'window.location="csEdit.php?cust_ID='.$cust_ID.'&mcm=go"'
       .'</script>';
if(!$desc || !$qty ||!$price || !$dept_ID || !$ret || !$emp){
    echo $msg1;
    die;
}
// Check to see if quantity and price are numeric
$msg2 = '<script type="text/javascript">'
       .'alert("Quantity And Price Must Be Numeric!");'
       .'window.location="csEdit.php?cust_ID='.$cust_ID.'&mcm=go"'
       .'</script>';
if(!is_numeric($qty) ||!is_numeric($price) ){
    echo $msg2;
	die;
}

//Add To Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = "INSERT INTO `".$db_db."`.`MC_Items` 
				(`mc_ID`, `dept_ID`, `mc_qty`, `mc_price`, `mc_desc`, `cust_ID`, `mc_employee`, `mc_status`, `mc_date`) 
				VALUES (NULL, '$dept_ID', '$qty', '$price', '$desc', '$cust_ID', '$emp', '$ret', '$today')";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Add Mc Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
?>
<script type="text/javascript">
  window.location="csEdit.php?cust_ID=<?=$cust_ID?>&mcm=go"
</script>