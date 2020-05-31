<?php

function sqImg($fn){
	echo "Processing: ".$fn."...<br>";
	$imgLoad = 1; // Image load status
	$imgType = "";
	$imgInfo = getimagesize($fn);
	
	// Determine image type and load image
	if(substr($fn, -3) == 'jpg' || substr($fn, -3) == 'peg') {
			echo "This is a jpeg image.<br>";
			$imgType = "jpg";
			$im = @imagecreatefromJpeg($fn);
			if($im) {
				echo "Image Creation Successful<br>"; 
			} else {
				echo "Image Creation Failed<br>"; 
				$imgLoad = 0;
			}
	}
	if(substr($fn, -3) == 'png') {
			echo "This is a png image.<br>";
			$imgType = "png";
			$im = @imagecreatefromPng($fn);
			if($im) {
				echo "Image Creation Successful<br>"; 
			} else {
				echo "Image Creation Failed<br>"; 
				$imgLoad = 0;
			}
	}	
	if(substr($fn, -3) == 'gif' || substr($fn, -3) == 'peg') {
			echo "This is a Gif image.<br>";
			$imgType = "gif";
			$im = @imagecreatefromGif($fn);
			if($im) {
				echo "Image Creation Successful<br>"; 
			} else {
				echo "Image Creation Failed<br>"; 
				$imgLoad = 0;
			}
	}
	
	// get image info
	$imgInfo = getimagesize($fn);
	if($imgInfo[0] == $imgInfo[1]) {
		echo "This is a square image, no processing necessary<hr>";
		return;	
	}
	
	echo $imgInfo[0]." x ".$imgInfo[1]."<br>";
	
	$xPos = 0;
	$yPos - 0;
	
	if($imgInfo[0] > $imgInfo[1]){
		$size = $imgInfo[0];
		$yPos = floor(($imgInfo[0] - $imgInfo[1]) / 2);
	} 
	if($imgInfo[0] < $imgInfo[1]){
		$size = $imgInfo[1];
		$xPos = floor(($imgInfo[1] - $imgInfo[0]) / 2);
	}	
	 
	echo "Expanding to ".$size."<br>";
	

	
	
	$imgNew = imagecreatetruecolor($size, $size);
	$bg = imagecolorallocate ( $imgNew, 255, 255, 255 );
	imagefilledrectangle($imgNew,0,0,$size,$size,$bg);
	imagecopymerge($imgNew, $im, $xPos, $yPos, 0, 0, $imgInfo[0], $imgInfo[1], 100);	
	
	imagejpeg($imgNew,$fn);
	imagedestroy($imgNew);
}


sqImg("sword.jpg");

?>