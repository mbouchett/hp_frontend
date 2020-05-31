<?php
	$number = $_POST['set'];
	
	if(!$number) {
		//Load A Single Value From A Flat File
		$fp = fopen('/home/homeportonline/crc/number.txt', "r");  			//Open The File For Reading
		  $number= fgets($fp);                    //Load The Value
		fclose($fp);                            	//Close The File
		$number = $number + 1;
	}
	
	$data = strval($number);
	//Save A Single Value To A Flat File
	$fp = fopen('/home/homeportonline/crc/number.txt', "w");  			//Open The File For Overwrite
	  fwrite($fp,$data);                    	//Save The Value
	fclose($fp);                            	//Close The File

//echo $number;
//exit;

	header('location: index.php');
	die;
?>