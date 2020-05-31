<?php

function squareImg($fileName, $saveName) {
	// load the image
	if(substr_count(strtolower($fileName), ".jpg") or substr_count(strtolower($fileName), ".jpeg")){
		$src = imagecreatefromjpeg($fileName);
	}
	if(substr_count(strtolower($fileName), ".gif")){
		$src = imagecreatefromgif($fileName);
	}
	if(substr_count(strtolower($fileName), ".png")){
		$src = imagecreatefrompng($fileName);
	}


   // Load up the original image
   $w = imagesx($src); // image width
   $h = imagesy($src); // image height
   $square = $w;
   if($h > $w) $square = $h;

   // Create output canvas and fill with white
   $final = imagecreatetruecolor($square,$square);
   $bg_color = imagecolorallocate ($final, 255, 255, 255);
   imagefill($final, 0, 0, $bg_color);

   // Check if portrait or landscape
   if($h>=$w){
      // Portrait, i.e. tall image
      $newh=$square;
      $neww=intval($square*$w/$h);
      // Resize and composite original image onto output canvas
      imagecopyresampled(
         $final, $src, 
         intval(($square-$neww)/2),0,
         0,0,
         $neww, $newh, 
         $w, $h);
   } else {
      // Landscape, i.e. wide image
      $neww=$square;
      $newh=intval($square*$h/$w);
      imagecopyresampled(
         $final, $src, 
         0,intval(($square-$newh)/2),
         0,0,
         $neww, $newh, 
         $w, $h);
   }

   // Write result 
   imagepng($final,$fileName);
   
   /*
   if($type == "png") imagepng($final,$fileName);
   if($type == "jpg") imagejpeg($final,$fileName,100);
   if($type == "gif") imagegif($final,$fileName);   
   */
}
squareImg("corn.png","sample_corn.png");
?>
<h2>Original image</h2>
<h2><img border="1" src="corn.jpg" />
</h2>

<h2>The created square thumbnail</h2>
<h2><img border="1" src="sample_corn.jpg" />
</h2>