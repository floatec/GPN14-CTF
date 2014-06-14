<?php
session_start();

header("Content-type: image/png");
function RandomString($len)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $len; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

$time_start = microtime(true);

// Schriftgröße
$size = 15;

//Bildgroesse
$imgWidth = 175;//200
$imgHeight = 50;//80

// Farbverlauf RGB-Wert Start und RGB-Wert Ende
$fromRGB = array(
    rand(0,255),
    rand(0,255),
    rand(0,255)
);
$toRGB = array(
    rand(0,255),
    rand(0,255),
    rand(0,255)
);



// Randfarbe
$colorBorder = array(
    154,
    53,
    2
);
/* Bild erstellen */
$img = ImageCreateTrueColor($imgWidth,$imgHeight);
$imgout = ImageCreateTrueColor($imgWidth,$imgHeight);
$colorB = imagecolorallocate($img,$colorBorder[0],$colorBorder[1],$colorBorder[2]);



putenv('GDFONTPATH=' . realpath('.'));
$grey = imagecolorallocate($img, 128, 128, 128);
$font = 'font.ttf';
$text = RandomString(4);

$_SESSION['captchatext'] = $text;
$_SESSION['captchatime'] = time();
list($left,, $right) = imageftbbox( $size, 0, $font, $text);
$off = ($imgWidth/2 - $right/2);
imagettftext($img, $size, 0, $off, 40,$grey, $font , $text);
#imagestring($img, 100, 0, 0, RandomString(10), 0xffffff);

$time_end = microtime(true);
$time = $time_end - $time_start;

$a = array();
for ($i = 0; $i < $imgHeight; $i++) 
{
	array_push($a, $i);
}
shuffle($a);

for ($i = 0; $i < $imgHeight; $i++) 
{
	imagecopy($imgout, $img, 0, $i, 0, $a[$i], $imgWidth, 1);
}
#imagestring($img, 1 , 0, $imgHeight-10, ($time*1000)."ms to create" , 0);
ImagePNG($imgout);
imagedestroy($img);
imagedestroy($imgout);


?>
