<?php
//processEditRegProfile.php 2018/06
// Save Registry Profile Edit
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	echo 'No Authorization'.$username;
	exit;
}

$regnum=$_REQUEST['regnum'];
//$regnum=regnum
/* nb. Here are the field correlations
rN[0]=partner1F			rN[10]=addr02
rN[1]=partner1L			rN[11]=addr03
rN[2]=partner2F			rN[12]=contact
rN[3]=partner2L			rN[13]=relation
rN[4]=eventdate			rN[14]=cphone01
rN[5]=phone01			rN[15]=cphone02
rN[6]=phone02			rN[16]=cemail
rN[7]=email01			rN[17]=postaddr01
rN[8]=email02			rN[18]=postaddr02
rN[9]=addr01			rN[19]=postaddr03
*/

$rN=$_POST['rN'];
$delete = $_POST['delete'];

// Verify That All Required Fields Are Filled In
if(!$rN[0] || !$rN[1] || !$rN[2] || !$rN[3] || !$rN[4] || !$rN[5] || !$rN[7]){
	$_SESSION['r']=$r;
	header('Location: editRegProfile.php?message=Please Fill All Required Fields&messColor=CC0000&messSize=24&regnum='.$regnum);
	die;
}

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
    $sql = "UPDATE `".$db_db."`.`registry`
        SET `reg_partner1F` = '".$rN[0]."',
            `reg_partner1L` = '".$rN[1]."',
            `reg_partner2F` = '".$rN[2]."',
            `reg_partner2L` = '".$rN[3]."',
            `reg_event_date` = '".$rN[4]."',
            `reg_phone01` = '".$rN[5]."',
            `reg_phone02` = '".$rN[6]."',
            `reg_email01` = '".$rN[7]."',
            `reg_email02` = '".$rN[8]."',
            `reg_addr01` = '".$rN[9]."',
            `reg_addr02` = '".$rN[10]."',
            `reg_addr03` = '".$rN[11]."',
            `reg_contact` = '".$rN[12]."',
            `reg_relation` = '".$rN[13]."',
            `reg_cphone01` = '".$rN[14]."',
            `reg_cphone02` = '".$rN[15]."',
            `reg_cemail` = '".$rN[16]."',
            `reg_postaddr01` = '".$rN[17]."',
            `reg_postaddr02` = '".$rN[18]."',
            `reg_postaddr03` = '".$rN[19]."'
         WHERE `reg_ID` = '".trim($regnum)."';";
    $result = mysqli_query($db, $sql);
// on update error
if(!$result){
	echo "Edit No Good!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
header('Location: editRegProfile.php?message=Changes Saved&messColor=33CC00&messSize=24&regnum='.$regnum);
die;
?>