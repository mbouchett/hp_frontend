<?php


	@include "/home/homeportonline/crc/2018.php";
	@include "/home/homeportonline/crc/functions/f_resolve.php";
	
	// ************************* Functions ************************
	//Get your bad self some items
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT `items`.`item_ID`, `items`.`item_desc`, 
	               `departments`.`dept_belongs_to`,`departments`.`dept_name`, 
	               `vendors`.`vendor_name`   
	        FROM `items` 
	        LEFT JOIN `departments` USING (`dept_ID`) 
	        LEFT JOIN `vendors` USING(`vendor_ID`) 
	        WHERE `item_pic` IS NOT NULL AND `vendor_ID` <> 1483';
	$result = mysqli_query($db, $sql);    
	
		if(!$result){
		echo "Lookup Error!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}  
	mysqli_close($db);
	@$itemCount = mysqli_num_rows($result);

		$str = "Hamock";
		$metakey = metaphone($str);
		echo $itemCount."-->".$str." - ".$metakey."<br>----------------------<br>";

	for($i=0; $i<$itemCount; $i++){
		$item[$i] = mysqli_fetch_assoc($result);

		$metastring = " ".metaphone($item[$i]['item_desc']).metaphone($item[$i]['dept_name']).metaphone($item[$i]['vendor_name']).metaphone($item[$i]['item_details']);
		$pos = strpos($metastring, $metakey);
		//echo $metastring."<br>";
		if($pos) {
			echo $item[$i]['item_desc']."<br>";
		}
	}
		
?>