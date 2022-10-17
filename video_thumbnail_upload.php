<?php 
$width = 500;
$height = 500;

$layers = array();


$layers[] = imagecreatefromjpeg('i.1.1-2.jpg');
$layers[] = imagecreatefrompng("assets/img/placeholder.png");
$image = imagecreatetruecolor($width, $height);

// to make background transparent?
imagealphablending($image, false);
$transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparency);
imagesavealpha($image, true);

imagealphablending($image, true);
for ($i = 0; $i < count($layers); $i++) {
    imagecopy($image, $layers[$i], 0, 0, 0, 0, $width, $height);
}
imagealphablending($image, false);
imagesavealpha($image, true);

imagejpeg($image, 'final_img.jpg'); 