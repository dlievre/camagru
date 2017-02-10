<?php
 /* $fond = imagecreatefrompng("fonds/fond01.png");
  $source = imagecreatefrompng("upload/dlievre/1486636817.png");
  // imagealphablending($fond, false);
 	//imagealphablending($source, false);

  imagecolortransparent($source, imagecolorat($source, 0, 0));
    imagecopymerge($fond, $source, 0, 0, 0, 0, 514, 256, 100);
   // imagecopymerge($source, $fond, 0, 0, 0, 0, 514, 256, 100);
  header('Content-type: image/png');
  imagepng($fond);
  imagedestroy($fond);
  imagedestroy($source);*/

///////////

$imgl = "upload/dlievre/1486636817.png";
$img2 = "fonds/fond04.png";

//$imgl = "fonds/pattern.png";
//$img2 = "fonds/frame.png";

//imagealphablending($img2, true);
/*$dest = imagecreatefrompng($imgl);
$src = imagecreatefrompng($img2);

imagealphablending($src, false);
imagesavealpha($src, true);

//imagecolortransparent($src, imagecolorat($src, 0, 0));

$src_x = imagesx($dest);
$src_y = imagesy($dest);
imagecopymerge($dest, $src, 0, 0, 0, 0, $src_x, $src_y, 100);

// Output and free from memory
header('Content-Type: image/png');
imagepng($dest);

imagedestroy($dest);
imagedestroy($src);*/
// create ressources
				$dest = imagecreatefrompng("upload/dlievre/1486636817.png");
				//$src = imagecreatefrompng("fonds/fond04.png");
				$src = imagecreatefrompng("fonds/fond01.png");
				// set alpha
				//imagealphablending($dest, true);
				//imagesavealpha($dest, false);
				// merge pictures
			    imagecopy($dest, $src, 0, 0, 0, 0, 540, 540);
			    // save img into galerie folder
			    $name = $path . 'fonds/un' . '.png';
			    header('Content-Type: image/png');
			    imagepng($dest);
			    //imagepng($dest, $name);
			    // release ressources
			    imagedestroy($dest);
			    imagedestroy($src);

?>