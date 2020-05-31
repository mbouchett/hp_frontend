<?php
//processManageRegItems.php

@include "/home/homeportonline/crc/2018.php";


$id = $_POST['id'];
$qty = $_POST['qty'];

$count = count($id);

for($i = 0; $i < $count; $i++) {
	if((int) $qty[$i] == $qty[$i] && $qty[$i] > 0) {
		$qty[$i] = (int) $qty[$i];
	}else {
		$qty[$i] = 1;
	}
}

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$count; $i++){
	$sql = 'UPDATE `'.$db_db.'`.`web_reg` SET `reg_qty`= '.$qty[$i].' WHERE `reg_ID`='.$id[$i];
	$result = mysqli_query($db, $sql);
	if(!$result){
		echo "No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db);

header('location: manageRegItems.php');
die;
?>