

<?php
print 'ok';

//$user = $_POST['user'];
$user = 'dlievre';
$foldernom = $user;
$stamp = mktime();
$folder_fond = 'fonds/';

$upload_dir = "upload/".$foldernom.'/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0700);
$img = $_POST['hidden_data'];
$fond = $_POST['hidden_fond'].'.png';
//if (!$fond) exit;


$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . $stamp . ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';

//if (!$success) exit;
// fusion de l'image et du fond 

$dest = imagecreatefrompng($file); //on ouvre l'image source
$source = imagecreatefrompng($folder_fond.$fond); //on ouvre l'image source
$infosize = getimagesize($file);
$width_source = $infosize[0];
$height_source = $infosize[1];

//$file_fond = 'fonds/fond01.png';


$dst_x = 0;
$dst_y = 0;
$src_x = 0;
$src_y = 0;
$src_w = $width_source;
$src_h = $height_source;

$result = imagecopy ( $dest, $source, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h );
//$name = $path . 'fonds/un' . '.png';
//$name = $path . 'fonds/un' . '.png';
imagepng($dest, $file);
/*
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
//header('Content-Type: image/png');
//imagepng($dest);
imagepng($dest, $name);
// release ressources
imagedestroy($dest);
imagedestroy($src);
*/
?>