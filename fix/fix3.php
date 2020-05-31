<?php
function sizeImage($imageName) {
	echo $imageName;	
  // Create image from file
  $image = null;
	// load the image
	if(substr_count(strtolower($imageName), ".jpg") or substr_count(strtolower($imageName), ".jpeg")){
		$image = imagecreatefromjpeg($imageName);
	}
	if(substr_count(strtolower($imageName), ".gif")){
		$image = imagecreatefromgif($imageName);
	}
	if(substr_count(strtolower($imageName), ".png")){
		$image = imagecreatefrompng($imageName);
	}
	
	header('Content-Type: image/jpeg');
	imagepng($image);
}
sizeImage("corn.jpg");
?>
